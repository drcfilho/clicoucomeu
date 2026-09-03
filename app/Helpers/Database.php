<?php

declare(strict_types=1);

namespace App\Helpers;

use PDO;
use PDOException;

class Database
{
    public static function connect(array $config): ?PDO
    {
        try {
            return new PDO(
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
        } catch (PDOException) {
            return null;
        }
    }
}
