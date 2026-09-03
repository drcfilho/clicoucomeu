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
