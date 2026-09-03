<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class NeighborhoodRepository
{
    public function __construct(private ?PDO $db)
    {
    }

    public function findActiveByTenantId(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT id, nome, taxa_entrega, pedido_minimo, tempo_estimado_min
             FROM bairros
             WHERE tenant_id = :tenant_id AND ativo = 1
             ORDER BY ordem ASC, id ASC'
        );
        $stmt->execute(['tenant_id' => $tenantId]);

        return $stmt->fetchAll() ?: [];
    }

    public function findIndexedByTenantId(int $tenantId): array
    {
        $rows = $this->findActiveByTenantId($tenantId);
        $indexed = [];

        foreach ($rows as $row) {
            $indexed[(int) $row['id']] = $row;
        }

        return $indexed;
    }
}
