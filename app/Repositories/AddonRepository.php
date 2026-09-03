<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class AddonRepository
{
    public function __construct(private ?PDO $db)
    {
    }

    /* --- GRUPOS DE ADICIONAIS --- */

    public function findAllGroupsByTenantId(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT g.*, 
                    (SELECT COUNT(*) FROM adicionais a WHERE a.grupo_id = g.id AND a.ativo = 1) AS total_adicionais,
                    (SELECT COUNT(*) FROM produto_grupos_adicionais pga WHERE pga.grupo_id = g.id) AS total_produtos
             FROM grupos_adicionais g
             WHERE g.tenant_id = :tenant_id AND g.ativo = 1
             ORDER BY g.ordem ASC, g.id DESC'
        );
        $stmt->execute(['tenant_id' => $tenantId]);

        return $stmt->fetchAll() ?: [];
    }

    public function findGroupById(int $id, int $tenantId): ?array
    {
        if ($this->db === null) {
            return null;
        }

        $stmt = $this->db->prepare(
            'SELECT * FROM grupos_adicionais WHERE id = :id AND tenant_id = :tenant_id AND ativo = 1'
        );
        $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function createGroup(array $data): int
    {
        if ($this->db === null) {
            return 0;
        }

        if (!isset($data['ordem']) || $data['ordem'] === null) {
            $stmt = $this->db->prepare('SELECT COALESCE(MAX(ordem), 0) + 1 FROM grupos_adicionais WHERE tenant_id = :tenant_id');
            $stmt->execute(['tenant_id' => $data['tenant_id']]);
            $data['ordem'] = (int) $stmt->fetchColumn();
        }

        $stmt = $this->db->prepare(
            'INSERT INTO grupos_adicionais (tenant_id, nome, minimo, maximo, obrigatorio, ordem, ativo)
             VALUES (:tenant_id, :nome, :minimo, :maximo, :obrigatorio, :ordem, 1)'
        );
        $stmt->execute([
            'tenant_id' => $data['tenant_id'],
            'nome' => $data['nome'],
            'minimo' => (int) ($data['minimo'] ?? 0),
            'maximo' => (int) ($data['maximo'] ?? 1),
            'obrigatorio' => (int) ($data['obrigatorio'] ?? 0),
            'ordem' => (int) $data['ordem'],
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function updateGroup(int $id, int $tenantId, array $data): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE grupos_adicionais
             SET nome = :nome, minimo = :minimo, maximo = :maximo, obrigatorio = :obrigatorio, ordem = :ordem
             WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute([
            'id' => $id,
            'tenant_id' => $tenantId,
            'nome' => $data['nome'],
            'minimo' => (int) ($data['minimo'] ?? 0),
            'maximo' => (int) ($data['maximo'] ?? 1),
            'obrigatorio' => (int) ($data['obrigatorio'] ?? 0),
            'ordem' => (int) ($data['ordem'] ?? 0),
        ]);
    }

    public function deleteGroup(int $id, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare('UPDATE grupos_adicionais SET ativo = 0 WHERE id = :id AND tenant_id = :tenant_id');
        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }

    /* --- ITENS ADICIONAIS --- */

    public function findAddonsByGroupId(int $groupId, int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT * FROM adicionais 
             WHERE grupo_id = :grupo_id AND tenant_id = :tenant_id AND ativo = 1
             ORDER BY ordem ASC, id ASC'
        );
        $stmt->execute(['grupo_id' => $groupId, 'tenant_id' => $tenantId]);

        return $stmt->fetchAll() ?: [];
    }

    public function createAddon(array $data): int
    {
        if ($this->db === null) {
            return 0;
        }

        if (!isset($data['ordem']) || $data['ordem'] === null) {
            $stmt = $this->db->prepare('SELECT COALESCE(MAX(ordem), 0) + 1 FROM adicionais WHERE grupo_id = :grupo_id');
            $stmt->execute(['grupo_id' => $data['grupo_id']]);
            $data['ordem'] = (int) $stmt->fetchColumn();
        }

        $stmt = $this->db->prepare(
            'INSERT INTO adicionais (tenant_id, grupo_id, nome, preco, ordem, ativo)
             VALUES (:tenant_id, :grupo_id, :nome, :preco, :ordem, 1)'
        );
        $stmt->execute([
            'tenant_id' => $data['tenant_id'],
            'grupo_id' => $data['grupo_id'],
            'nome' => $data['nome'],
            'preco' => (float) ($data['preco'] ?? 0.00),
            'ordem' => (int) $data['ordem'],
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function updateAddon(int $id, int $tenantId, array $data): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE adicionais
             SET nome = :nome, preco = :preco, ordem = :ordem
             WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute([
            'id' => $id,
            'tenant_id' => $tenantId,
            'nome' => $data['nome'],
            'preco' => (float) ($data['preco'] ?? 0.00),
            'ordem' => (int) ($data['ordem'] ?? 0),
        ]);
    }

    public function deleteAddon(int $id, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare('UPDATE adicionais SET ativo = 0 WHERE id = :id AND tenant_id = :tenant_id');
        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }

    /* --- VÍNCULOS COM PRODUTOS --- */

    public function findAssociatedProductIds(int $groupId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare('SELECT produto_id FROM produto_grupos_adicionais WHERE grupo_id = :grupo_id');
        $stmt->execute(['grupo_id' => $groupId]);

        return array_column($stmt->fetchAll() ?: [], 'produto_id');
    }

    public function syncProductGroups(int $groupId, array $productIds): void
    {
        if ($this->db === null) {
            return;
        }

        $this->db->beginTransaction();
        try {
            $stmtDel = $this->db->prepare('DELETE FROM produto_grupos_adicionais WHERE grupo_id = :grupo_id');
            $stmtDel->execute(['grupo_id' => $groupId]);

            if (!empty($productIds)) {
                $stmtIns = $this->db->prepare('INSERT INTO produto_grupos_adicionais (produto_id, grupo_id) VALUES (:produto_id, :grupo_id)');
                foreach ($productIds as $prodId) {
                    $stmtIns->execute(['produto_id' => (int) $prodId, 'grupo_id' => $groupId]);
                }
            }
            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
        }
    }
}
