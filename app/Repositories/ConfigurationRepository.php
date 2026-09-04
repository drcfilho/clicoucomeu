<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class ConfigurationRepository
{
    public function __construct(private ?PDO $db)
    {
    }

    public function findByTenantId(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT chave, valor
             FROM configuracoes
             WHERE tenant_id = :tenant_id'
        );
        $stmt->execute(['tenant_id' => $tenantId]);

        $rows = $stmt->fetchAll() ?: [];
        $config = [];

        foreach ($rows as $row) {
            $config[(string) $row['chave']] = (string) ($row['valor'] ?? '');
        }

        return $config;
    }

    public function saveConfig(int $tenantId, string $chave, ?string $valor): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            'INSERT INTO configuracoes (tenant_id, chave, valor)
             VALUES (:tenant_id, :chave, :valor)
             ON DUPLICATE KEY UPDATE valor = VALUES(valor), atualizado_em = CURRENT_TIMESTAMP'
        );

        return $stmt->execute([
            'tenant_id' => $tenantId,
            'chave' => $chave,
            'valor' => $valor,
        ]);
    }
}
