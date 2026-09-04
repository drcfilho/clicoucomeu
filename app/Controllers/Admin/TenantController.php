<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Repositories\TenantRepository;
use App\Repositories\UserRepository;
use App\Validation\Validator;

class TenantController
{
    private const PLAN_OPTIONS = ['mvp', 'starter', 'pro', 'enterprise'];
    private const FORM_KEY = 'admin_tenant_form';
    private const ERROR_KEY = 'admin_tenant_errors';
    private const SUCCESS_KEY = 'admin_tenant_success';
    private const EDIT_FORM_KEY = 'admin_tenant_edit_form';
    private const EDIT_ERROR_KEY = 'admin_tenant_edit_errors';
    private const ADMIN_FORM_KEY = 'admin_tenant_admin_form';
    private const ADMIN_ERROR_KEY = 'admin_tenant_admin_errors';

    public function __construct(private Container $container)
    {
    }

    public function home(Request $request, Response $response, array $params = []): void
    {
        $session = $this->container->get('session');
        /** @var TenantRepository $tenantRepo */
        $tenantRepo = $this->container->get('tenantRepository');

        $metrics = $tenantRepo->getSaasMetrics();
        $tenants = $tenantRepo->all();

        $response->view('admin.index', [
            'nome' => (string) $session->get('user_nome', $session->get('nome', 'Superadmin')),
            'metrics' => $metrics,
            'tenants' => $tenants,
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

        if (!in_array($form['plano'], self::PLAN_OPTIONS, true)) {
            $errors['plano'] = 'Plano invalido.';
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
            'adminForm' => $session->pull(self::ADMIN_FORM_KEY, [
                'nome' => '',
                'usuario' => '',
                'senha' => '',
            ]),
            'adminErrors' => $session->pull(self::ADMIN_ERROR_KEY, []),
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

        if (!in_array($form['plano'], self::PLAN_OPTIONS, true)) {
            $errors['plano'] = 'Plano invalido.';
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

    public function updatePlan(Request $request, Response $response, array $params = []): void
    {
        $csrf = $this->container->get('csrf');
        $session = $this->container->get('session');
        $tenantId = (int) ($params['id'] ?? 0);

        if (!$csrf->validate((string) $request->input('_csrf'))) {
            $session->set(self::EDIT_ERROR_KEY, ['geral' => 'Token CSRF invalido.']);
            $response->redirect('/admin/tenants/' . $tenantId . '/editar');
        }

        $plan = trim((string) $request->input('plano'));

        if (!in_array($plan, self::PLAN_OPTIONS, true)) {
            $session->set(self::EDIT_ERROR_KEY, ['plano' => 'Plano invalido.']);
            $response->redirect('/admin/tenants/' . $tenantId . '/editar');
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

        $payload = [
            'nome' => (string) $tenant['nome'],
            'slug' => (string) $tenant['slug'],
            'whatsapp' => (string) ($tenant['whatsapp'] ?? ''),
            'cidade' => (string) ($tenant['cidade'] ?? ''),
            'uf' => (string) ($tenant['uf'] ?? ''),
            'timezone' => (string) $tenant['timezone'],
            'status' => (string) $tenant['status'],
            'plano' => $plan,
        ];

        $tenants->update($tenantId, $payload);
        $session->set(self::SUCCESS_KEY, 'Plano atualizado com sucesso.');

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

    public function block(Request $request, Response $response, array $params = []): void
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

        $tenants->updateStatus($tenantId, 'bloqueado');
        $session->set(self::SUCCESS_KEY, 'Tenant bloqueado com sucesso.');

        $response->redirect('/admin/tenants');
    }

    public function createAdmin(Request $request, Response $response, array $params = []): void
    {
        $csrf = $this->container->get('csrf');
        $session = $this->container->get('session');
        $tenantId = (int) ($params['id'] ?? 0);

        if (!$csrf->validate((string) $request->input('_csrf'))) {
            $session->set(self::ADMIN_ERROR_KEY, ['geral' => 'Token CSRF invalido.']);
            $response->redirect('/admin/tenants/' . $tenantId . '/editar');
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

        $form = [
            'nome' => trim((string) $request->input('admin_nome')),
            'usuario' => strtolower(trim((string) $request->input('admin_usuario'))),
            'senha' => trim((string) $request->input('admin_senha')),
        ];
        $session->set(self::ADMIN_FORM_KEY, $form);

        /** @var Validator $validator */
        $validator = $this->container->get('validator');
        $errors = $validator->required($form, ['nome', 'usuario', 'senha']);

        if (!preg_match('/^[a-z0-9._-]+$/', $form['usuario'])) {
            $errors['usuario'] = 'Usuario invalido. Use letras minusculas, numeros, ponto, hifen ou underscore.';
        }

        if (strlen($form['senha']) < 6) {
            $errors['senha'] = 'A senha deve ter pelo menos 6 caracteres.';
        }

        /** @var UserRepository $users */
        $users = $this->container->get('userRepository');
        if ($users->findByUsernameForTenant($tenantId, $form['usuario']) !== null) {
            $errors['usuario'] = 'Este usuario ja existe neste tenant.';
        }

        if ($errors !== []) {
            $session->set(self::ADMIN_ERROR_KEY, $errors);
            $response->redirect('/admin/tenants/' . $tenantId . '/editar');
        }

        $userId = $users->createTenantAdmin($tenantId, $form);
        $session->set(self::ADMIN_FORM_KEY, [
            'nome' => '',
            'usuario' => '',
            'senha' => '',
        ]);
        $session->set(self::SUCCESS_KEY, 'Admin do tenant criado com sucesso. ID: ' . $userId);

        $response->redirect('/admin/tenants/' . $tenantId . '/editar');
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

    public function extendTrial(Request $request, Response $response, array $params = []): void
    {
        $id = (int) ($params['id'] ?? 0);
        /** @var TenantRepository $tenantRepo */
        $tenantRepo = $this->container->get('tenantRepository');
        $session = $this->container->get('session');

        $days = (int) ($request->getParsedBody()['dias'] ?? 7);
        $success = $tenantRepo->extendTrial($id, $days);

        if ($success) {
            $session->setFlash('success', "Degustação prorrogada em +{$days} dias com sucesso!");
        } else {
            $session->setFlash('error', "Não foi possível prorrogar a degustação deste tenant.");
        }

        $response->redirect('/admin/tenants');
    }

    public function impersonate(Request $request, Response $response, array $params = []): void
    {
        $id = (int) ($params['id'] ?? 0);
        /** @var TenantRepository $tenantRepo */
        $tenantRepo = $this->container->get('tenantRepository');
        $session = $this->container->get('session');

        $tenant = $tenantRepo->findById($id);
        if (!$tenant) {
            $session->setFlash('error', 'Tenant não encontrado.');
            $response->redirect('/admin/tenants');
            return;
        }

        // Salvar sessão com o tenant selecionado pelo Superadmin para impersonação
        $session->set('tenant_id', (int) $tenant['id']);
        $session->set('tenant_slug', (string) $tenant['slug']);
        $session->set('tenant_plano', (string) ($tenant['plano'] ?? 'mvp'));
        $session->setFlash('success', "Acessando painel do tenant '{$tenant['nome']}' como Superadmin.");

        $response->redirect("/{$tenant['slug']}/painel");
    }
}
