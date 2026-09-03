<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Repositories\TenantRepository;
use App\Validation\Validator;

class TenantController
{
    private const FORM_KEY = 'admin_tenant_form';
    private const ERROR_KEY = 'admin_tenant_errors';
    private const SUCCESS_KEY = 'admin_tenant_success';
    private const EDIT_FORM_KEY = 'admin_tenant_edit_form';
    private const EDIT_ERROR_KEY = 'admin_tenant_edit_errors';

    public function __construct(private Container $container)
    {
    }

    public function home(Request $request, Response $response, array $params = []): void
    {
        $session = $this->container->get('session');

        $response->view('admin.index', [
            'nome' => (string) $session->get('nome', 'Superadmin'),
        ]);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        /** @var TenantRepository $tenants */
        $tenants = $this->container->get('tenantRepository');
        $session = $this->container->get('session');
        $csrf = $this->container->get('csrf');

        $response->view('admin.tenants', [
            'tenants' => $tenants->all(),
            'csrfToken' => $csrf->token(),
            'form' => $session->pull(self::FORM_KEY, [
                'nome' => '',
                'slug' => '',
                'whatsapp' => '',
                'cidade' => '',
                'uf' => '',
                'timezone' => 'America/Sao_Paulo',
                'status' => 'ativo',
                'plano' => 'mvp',
            ]),
            'errors' => $session->pull(self::ERROR_KEY, []),
            'success' => $session->pull(self::SUCCESS_KEY),
        ]);
    }

    public function store(Request $request, Response $response, array $params = []): void
    {
        $csrf = $this->container->get('csrf');
        $session = $this->container->get('session');

        if (!$csrf->validate((string) $request->input('_csrf'))) {
            $session->set(self::ERROR_KEY, ['geral' => 'Token CSRF invalido.']);
            $response->redirect('/admin/tenants');
        }

        $form = $this->normalizeForm($request->all());
        $session->set(self::FORM_KEY, $form);

        /** @var Validator $validator */
        $validator = $this->container->get('validator');
        $errors = $validator->required($form, ['nome', 'slug', 'timezone', 'status']);

        if (!preg_match('/^[a-z0-9-]+$/', $form['slug'])) {
            $errors['slug'] = 'Use apenas letras minusculas, numeros e hifen.';
        }

        if (!in_array($form['status'], ['ativo', 'bloqueado', 'cancelado'], true)) {
            $errors['status'] = 'Status invalido.';
        }

        if ($form['uf'] !== '' && !preg_match('/^[A-Z]{2}$/', $form['uf'])) {
            $errors['uf'] = 'Informe uma UF valida com 2 letras.';
        }

        /** @var TenantRepository $tenants */
        $tenants = $this->container->get('tenantRepository');

        if ($tenants->findBySlug($form['slug']) !== null) {
            $errors['slug'] = 'Este slug ja esta em uso.';
        }

        if ($errors !== []) {
            $session->set(self::ERROR_KEY, $errors);
            $response->redirect('/admin/tenants');
        }

        $tenantId = $tenants->create($form);

        $session->set(self::FORM_KEY, [
            'nome' => '',
            'slug' => '',
            'whatsapp' => '',
            'cidade' => '',
            'uf' => '',
            'timezone' => 'America/Sao_Paulo',
            'status' => 'ativo',
            'plano' => 'mvp',
        ]);
        $session->set(self::SUCCESS_KEY, 'Tenant criado com sucesso. ID: ' . $tenantId);

        $response->redirect('/admin/tenants');
    }

    public function edit(Request $request, Response $response, array $params = []): void
    {
        /** @var TenantRepository $tenants */
        $tenants = $this->container->get('tenantRepository');
        $session = $this->container->get('session');
        $csrf = $this->container->get('csrf');
        $tenantId = (int) ($params['id'] ?? 0);
        $tenant = $tenants->findById($tenantId);

        if ($tenant === null) {
            $response->view('errors.404', [
                'message' => 'Tenant nao encontrado.',
            ], 404);
            return;
        }

        $response->view('admin.tenant-edit', [
            'tenant' => $session->pull(self::EDIT_FORM_KEY, $tenant),
            'errors' => $session->pull(self::EDIT_ERROR_KEY, []),
            'success' => $session->pull(self::SUCCESS_KEY),
            'csrfToken' => $csrf->token(),
        ]);
    }

