<?php

declare(strict_types=1);

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

require BASE_PATH . '/app/bootstrap.php';

App\Config\loadEnv(BASE_PATH . '/.env');

$db = App\Helpers\Database::connect(App\Config\databaseConfig());

if ($db === null) {
    fwrite(STDERR, "Banco indisponivel. Configure .env antes de executar.\n");
    exit(1);
}

$tenantSlug = 'piemonte';
$tenantName = 'Piemonte';
$adminUser = 'superadmin';
$adminPass = 'admin123';
$adminHash = password_hash($adminPass, PASSWORD_DEFAULT);

$db->beginTransaction();

try {
    $tenantStmt = $db->prepare(
        'INSERT INTO tenants (nome, slug, timezone, status, plano)
         VALUES (:nome, :slug, :timezone, :status, :plano)
         ON DUPLICATE KEY UPDATE nome = VALUES(nome), timezone = VALUES(timezone), status = VALUES(status), plano = VALUES(plano)'
    );
    $tenantStmt->execute([
        'nome' => $tenantName,
        'slug' => $tenantSlug,
        'timezone' => 'America/Sao_Paulo',
        'status' => 'ativo',
        'plano' => 'mvp',
    ]);

    $tenantIdStmt = $db->prepare('SELECT id FROM tenants WHERE slug = :slug LIMIT 1');
    $tenantIdStmt->execute(['slug' => $tenantSlug]);
    $tenantId = (int) $tenantIdStmt->fetchColumn();

    $superadminIdStmt = $db->prepare('SELECT id FROM usuarios WHERE tenant_id IS NULL AND usuario = :usuario LIMIT 1');
    $superadminIdStmt->execute(['usuario' => $adminUser]);
    $superadminId = $superadminIdStmt->fetchColumn();

    $userStmt = $db->prepare(
        $superadminId
            ? 'UPDATE usuarios SET nome = :nome, senha_hash = :senha_hash, perfil = :perfil, ativo = 1 WHERE id = :id'
            : 'INSERT INTO usuarios (tenant_id, nome, usuario, senha_hash, perfil, ativo) VALUES (NULL, :nome, :usuario, :senha_hash, :perfil, 1)'
    );
    $userPayload = [
        'nome' => 'Super Admin',
        'usuario' => $adminUser,
        'senha_hash' => $adminHash,
        'perfil' => 'superadmin',
    ];

    if ($superadminId) {
        $userPayload['id'] = (int) $superadminId;
    }

    $userStmt->execute($userPayload);

    $tenantAdminStmt = $db->prepare(
        'INSERT INTO usuarios (tenant_id, nome, usuario, senha_hash, perfil, ativo)
         VALUES (:tenant_id, :nome, :usuario, :senha_hash, :perfil, 1)
         ON DUPLICATE KEY UPDATE nome = VALUES(nome), senha_hash = VALUES(senha_hash), perfil = VALUES(perfil), ativo = 1'
    );
    $tenantAdminStmt->execute([
        'tenant_id' => $tenantId,
        'nome' => 'Admin Piemonte',
        'usuario' => 'piemonte',
        'senha_hash' => $adminHash,
        'perfil' => 'admin',
    ]);

    $db->commit();

    echo "Seed concluido.\n";
    echo "Tenant: {$tenantName} ({$tenantSlug})\n";
    echo "Superadmin: {$adminUser} / {$adminPass}\n";
    echo "Admin tenant: piemonte / {$adminPass}\n";
} catch (Throwable $exception) {
    $db->rollBack();
    fwrite(STDERR, "Falha no seed: {$exception->getMessage()}\n");
    exit(1);
}
