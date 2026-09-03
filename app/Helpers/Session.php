<?php

declare(strict_types=1);

namespace App\Helpers;

class Session
{
    private const LAST_ACTIVITY_KEY = '_last_activity_at';

    public function __construct(private array $config)
    {
    }

    public function start(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        session_name($this->config['name']);
        session_set_cookie_params([
            'lifetime' => $this->config['lifetime'] * 60,
            'path' => '/',
            'secure' => $this->config['secure'],
            'httponly' => true,
            'samesite' => $this->config['same_site'],
        ]);

        session_start();

        $this->touch();
    }

    public function isExpired(): bool
    {
        $lastActivity = $this->get(self::LAST_ACTIVITY_KEY);

        if (!is_int($lastActivity)) {
            return false;
        }

        return $lastActivity < (time() - ($this->config['lifetime'] * 60));
    }

    public function touch(): void
    {
        $_SESSION[self::LAST_ACTIVITY_KEY] = time();
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function pull(string $key, mixed $default = null): mixed
    {
        $value = $this->get($key, $default);
        unset($_SESSION[$key]);

        return $value;
    }

    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public function regenerate(): void
    {
        session_regenerate_id(true);
    }

    public function destroy(): void
    {
        $_SESSION = [];

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}
