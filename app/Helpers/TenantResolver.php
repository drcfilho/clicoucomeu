<?php

declare(strict_types=1);

namespace App\Helpers;

use PDO;

class TenantResolver
{
    public function __construct(private ?PDO $db, private Logger $logger)
    {
    }

    public function resolveBySlug(string $slug): ?array
    {
        if ($this->db === null) {
            $this->logger->error('Database unavailable while resolving tenant', ['slug' => $slug]);
            return null;
        }

        $stmt = $this->db->prepare('SELECT * FROM tenants WHERE slug = :slug AND status = :status LIMIT 1');
        $stmt->execute([
            'slug' => $slug,
            'status' => 'ativo',
        ]);

        $tenant = $stmt->fetch();

        return is_array($tenant) ? $tenant : null;
    }
}
