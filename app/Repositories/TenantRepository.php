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

    public function findBySlug(string $slug): ?array
    {
        if ($this->db === null) {
            return null;
        }

        $stmt = $this->db->prepare(
            'SELECT id, nome, slug, status, plano
             FROM tenants
             WHERE slug = :slug
             LIMIT 1'
        );
        $stmt->execute(['slug' => $slug]);

        $row = $stmt->fetch();

        return is_array($row) ? $row : null;
    }

    public function findById(int $id): ?array
    {
        if ($this->db === null) {
            return null;
        }

        $stmt = $this->db->prepare(
            'SELECT id, nome, slug, whatsapp, cidade, uf, timezone, status, plano
             FROM tenants
             WHERE id = :id
             LIMIT 1'
        );
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();

        return is_array($row) ? $row : null;
    }

    public function create(array $data): int
    {
        if ($this->db === null) {
            return 0;
        }

        $stmt = $this->db->prepare(
            'INSERT INTO tenants
             (nome, slug, whatsapp, cidade, uf, timezone, status, plano)
             VALUES
             (:nome, :slug, :whatsapp, :cidade, :uf, :timezone, :status, :plano)'
        );
        $stmt->execute([
            'nome' => $data['nome'],
            'slug' => $data['slug'],
            'whatsapp' => $data['whatsapp'] !== '' ? $data['whatsapp'] : null,
            'cidade' => $data['cidade'] !== '' ? $data['cidade'] : null,
            'uf' => $data['uf'] !== '' ? $data['uf'] : null,
            'timezone' => $data['timezone'],
            'status' => $data['status'],
            'plano' => $data['plano'] !== '' ? $data['plano'] : null,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        if ($this->db === null) {
            return;
        }

        $stmt = $this->db->prepare(
            'UPDATE tenants
             SET nome = :nome,
                 slug = :slug,
                 whatsapp = :whatsapp,
                 cidade = :cidade,
                 uf = :uf,
                 timezone = :timezone,
                 status = :status,
                 plano = :plano
             WHERE id = :id'
        );
        $stmt->execute([
            'id' => $id,
            'nome' => $data['nome'],
            'slug' => $data['slug'],
            'whatsapp' => $data['whatsapp'] !== '' ? $data['whatsapp'] : null,
            'cidade' => $data['cidade'] !== '' ? $data['cidade'] : null,
            'uf' => $data['uf'] !== '' ? $data['uf'] : null,
            'timezone' => $data['timezone'],
            'status' => $data['status'],
            'plano' => $data['plano'] !== '' ? $data['plano'] : null,
        ]);
    }

    public function updateStatus(int $id, string $status): void
    {
        if ($this->db === null) {
            return;
        }

        $stmt = $this->db->prepare(
            'UPDATE tenants
             SET status = :status
             WHERE id = :id'
        );
        $stmt->execute([
            'id' => $id,
            'status' => $status,
        ]);
    public function extendTrial(int $id, int $extraDays = 7): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE tenants 
             SET criado_em = DATE_ADD(criado_em, INTERVAL :extraDays DAY) 
             WHERE id = :id AND plano = "mvp"'
        );
        return $stmt->execute([
            'extraDays' => $extraDays,
            'id' => $id,
        ]);
    }

    public function getSaasMetrics(): array
    {
        if ($this->db === null) {
            return [
                'total_tenants' => 0,
                'active_tenants' => 0,
                'trials_count' => 0,
                'mrr' => 0.0,
                'arr' => 0.0,
                'plans_breakdown' => [],
            ];
        }

        $all = $this->all();
        $total = count($all);
        $active = 0;
        $trials = 0;
        $mrr = 0.0;
        $plansBreakdown = ['mvp' => 0, 'starter' => 0, 'pro' => 0, 'enterprise' => 0];

        $prices = [
            'mvp' => 0.0,
            'starter' => 49.0,
            'pro' => 99.0,
            'enterprise' => 0.0,
        ];

        foreach ($all as $t) {
            $status = (string) ($t['status'] ?? 'ativo');
            $plano = (string) ($t['plano'] ?? 'mvp');

            if ($status === 'ativo') {
                $active++;
            }

            if ($plano === 'mvp') {
                $trials++;
            }

            if (isset($plansBreakdown[$plano])) {
                $plansBreakdown[$plano]++;
            } else {
                $plansBreakdown[$plano] = 1;
            }

            if ($status === 'ativo' && isset($prices[$plano])) {
                $mrr += $prices[$plano];
            }
        }

        return [
            'total_tenants' => $total,
            'active_tenants' => $active,
            'trials_count' => $trials,
            'mrr' => $mrr,
            'arr' => $mrr * 12,
            'plans_breakdown' => $plansBreakdown,
        ];
    }
}
