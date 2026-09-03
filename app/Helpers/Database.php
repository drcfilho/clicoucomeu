<?php

declare(strict_types=1);

namespace App\Helpers;

use PDO;
use PDOException;

class Database
{
    public static function connect(array $config, string $timezone = 'America/Sao_Paulo'): ?PDO
    {
        try {
            $pdo = new PDO(
                sprintf(
                    'mysql:host=%s;port=%d;dbname=%s;charset=%s',
                    $config['host'],
                    $config['port'],
                    $config['database'],
                    $config['charset']
                ),
                $config['username'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );

            // Sincroniza timezone da sessao do MySQL com o fuso horario do .env (ex: -03:00)
            try {
                $now = new \DateTime('now', new \DateTimeZone($timezone));
                $offset = $now->format('P'); // ex: -03:00
                $pdo->exec("SET time_zone = '{$offset}'");
            } catch (\Throwable) {
                // fallback
            }

            return $pdo;
        } catch (PDOException) {
            return null;
        }
    }
}
