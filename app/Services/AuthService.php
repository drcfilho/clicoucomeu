<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\Session;
use App\Repositories\UserRepository;

class AuthService
{
    public function __construct(
        private UserRepository $users,
        private Session $session
    ) {
    }

    public function attempt(string $username, string $password): array
    {
        $user = $this->users->findActiveByUsername($username);

        if ($user === null) {
            return ['success' => false, 'message' => 'Usuario ou senha invalidos'];
        }

        if (($user['tenant_status'] ?? 'ativo') !== 'ativo' && $user['perfil'] !== 'superadmin') {
            return ['success' => false, 'message' => 'Tenant inativo'];
        }

        if (!password_verify($password, $user['senha_hash'])) {
            return ['success' => false, 'message' => 'Usuario ou senha invalidos'];
        }

        $this->session->regenerate();
        $this->session->set('usuario_id', (int) $user['id']);
        $this->session->set('tenant_id', $user['tenant_id'] !== null ? (int) $user['tenant_id'] : null);
        $this->session->set('perfil', $user['perfil']);
        $this->session->set('nome', $user['nome']);
        $this->session->touch();
        $this->users->updateLastLogin((int) $user['id']);

        return ['success' => true, 'message' => 'Login realizado'];
    }

    public function logout(): void
    {
        $this->session->destroy();
        $this->session->start();
    }
}
