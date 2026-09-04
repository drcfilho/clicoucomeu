<?php

declare(strict_types=1);

namespace App\Controllers\Public;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Repositories\TenantRepository;
use App\Repositories\UserRepository;
use PDO;

class RegisterController
{
    private TenantRepository $tenantRepo;
    private UserRepository $userRepo;
    private Session $session;
    private ?PDO $db;

    public function __construct(private Container $container)
    {
        $this->tenantRepo = $container->get(TenantRepository::class);
        $this->userRepo = $container->get(UserRepository::class);
        $this->session = $container->get(Session::class);
        $this->db = $container->get('db');
    }

    public function showRegister(Request $request, Response $response): void
    {
        $plan = (string) $request->get('plano', 'mvp');
        if (!in_array($plan, ['mvp', 'starter', 'pro', 'enterprise'], true)) {
            $plan = 'mvp';
        }

        $response->view('public.register', [
            'plan' => $plan,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'errors' => [],
            'form' => [],
        ]);
    }

    public function register(Request $request, Response $response): void
    {
        $data = $request->getParsedBody();
        $errors = [];

        $nome = trim((string) ($data['nome'] ?? ''));
        $slug = mb_strtolower(trim((string) ($data['slug'] ?? '')));
        $whatsapp = preg_replace('/\D/', '', (string) ($data['whatsapp'] ?? ''));
        $cidade = trim((string) ($data['cidade'] ?? ''));
        $plano = (string) ($data['plano'] ?? 'mvp');

        $adminNome = trim((string) ($data['admin_nome'] ?? ''));
        $adminUsuario = mb_strtolower(trim((string) ($data['admin_usuario'] ?? '')));
        $adminSenha = (string) ($data['admin_senha'] ?? '');

        // Sanitizar slug
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');

        if (empty($nome)) {
            $errors[] = 'O nome do restaurante é obrigatório.';
        }
        if (empty($slug)) {
            $errors[] = 'O link do cardápio (slug) é obrigatório.';
        } elseif ($this->tenantRepo->findBySlug($slug)) {
            $errors[] = 'Este link/slug já está em uso por outro restaurante. Escolha outro.';
        }

        if (empty($adminNome)) {
            $errors[] = 'O nome do proprietário é obrigatório.';
        }
        if (empty($adminUsuario)) {
            $errors[] = 'O usuário para acesso é obrigatório.';
        } elseif ($this->userRepo->findByUsuario($adminUsuario)) {
            $errors[] = 'Este nome de usuário já está cadastrado no sistema.';
        }

        if (strlen($adminSenha) < 6) {
            $errors[] = 'A senha deve ter pelo menos 6 caracteres.';
        }

        if ($errors !== []) {
            $response->view('public.register', [
                'plan' => $plano,
                'csrfToken' => $request->getAttribute('csrf_token'),
                'errors' => $errors,
                'form' => $data,
            ]);
            return;
        }

        // Criar Tenant e Usuário em Transação
        try {
            if ($this->db) {
                $this->db->beginTransaction();
            }

            $tenantId = $this->tenantRepo->create([
                'nome' => $nome,
                'slug' => $slug,
                'whatsapp' => $whatsapp ?: null,
                'cidade' => $cidade ?: null,
                'plano' => $plano,
                'status' => 'ativo',
                'timezone' => 'America/Sao_Paulo',
            ]);

            $senhaHash = password_hash($adminSenha, PASSWORD_DEFAULT);
            $this->userRepo->create([
                'tenant_id' => $tenantId,
                'nome' => $adminNome,
                'usuario' => $adminUsuario,
                'senha' => $senhaHash,
                'perfil' => 'admin',
                'ativo' => 1,
            ]);

            if ($this->db) {
                $this->db->commit();
            }

            // Auto-login do proprietário recém-criado
            $this->session->regenerate();
            $this->session->set('user_id', $tenantId);
            $this->session->set('tenant_id', $tenantId);
            $this->session->set('tenant_slug', $slug);
            $this->session->set('tenant_plano', $plano);
            $this->session->set('perfil', 'admin');
            $this->session->set('user_nome', $adminNome);

            $this->session->setFlash('success', 'Restaurante cadastrado com sucesso! Bem-vindo ao Clicou Comeu.');
            $response->redirect("/{$slug}/painel");
        } catch (\Throwable $e) {
            if ($this->db && $this->db->inTransaction()) {
                $this->db->rollBack();
            }

            $response->view('public.register', [
                'plan' => $plano,
                'csrfToken' => $request->getAttribute('csrf_token'),
                'errors' => ['Ocorreu um erro ao criar sua conta: ' . $e->getMessage()],
                'form' => $data,
            ]);
        }
    }
}
