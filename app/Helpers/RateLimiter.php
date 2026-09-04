<?php

declare(strict_types=1);

namespace App\Helpers;

class RateLimiter
{
    /**
     * Verifica se o limite de requisições por chave/IP foi excedido em um determinado intervalo de tempo.
     *
     * @param string $key Chave de identificação (ex: ip + rota)
     * @param int $maxAttempts Número máximo de tentativas permitidas
     * @param int $decaySeconds Tempo em segundos para expiração do contador
     * @return bool Retorna true se permitido, false se excedido
     */
    public static function check(string $key, int $maxAttempts = 10, int $decaySeconds = 60): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $now = time();
        $storageKey = '_rate_limit_' . md5($key);
        $attemptsData = $_SESSION[$storageKey] ?? ['attempts' => 0, 'reset_at' => $now + $decaySeconds];

        if ($now > $attemptsData['reset_at']) {
            $attemptsData = ['attempts' => 1, 'reset_at' => $now + $decaySeconds];
        } else {
            $attemptsData['attempts'] += 1;
        }

        $_SESSION[$storageKey] = $attemptsData;

        return $attemptsData['attempts'] <= $maxAttempts;
    }
}
