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

    public function findAllByTenantId(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT * FROM bairros
             WHERE tenant_id = :tenant_id
             ORDER BY ordem ASC, nome ASC'
        );
        $stmt->execute(['tenant_id' => $tenantId]);

        return $stmt->fetchAll() ?: [];
    }

    public function findById(int $id, int $tenantId): ?array
    {
        if ($this->db === null) {
            return null;
        }

        $stmt = $this->db->prepare('SELECT * FROM bairros WHERE id = :id AND tenant_id = :tenant_id');
        $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function create(array $data): int
    {
        if ($this->db === null) {
            return 0;
        }

        if (!isset($data['ordem']) || $data['ordem'] === null) {
            $stmt = $this->db->prepare('SELECT COALESCE(MAX(ordem), 0) + 1 FROM bairros WHERE tenant_id = :tenant_id');
            $stmt->execute(['tenant_id' => $data['tenant_id']]);
            $data['ordem'] = (int) $stmt->fetchColumn();
        }

        $stmt = $this->db->prepare(
            'INSERT INTO bairros (tenant_id, nome, taxa_entrega, pedido_minimo, tempo_estimado_min, ordem, ativo)
             VALUES (:tenant_id, :nome, :taxa_entrega, :pedido_minimo, :tempo_estimado_min, :ordem, :ativo)'
        );
        $stmt->execute([
            'tenant_id' => $data['tenant_id'],
            'nome' => $data['nome'],
            'taxa_entrega' => (float) ($data['taxa_entrega'] ?? 0.00),
            'pedido_minimo' => (float) ($data['pedido_minimo'] ?? 0.00),
            'tempo_estimado_min' => isset($data['tempo_estimado_min']) && $data['tempo_estimado_min'] !== '' ? (int) $data['tempo_estimado_min'] : null,
            'ordem' => (int) $data['ordem'],
            'ativo' => (int) ($data['ativo'] ?? 1),
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, int $tenantId, array $data): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE bairros
             SET nome = :nome, taxa_entrega = :taxa_entrega, pedido_minimo = :pedido_minimo, 
                 tempo_estimado_min = :tempo_estimado_min, ordem = :ordem, ativo = :ativo
             WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute([
            'id' => $id,
            'tenant_id' => $tenantId,
            'nome' => $data['nome'],
            'taxa_entrega' => (float) ($data['taxa_entrega'] ?? 0.00),
            'pedido_minimo' => (float) ($data['pedido_minimo'] ?? 0.00),
            'tempo_estimado_min' => isset($data['tempo_estimado_min']) && $data['tempo_estimado_min'] !== '' ? (int) $data['tempo_estimado_min'] : null,
            'ordem' => (int) ($data['ordem'] ?? 0),
            'ativo' => (int) ($data['ativo'] ?? 1),
        ]);
    }

    public function toggleStatus(int $id, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE bairros SET ativo = CASE WHEN ativo = 1 THEN 0 ELSE 1 END WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }

    public function delete(int $id, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare('DELETE FROM bairros WHERE id = :id AND tenant_id = :tenant_id');
        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }
}
