<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class UserRepository
{
    public function __construct(private ?PDO $db)
    {
    }

    public function findActiveByUsername(string $username): ?array
    {
        if ($this->db === null) {
            return null;
        }

        $stmt = $this->db->prepare(
            'SELECT u.*, t.nome AS tenant_nome, t.slug AS tenant_slug, t.status AS tenant_status
             FROM usuarios u
             LEFT JOIN tenants t ON t.id = u.tenant_id
             WHERE u.usuario = :usuario AND u.ativo = 1
             LIMIT 1'
        );
        $stmt->execute(['usuario' => $username]);

        $user = $stmt->fetch();

        return is_array($user) ? $user : null;
    }

    public function updateLastLogin(int $userId): void
    {
        if ($this->db === null) {
            return;
        }

        $stmt = $this->db->prepare('UPDATE usuarios SET ultimo_login = UTC_TIMESTAMP() WHERE id = :id');
        $stmt->execute(['id' => $userId]);
    }
}
