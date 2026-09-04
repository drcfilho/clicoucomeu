<?php

declare(strict_types=1);

namespace App\Config;

function appConfig(): array
{
    $env = env('APP_ENV', 'production');
    $key = env('APP_KEY', '');

    if ($env === 'production' && empty($key)) {
        throw new \RuntimeException('APP_KEY obrigatória não configurada no ambiente de produção.');
    }

    return [
        'name' => env('APP_NAME', 'Clicou Comeu'),
        'env' => $env,
        'debug' => filter_var(env('APP_DEBUG', false), FILTER_VALIDATE_BOOL),
        'url' => env('APP_URL', 'http://localhost'),
        'key' => $key,
        'timezone' => env('APP_TIMEZONE', 'America/Sao_Paulo'),
        'session' => [
            'name' => env('SESSION_NAME', 'clicoucomeu_session'),
            'lifetime' => (int) env('SESSION_LIFETIME', 120),
            'secure' => filter_var(env('SESSION_SECURE', false), FILTER_VALIDATE_BOOL),
            'same_site' => env('SESSION_SAMESITE', 'Lax'),
        ],
        'auth' => [
            'max_attempts' => (int) env('AUTH_MAX_ATTEMPTS', 5),
            'lockout_seconds' => (int) env('AUTH_LOCKOUT_SECONDS', 900),
        ],
        'dev' => [
            'bypass_store_hours' => filter_var(env('DEV_BYPASS_STORE_HOURS', false), FILTER_VALIDATE_BOOL),
        ],
    ];
}
