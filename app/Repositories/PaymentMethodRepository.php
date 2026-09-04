<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class PaymentMethodRepository
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
            'SELECT id, nome, tipo, pedir_troco, dados_pix
             FROM formas_pagamento
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

    public function findAllByTenantId(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT * FROM formas_pagamento
             WHERE tenant_id = :tenant_id
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

        $stmt = $this->db->prepare('SELECT * FROM formas_pagamento WHERE id = :id AND tenant_id = :tenant_id');
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
            $stmt = $this->db->prepare('SELECT COALESCE(MAX(ordem), 0) + 1 FROM formas_pagamento WHERE tenant_id = :tenant_id');
            $stmt->execute(['tenant_id' => $data['tenant_id']]);
            $data['ordem'] = (int) $stmt->fetchColumn();
        }

        $stmt = $this->db->prepare(
            'INSERT INTO formas_pagamento (tenant_id, nome, tipo, pedir_troco, dados_pix, ordem, ativo)
             VALUES (:tenant_id, :nome, :tipo, :pedir_troco, :dados_pix, :ordem, :ativo)'
        );
        $stmt->execute([
            'tenant_id' => $data['tenant_id'],
            'nome' => $data['nome'],
            'tipo' => $data['tipo'], // dinheiro, pix, credito, debito, outro
            'pedir_troco' => (int) ($data['pedir_troco'] ?? 0),
            'dados_pix' => $data['dados_pix'] ?? null,
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
            'UPDATE formas_pagamento
             SET nome = :nome, tipo = :tipo, pedir_troco = :pedir_troco, dados_pix = :dados_pix, ordem = :ordem, ativo = :ativo
             WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute([
            'id' => $id,
            'tenant_id' => $tenantId,
            'nome' => $data['nome'],
            'tipo' => $data['tipo'],
            'pedir_troco' => (int) ($data['pedir_troco'] ?? 0),
            'dados_pix' => $data['dados_pix'] ?? null,
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
            'UPDATE formas_pagamento SET ativo = CASE WHEN ativo = 1 THEN 0 ELSE 1 END WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }

    public function delete(int $id, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare('DELETE FROM formas_pagamento WHERE id = :id AND tenant_id = :tenant_id');
        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }
}
