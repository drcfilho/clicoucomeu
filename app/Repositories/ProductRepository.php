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
                a.preco AS adicional_preco
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
                    'produto_ids' => [],
                ];
            }

            $indexed[$addonId]['produto_ids'][] = (int) $row['produto_id'];
        }

        return $indexed;
    }
}
