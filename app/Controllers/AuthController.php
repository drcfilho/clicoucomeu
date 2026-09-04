<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Services\AuthService;

class AuthController
{
    public function __construct(private Container $container)
    {
    }

    public function showLogin(Request $request, Response $response, array $params = []): void
    {
        $session = $this->container->get('session');
        $csrf = $this->container->get('csrf');

        if ($session->has('usuario_id')) {
            $tenantSlug = (string) $session->get('tenant_slug', '');
            $perfil = (string) $session->get('perfil', '');
            if ($perfil === 'superadmin' && !$tenantSlug) {
                $response->redirect('/admin');
            } elseif ($tenantSlug !== '') {
                $response->redirect("/{$tenantSlug}/painel");
            } else {
                $response->redirect('/painel');
            }
            return;
        }

        $response->view('auth.login', [
            'csrfToken' => $csrf->token(),
            'error' => $session->get('auth_error'),
        ]);

        $session->set('auth_error', null);
    }

    public function login(Request $request, Response $response, array $params = []): void
    {
        $csrf = $this->container->get('csrf');
        $validator = $this->container->get('validator');
        $session = $this->container->get('session');

        if (!$csrf->validate((string) $request->input('_csrf'))) {
            $session->set('auth_error', 'Token CSRF invalido');
            $response->redirect('/login');
        }

        $ip = $request->ip();
        if (!\App\Helpers\RateLimiter::check('login_' . $ip, 5, 60)) {
            $session->set('auth_error', 'Muitas tentativas incorretas. Aguarde 1 minuto para tentar novamente.');
            $response->redirect('/login');
            return;
        }

        $data = $request->all();
        $errors = $validator->required($data, ['usuario', 'senha']);

        if ($errors !== []) {
            $session->set('auth_error', 'Usuario e senha sao obrigatorios');
            $response->redirect('/login');
        }

        /** @var AuthService $auth */
        $auth = $this->container->get('auth');
        $result = $auth->attempt((string) $data['usuario'], (string) $data['senha'], $request->ip());

        if (!$result['success']) {
            $session->set('auth_error', $result['message']);
            $response->redirect('/login');
            return;
        }

        $tenantSlug = (string) ($result['tenant_slug'] ?? $session->get('tenant_slug', ''));
        $perfil = (string) $session->get('perfil', '');

        if ($perfil === 'superadmin' && !$tenantSlug) {
            $response->redirect('/admin');
        } elseif ($tenantSlug !== '') {
            $response->redirect("/{$tenantSlug}/painel");
        } else {
            $response->redirect('/painel');
        }
    }

    public function logout(Request $request, Response $response, array $params = []): void
    {
        /** @var AuthService $auth */
        $auth = $this->container->get('auth');
        $auth->logout();

        $response->view('auth.logout');
    }
}
