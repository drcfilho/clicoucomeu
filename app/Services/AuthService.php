<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\Session;
use App\Repositories\UserRepository;

class AuthService
{
    private const THROTTLE_KEY = '_auth_throttle';

    public function __construct(
        private UserRepository $users,
        private Session $session,
        private array $config = []
    ) {
    }

    public function attempt(string $username, string $password, string $ipAddress = '0.0.0.0'): array
    {
        $throttleKey = $this->throttleKey($username, $ipAddress);
        $lockMessage = $this->guardAgainstBruteForce($throttleKey);

        if ($lockMessage !== null) {
            return ['success' => false, 'message' => $lockMessage];
        }

        $user = $this->users->findActiveByUsername($username);

        if ($user === null) {
            $this->registerFailedAttempt($throttleKey);
            return ['success' => false, 'message' => 'Usuario ou senha invalidos'];
        }

        if (($user['tenant_status'] ?? 'ativo') !== 'ativo' && $user['perfil'] !== 'superadmin') {
            return ['success' => false, 'message' => 'Tenant inativo'];
        }

        if (!password_verify($password, $user['senha_hash'])) {
            $this->registerFailedAttempt($throttleKey);
            return ['success' => false, 'message' => 'Usuario ou senha invalidos'];
        }

        $this->clearFailedAttempts($throttleKey);
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

    private function throttleKey(string $username, string $ipAddress): string
    {
        return sha1(strtolower(trim($username)) . '|' . trim($ipAddress));
    }

    private function guardAgainstBruteForce(string $throttleKey): ?string
    {
        $state = $this->throttleState();
        $entry = $state[$throttleKey] ?? null;

        if (!is_array($entry)) {
            return null;
        }

        $lockedUntil = (int) ($entry['locked_until'] ?? 0);

        if ($lockedUntil <= time()) {
            if ($lockedUntil > 0) {
                unset($state[$throttleKey]);
                $this->writeThrottleState($state);
            }

            return null;
        }

        $remainingSeconds = max(1, $lockedUntil - time());

        return sprintf(
            'Muitas tentativas. Tente novamente em %d minuto(s).',
            (int) ceil($remainingSeconds / 60)
        );
    }

    private function registerFailedAttempt(string $throttleKey): void
    {
        $state = $this->throttleState();
        $entry = $state[$throttleKey] ?? [
            'attempts' => 0,
            'locked_until' => 0,
        ];

        $entry['attempts'] = (int) ($entry['attempts'] ?? 0) + 1;

        if ($entry['attempts'] >= $this->maxAttempts()) {
            $entry['attempts'] = 0;
            $entry['locked_until'] = time() + $this->lockoutSeconds();
        }

        $state[$throttleKey] = $entry;
        $this->writeThrottleState($state);
    }

    private function clearFailedAttempts(string $throttleKey): void
    {
        $state = $this->throttleState();

        if (!array_key_exists($throttleKey, $state)) {
            return;
        }

        unset($state[$throttleKey]);
        $this->writeThrottleState($state);
    }

    private function throttleState(): array
    {
        $state = $this->session->get(self::THROTTLE_KEY, []);

        return is_array($state) ? $state : [];
    }

    private function writeThrottleState(array $state): void
    {
        $this->session->set(self::THROTTLE_KEY, $state);
    }

    private function maxAttempts(): int
    {
        $value = (int) ($this->config['max_attempts'] ?? 5);

        return $value > 0 ? $value : 5;
    }

    private function lockoutSeconds(): int
    {
        $value = (int) ($this->config['lockout_seconds'] ?? 900);

        return $value > 0 ? $value : 900;
    }
}
