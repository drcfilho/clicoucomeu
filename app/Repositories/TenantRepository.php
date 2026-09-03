<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class TenantRepository
{
    public function __construct(private ?PDO $db)
    {
    }

    public function all(): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->query(
            'SELECT id, nome, slug, cidade, uf, status, plano, criado_em
             FROM tenants
             ORDER BY nome ASC'
        );

        $rows = $stmt !== false ? $stmt->fetchAll() : [];

        return is_array($rows) ? $rows : [];
    }
}
