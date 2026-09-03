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
}