    public function update(Request $request, Response $response, array $params = []): void
    {
        $csrf = $this->container->get('csrf');
        $session = $this->container->get('session');
        $tenantId = (int) ($params['id'] ?? 0);

        if (!$csrf->validate((string) $request->input('_csrf'))) {
            $session->set(self::EDIT_ERROR_KEY, ['geral' => 'Token CSRF invalido.']);
            $response->redirect('/admin/tenants/' . $tenantId . '/editar');
        }

        /** @var TenantRepository $tenants */
        $tenants = $this->container->get('tenantRepository');
        $existingTenant = $tenants->findById($tenantId);

        if ($existingTenant === null) {
            $response->view('errors.404', [
                'message' => 'Tenant nao encontrado.',
            ], 404);
            return;
        }

        $form = $this->normalizeForm($request->all());
        $form['id'] = $tenantId;
        $session->set(self::EDIT_FORM_KEY, $form);

        /** @var Validator $validator */
        $validator = $this->container->get('validator');
        $errors = $validator->required($form, ['nome', 'slug', 'timezone', 'status']);

        if (!preg_match('/^[a-z0-9-]+$/', $form['slug'])) {
            $errors['slug'] = 'Use apenas letras minusculas, numeros e hifen.';
        }

        if (!in_array($form['status'], ['ativo', 'bloqueado', 'cancelado'], true)) {
            $errors['status'] = 'Status invalido.';
        }

        if ($form['uf'] !== '' && !preg_match('/^[A-Z]{2}$/', $form['uf'])) {
            $errors['uf'] = 'Informe uma UF valida com 2 letras.';
        }

        $tenantWithSlug = $tenants->findBySlug($form['slug']);
        if ($tenantWithSlug !== null && (int) $tenantWithSlug['id'] !== $tenantId) {
            $errors['slug'] = 'Este slug ja esta em uso.';
        }

        if ($errors !== []) {
            $session->set(self::EDIT_ERROR_KEY, $errors);
            $response->redirect('/admin/tenants/' . $tenantId . '/editar');
        }

        $tenants->update($tenantId, $form);
        $updatedTenant = $tenants->findById($tenantId);

        $session->set(self::EDIT_FORM_KEY, $updatedTenant !== null ? $updatedTenant : $form);
        $session->set(self::SUCCESS_KEY, 'Tenant atualizado com sucesso.');

        $response->redirect('/admin/tenants/' . $tenantId . '/editar');
    }

    public function activate(Request $request, Response $response, array $params = []): void
    {
        $csrf = $this->container->get('csrf');
        $session = $this->container->get('session');
        $tenantId = (int) ($params['id'] ?? 0);

        if (!$csrf->validate((string) $request->input('_csrf'))) {
            $session->set(self::ERROR_KEY, ['geral' => 'Token CSRF invalido.']);
            $response->redirect('/admin/tenants');
        }

        /** @var TenantRepository $tenants */
        $tenants = $this->container->get('tenantRepository');
        $tenant = $tenants->findById($tenantId);

        if ($tenant === null) {
            $response->view('errors.404', [
                'message' => 'Tenant nao encontrado.',
            ], 404);
            return;
        }

        $tenants->updateStatus($tenantId, 'ativo');
        $session->set(self::SUCCESS_KEY, 'Tenant ativado com sucesso.');

        $response->redirect('/admin/tenants');
    }

    private function normalizeForm(array $data): array
    {
        return [
            'nome' => trim((string) ($data['nome'] ?? '')),
            'slug' => strtolower(trim((string) ($data['slug'] ?? ''))),
            'whatsapp' => trim((string) ($data['whatsapp'] ?? '')),
            'cidade' => trim((string) ($data['cidade'] ?? '')),
            'uf' => strtoupper(trim((string) ($data['uf'] ?? ''))),
            'timezone' => trim((string) ($data['timezone'] ?? 'America/Sao_Paulo')),
            'status' => trim((string) ($data['status'] ?? 'ativo')),
            'plano' => trim((string) ($data['plano'] ?? 'mvp')),
        ];
    }
}
