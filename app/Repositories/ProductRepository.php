<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class ProductRepository
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
            'SELECT
                p.id,
                p.categoria_id,
                p.nome,
                p.slug,
                p.descricao,
                p.preco,
                p.imagem,
                p.destaque,
                p.disponivel
             FROM produtos p
             WHERE p.tenant_id = :tenant_id
               AND p.ativo = 1
             ORDER BY p.ordem ASC, p.id ASC'
        );
        $stmt->execute(['tenant_id' => $tenantId]);

        return $stmt->fetchAll() ?: [];
    }

    public function findVariationsByTenantId(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT produto_id, id, nome, preco, ordem
             FROM produto_variacoes
             WHERE tenant_id = :tenant_id AND ativo = 1
             ORDER BY produto_id ASC, ordem ASC, id ASC'
        );
        $stmt->execute(['tenant_id' => $tenantId]);

        $grouped = [];
        foreach ($stmt->fetchAll() ?: [] as $row) {
            $grouped[(int) $row['produto_id']][] = [
                'id' => (int) $row['id'],
                'nome' => $row['nome'],
                'preco' => $row['preco'] !== null ? (float) $row['preco'] : null,
            ];
        }

        return $grouped;
    }

    public function findAddonGroupsByTenantId(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT
                pga.produto_id,
                g.id AS grupo_id,
                g.nome AS grupo_nome,
                g.minimo,
                g.maximo,
                g.obrigatorio,
                a.id AS adicional_id,
                a.nome AS adicional_nome,
                a.preco AS adicional_preco,
                g.nome AS grupo_nome,
                g.maximo AS grupo_maximo
             FROM produto_grupos_adicionais pga
             INNER JOIN grupos_adicionais g ON g.id = pga.grupo_id
             INNER JOIN adicionais a ON a.grupo_id = g.id
             WHERE g.tenant_id = :tenant_id
               AND g.ativo = 1
               AND a.ativo = 1
             ORDER BY pga.produto_id ASC, g.ordem ASC, g.id ASC, a.ordem ASC, a.id ASC'
        );
        $stmt->execute(['tenant_id' => $tenantId]);

        $grouped = [];
        foreach ($stmt->fetchAll() ?: [] as $row) {
            $productId = (int) $row['produto_id'];
            $groupId = (int) $row['grupo_id'];

            if (!isset($grouped[$productId][$groupId])) {
                $grouped[$productId][$groupId] = [
                    'id' => $groupId,
                    'nome' => $row['grupo_nome'],
                    'minimo' => (int) $row['minimo'],
                    'maximo' => (int) $row['maximo'],
                    'obrigatorio' => (bool) $row['obrigatorio'],
                    'opcoes' => [],
                ];
            }

            $grouped[$productId][$groupId]['opcoes'][] = [
                'id' => (int) $row['adicional_id'],
                'nome' => $row['adicional_nome'],
                'preco' => $row['adicional_preco'] !== null ? (float) $row['adicional_preco'] : 0.0,
            ];
        }

        foreach ($grouped as $productId => $groups) {
            $grouped[$productId] = array_values($groups);
        }

        return $grouped;
    }

    public function findIndexedByIdsForTenant(int $tenantId, array $productIds): array
    {
        if ($this->db === null || $productIds === []) {
            return [];
        }

        $productIds = array_values(array_unique(array_map('intval', $productIds)));
        $placeholders = implode(',', array_fill(0, count($productIds), '?'));
        $params = array_merge([$tenantId], $productIds);

        $stmt = $this->db->prepare(
            "SELECT id, categoria_id, nome, slug, descricao, preco, imagem, destaque, disponivel
             FROM produtos
             WHERE tenant_id = ? AND id IN ({$placeholders}) AND ativo = 1"
        );
        $stmt->execute($params);

        $indexed = [];
        foreach ($stmt->fetchAll() ?: [] as $row) {
            $indexed[(int) $row['id']] = $row;
        }

        return $indexed;
    }

    public function findVariationsIndexedByIdsForTenant(int $tenantId, array $variationIds): array
    {
        if ($this->db === null || $variationIds === []) {
            return [];
        }

        $variationIds = array_values(array_unique(array_map('intval', $variationIds)));
        $placeholders = implode(',', array_fill(0, count($variationIds), '?'));
        $params = array_merge([$tenantId], $variationIds);

        $stmt = $this->db->prepare(
            "SELECT id, produto_id, nome, preco
             FROM produto_variacoes
             WHERE tenant_id = ? AND id IN ({$placeholders}) AND ativo = 1"
        );
        $stmt->execute($params);

        $indexed = [];
        foreach ($stmt->fetchAll() ?: [] as $row) {
            $indexed[(int) $row['id']] = $row;
        }

        return $indexed;
    }

    public function findAddonsIndexedByIdsForTenant(int $tenantId, array $addonIds): array
    {
        if ($this->db === null || $addonIds === []) {
            return [];
        }

        $addonIds = array_values(array_unique(array_map('intval', $addonIds)));
        $placeholders = implode(',', array_fill(0, count($addonIds), '?'));
        $params = array_merge([$tenantId], $addonIds);

        $stmt = $this->db->prepare(
            "SELECT
                a.id AS adicional_id,
                a.nome AS adicional_nome,
                a.preco,
                g.nome AS grupo_nome,
                g.maximo AS grupo_maximo,
                pga.produto_id
             FROM adicionais a
             INNER JOIN grupos_adicionais g ON g.id = a.grupo_id
             INNER JOIN produto_grupos_adicionais pga ON pga.grupo_id = g.id
             WHERE g.tenant_id = ? AND a.id IN ({$placeholders}) AND a.ativo = 1 AND g.ativo = 1"
        );
        $stmt->execute($params);

        $indexed = [];
        foreach ($stmt->fetchAll() ?: [] as $row) {
            $addonId = (int) $row['adicional_id'];

            if (!isset($indexed[$addonId])) {
                $indexed[$addonId] = [
                    'adicional_id' => $addonId,
                    'adicional_nome' => $row['adicional_nome'],
                    'preco' => $row['preco'],
                    'grupo_nome' => $row['grupo_nome'],
                    'grupo_maximo' => (int) $row['grupo_maximo'],
                    'produto_ids' => [],
                ];
            }

            $indexed[$addonId]['produto_ids'][] = (int) $row['produto_id'];
        }

        return $indexed;
    }

    public function findAllByTenantId(int $tenantId, ?int $categoryId = null, ?string $search = null): array
    {
        if ($this->db === null) {
            return [];
        }

        $sql = 'SELECT p.*, c.nome AS categoria_nome
                FROM produtos p
                LEFT JOIN categorias c ON c.id = p.categoria_id
                WHERE p.tenant_id = :tenant_id AND p.ativo = 1';
        $params = ['tenant_id' => $tenantId];

        if ($categoryId !== null && $categoryId > 0) {
            $sql .= ' AND p.categoria_id = :categoria_id';
            $params['categoria_id'] = $categoryId;
        }

        if ($search !== null && trim($search) !== '') {
            $sql .= ' AND (p.nome LIKE :search OR p.descricao LIKE :search)';
            $params['search'] = '%' . trim($search) . '%';
        }

        $sql .= ' ORDER BY c.ordem ASC, p.ordem ASC, p.id DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll() ?: [];
    }

    public function findById(int $id, int $tenantId): ?array
    {
        if ($this->db === null) {
            return null;
        }

        $stmt = $this->db->prepare(
            'SELECT p.*, c.nome AS categoria_nome
             FROM produtos p
             LEFT JOIN categorias c ON c.id = p.categoria_id
             WHERE p.id = :id AND p.tenant_id = :tenant_id AND p.ativo = 1'
        );
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
            $stmt = $this->db->prepare('SELECT COALESCE(MAX(ordem), 0) + 1 FROM produtos WHERE tenant_id = :tenant_id');
            $stmt->execute(['tenant_id' => $data['tenant_id']]);
            $data['ordem'] = (int) $stmt->fetchColumn();
        }

        $stmt = $this->db->prepare(
            'INSERT INTO produtos (tenant_id, categoria_id, nome, slug, descricao, preco, imagem, destaque, disponivel, ordem, ativo)
             VALUES (:tenant_id, :categoria_id, :nome, :slug, :descricao, :preco, :imagem, :destaque, :disponivel, :ordem, :ativo)'
        );
        $stmt->execute([
            'tenant_id' => $data['tenant_id'],
            'categoria_id' => $data['categoria_id'],
            'nome' => $data['nome'],
            'slug' => $data['slug'] ?? strtolower(preg_replace('/[^a-z0-9]+/i', '-', $data['nome'])),
            'descricao' => $data['descricao'] ?? null,
            'preco' => $data['preco'],
            'imagem' => $data['imagem'] ?? null,
            'destaque' => (int) ($data['destaque'] ?? 0),
            'disponivel' => (int) ($data['disponivel'] ?? 1),
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
            'UPDATE produtos
             SET categoria_id = :categoria_id,
                 nome = :nome,
                 slug = :slug,
                 descricao = :descricao,
                 preco = :preco,
                 imagem = :imagem,
                 destaque = :destaque,
                 disponivel = :disponivel,
                 ordem = :ordem,
                 atualizado_em = NOW()
             WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute([
            'id' => $id,
            'tenant_id' => $tenantId,
            'categoria_id' => $data['categoria_id'],
            'nome' => $data['nome'],
            'slug' => $data['slug'] ?? strtolower(preg_replace('/[^a-z0-9]+/i', '-', $data['nome'])),
            'descricao' => $data['descricao'] ?? null,
            'preco' => $data['preco'],
            'imagem' => $data['imagem'] ?? null,
            'destaque' => (int) ($data['destaque'] ?? 0),
            'disponivel' => (int) ($data['disponivel'] ?? 1),
            'ordem' => (int) ($data['ordem'] ?? 0),
        ]);
    }

    public function toggleAvailability(int $id, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE produtos
             SET disponivel = CASE WHEN disponivel = 1 THEN 0 ELSE 1 END, atualizado_em = NOW()
             WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }

    public function softDelete(int $id, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE produtos SET ativo = 0, atualizado_em = NOW() WHERE id = :id AND tenant_id = :tenant_id'
        );

        return $stmt->execute(['id' => $id, 'tenant_id' => $tenantId]);
    }

    public function duplicate(int $id, int $tenantId): ?int
    {
        $original = $this->findById($id, $tenantId);
        if (!$original) {
            return null;
        }

        $original['nome'] = $original['nome'] . ' (Cópia)';
        $original['slug'] = $original['slug'] . '-copia-' . time();
        $original['tenant_id'] = $tenantId;

        return $this->create($original);
    }
}
