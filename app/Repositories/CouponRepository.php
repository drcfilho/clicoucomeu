<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class CouponRepository
{
    public function __construct(private ?PDO $db)
    {
    }

    public function findAllByTenantId(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT * FROM cupons WHERE tenant_id = :tenant_id ORDER BY id DESC'
        );
        $stmt->execute(['tenant_id' => $tenantId]);

        return $stmt->fetchAll() ?: [];
    }

    public function findByCode(int $tenantId, string $code): ?array
    {
        if ($this->db === null) {
            return null;
        }

        $stmt = $this->db->prepare(
            'SELECT * FROM cupons WHERE tenant_id = :tenant_id AND codigo = :codigo AND ativo = 1'
        );
        $stmt->execute([
            'tenant_id' => $tenantId,
            'codigo' => strtoupper(trim($code)),
        ]);

        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): int
    {
        if ($this->db === null) {
            return 0;
        }

        $stmt = $this->db->prepare(
            'INSERT INTO cupons 
             (tenant_id, codigo, tipo, valor, valor_minimo, data_inicio, data_fim, limite_usos, usos, ativo)
             VALUES
             (:tenant_id, :codigo, :tipo, :valor, :valor_minimo, :data_inicio, :data_fim, :limite_usos, 0, 1)'
        );

        $stmt->execute([
            'tenant_id' => $data['tenant_id'],
            'codigo' => strtoupper(trim($data['codigo'])),
            'tipo' => $data['tipo'], // 'percentual', 'valor', 'frete_gratis'
            'valor' => (float) ($data['valor'] ?? 0.00),
            'valor_minimo' => isset($data['valor_minimo']) && $data['valor_minimo'] !== '' ? (float) $data['valor_minimo'] : null,
            'data_inicio' => !empty($data['data_inicio']) ? $data['data_inicio'] : null,
            'data_fim' => !empty($data['data_fim']) ? $data['data_fim'] : null,
            'limite_usos' => isset($data['limite_usos']) && $data['limite_usos'] !== '' ? (int) $data['limite_usos'] : null,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, int $tenantId, array $data): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE cupons
             SET codigo = :codigo, tipo = :tipo, valor = :valor, valor_minimo = :valor_minimo,
                 data_inicio = :data_inicio, data_fim = :data_fim, limite_usos = :limite_usos, ativo = :ativo
             WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute([
            'id' => $id,
            'tenant_id' => $tenantId,
            'codigo' => strtoupper(trim($data['codigo'])),
            'tipo' => $data['tipo'],
            'valor' => (float) ($data['valor'] ?? 0.00),
            'valor_minimo' => isset($data['valor_minimo']) && $data['valor_minimo'] !== '' ? (float) $data['valor_minimo'] : null,
            'data_inicio' => !empty($data['data_inicio']) ? $data['data_inicio'] : null,
            'data_fim' => !empty($data['data_fim']) ? $data['data_fim'] : null,
            'limite_usos' => isset($data['limite_usos']) && $data['limite_usos'] !== '' ? (int) $data['limite_usos'] : null,
            'ativo' => (int) ($data['ativo'] ?? 1),
        ]);
    }

    public function incrementUsage(int $couponId): void
    {
        if ($this->db === null) {
            return;
        }

        $stmt = $this->db->prepare('UPDATE cupons SET usos = usos + 1 WHERE id = :id');
        $stmt->execute(['id' => $couponId]);
    }

    public function toggleStatus(int $id, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE cupons SET ativo = CASE WHEN ativo = 1 THEN 0 ELSE 1 END WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }

    public function delete(int $id, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare('DELETE FROM cupons WHERE id = :id AND tenant_id = :tenant_id');
        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }
}
