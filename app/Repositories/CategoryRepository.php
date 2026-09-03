<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class CategoryRepository
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
            'SELECT id, tenant_id, nome, descricao, ordem, ativo, criado_em, atualizado_em
             FROM categorias
             WHERE tenant_id = :tenant_id
             ORDER BY ordem ASC, id ASC'
        );
        $stmt->execute(['tenant_id' => $tenantId]);

        return $stmt->fetchAll() ?: [];
    }

    public function findActiveByTenantId(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT id, nome, descricao, ordem
             FROM categorias
             WHERE tenant_id = :tenant_id AND ativo = 1
             ORDER BY ordem ASC, id ASC'
        );
        $stmt->execute(['tenant_id' => $tenantId]);

        return $stmt->fetchAll() ?: [];
    }

    public function findById(int $id, int $tenantId): ?array
    {
        if ($this->db === null) {
            return null;
        }

        $stmt = $this->db->prepare(
            'SELECT id, tenant_id, nome, descricao, ordem, ativo
             FROM categorias
             WHERE id = :id AND tenant_id = :tenant_id'
        );
        $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
        $result = $stmt->fetch();

        return $result ?: null;
    }

    public function create(array $data): int
    {
        if ($this->db === null) {
            return 0;
        }

        // Se ordem nao informada, busca proxima ordem
        if (!isset($data['ordem']) || $data['ordem'] === null) {
            $stmt = $this->db->prepare('SELECT COALESCE(MAX(ordem), 0) + 1 FROM categorias WHERE tenant_id = :tenant_id');
            $stmt->execute(['tenant_id' => $data['tenant_id']]);
            $data['ordem'] = (int) $stmt->fetchColumn();
        }

        $stmt = $this->db->prepare(
            'INSERT INTO categorias (tenant_id, nome, descricao, ordem, ativo)
             VALUES (:tenant_id, :nome, :descricao, :ordem, :ativo)'
        );
        $stmt->execute([
            'tenant_id' => $data['tenant_id'],
            'nome' => $data['nome'],
            'descricao' => $data['descricao'] ?? null,
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
            'UPDATE categorias
             SET nome = :nome, descricao = :descricao, ordem = :ordem, ativo = :ativo, atualizado_em = NOW()
             WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute([
            'id' => $id,
            'tenant_id' => $tenantId,
            'nome' => $data['nome'],
            'descricao' => $data['descricao'] ?? null,
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
            'UPDATE categorias
             SET ativo = CASE WHEN ativo = 1 THEN 0 ELSE 1 END, atualizado_em = NOW()
             WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }

    public function delete(int $id, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare('DELETE FROM categorias WHERE id = :id AND tenant_id = :tenant_id');
        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }

    public function reorder(int $tenantId, array $orders): bool
    {
        if ($this->db === null || empty($orders)) {
            return false;
        }

        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare('UPDATE categorias SET ordem = :ordem WHERE id = :id AND tenant_id = :tenant_id');
            foreach ($orders as $id => $ordem) {
                $stmt->execute([
                    'id' => (int) $id,
                    'ordem' => (int) $ordem,
                    'tenant_id' => $tenantId
                ]);
            }
            $this->db->commit();
            return true;
        } catch (\Throwable $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
