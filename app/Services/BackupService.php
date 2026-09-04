<?php

declare(strict_types=1);

namespace App\Services;

use PDO;
use Exception;

class BackupService
{
    private array $dbConfig;
    private string $storagePath;

    public function __construct(private ?PDO $pdo = null)
    {
        $configPath = BASE_PATH . '/app/Config/database.php';
        if (file_exists($configPath)) {
            require_once $configPath;
            if (function_exists('App\Config\databaseConfig')) {
                $conn = \App\Config\databaseConfig();
            } else {
                $conn = [];
            }
            $this->dbConfig = [
                'host' => $conn['host'] ?? '127.0.0.1',
                'port' => $conn['port'] ?? 3306,
                'database' => $conn['database'] ?? 'clicoucomeu',
                'username' => $conn['username'] ?? 'root',
                'password' => $conn['password'] ?? '',
            ];
        } else {
            $this->dbConfig = [
                'host' => '127.0.0.1',
                'port' => 3306,
                'database' => 'clicoucomeu',
                'username' => 'root',
                'password' => '',
            ];
        }

        $this->storagePath = BASE_PATH . '/storage/backups';
        if (!is_dir($this->storagePath)) {
            mkdir($this->storagePath, 0755, true);
        }
    }

    /**
     * Gera um backup SQL completo de todo o banco de dados (Superadmin).
     */
    public function generateGlobalDatabaseBackup(): string
    {
        $filename = 'global_backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filepath = $this->storagePath . '/' . $filename;

        $host = $this->dbConfig['host'] ?? '127.0.0.1';
        $port = $this->dbConfig['port'] ?? 3306;
        $db = $this->dbConfig['database'] ?? 'clicoucomeu';
        $user = $this->dbConfig['username'] ?? 'root';
        $pass = $this->dbConfig['password'] ?? '';

        // Tenta mysqldump via exec
        $passArg = $pass ? "-p\"{$pass}\"" : '';
        $cmd = "mysqldump --host=\"{$host}\" --port=\"{$port}\" --user=\"{$user}\" {$passArg} \"{$db}\" > \"{$filepath}\"";
        
        @exec($cmd, $output, $returnCode);

        // Fallback via PHP puro se mysqldump falhar
        if ($returnCode !== 0 || !file_exists($filepath) || filesize($filepath) === 0) {
            $this->generatePhpDatabaseBackup($filepath);
        }

        return $filepath;
    }

    /**
     * Gera um arquivo ZIP contendo as mídias salvas em public/uploads (Superadmin).
     */
    public function generateGlobalUploadsBackup(): string
    {
        $filename = 'uploads_backup_' . date('Y-m-d_H-i-s') . '.zip';
        $filepath = $this->storagePath . '/' . $filename;
        $uploadsDir = BASE_PATH . '/public/uploads';

        $zip = new \ZipArchive();
        if ($zip->open($filepath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            throw new Exception('Não foi possível criar o arquivo ZIP de mídias.');
        }

        if (is_dir($uploadsDir)) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($uploadsDir),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($uploadsDir) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
        } else {
            $zip->addFromString('readme.txt', 'Nenhum upload encontrado no sistema.');
        }

        $zip->close();
        return $filepath;
    }

    private function getPdo(): PDO
    {
        if ($this->pdo !== null) {
            return $this->pdo;
        }

        $configPath = BASE_PATH . '/app/Config/database.php';
        if (file_exists($configPath)) {
            require_once $configPath;
            $conn = function_exists('App\Config\databaseConfig') ? \App\Config\databaseConfig() : [];
        } else {
            $conn = [];
        }

        $config = [
            'host' => $conn['host'] ?? '127.0.0.1',
            'port' => (int) ($conn['port'] ?? 3306),
            'database' => $conn['database'] ?? 'clicoucomeu',
            'username' => $conn['username'] ?? 'root',
            'password' => $conn['password'] ?? '',
            'charset' => $conn['charset'] ?? 'utf8mb4',
        ];

        $pdo = \App\Helpers\Database::connect($config);
        if ($pdo === null) {
            throw new Exception('Não foi possível conectar ao banco de dados MySQL.');
        }

        $this->pdo = $pdo;
        return $this->pdo;
    }

    /**
     * Gera a exportação individual dos dados de um tenant específico (JSON).
     */
    public function exportTenantJson(int $tenantId): array
    {
        $pdo = $this->getPdo();

        // Informações do Tenant
        $stmt = $pdo->prepare("SELECT * FROM tenants WHERE id = ?");
        $stmt->execute([$tenantId]);
        $tenant = $stmt->fetch(PDO::FETCH_ASSOC);

        // Categorias
        $stmt = $pdo->prepare("SELECT * FROM categorias WHERE tenant_id = ?");
        $stmt->execute([$tenantId]);
        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Produtos
        $stmt = $pdo->prepare("SELECT * FROM produtos WHERE tenant_id = ?");
        $stmt->execute([$tenantId]);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Grupos de Adicionais & Adicionais
        $stmt = $pdo->prepare("SELECT * FROM grupos_adicionais WHERE tenant_id = ?");
        $stmt->execute([$tenantId]);
        $grupos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($grupos as &$grupo) {
            $stmtAddons = $pdo->prepare("SELECT * FROM adicionais WHERE grupo_id = ?");
            $stmtAddons->execute([$grupo['id']]);
            $grupo['adicionais'] = $stmtAddons->fetchAll(PDO::FETCH_ASSOC);
        }

        // Bairros / Taxas
        $stmt = $pdo->prepare("SELECT * FROM bairros WHERE tenant_id = ?");
        $stmt->execute([$tenantId]);
        $bairros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Histórico de Pedidos (Últimos 1000)
        $stmt = $pdo->prepare("SELECT * FROM pedidos WHERE tenant_id = ? ORDER BY id DESC LIMIT 1000");
        $stmt->execute([$tenantId]);
        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'versao_exportacao' => '1.0',
            'gerado_em' => date('Y-m-d H:i:s'),
            'tenant' => $tenant,
            'categorias' => $categorias,
            'produtos' => $produtos,
            'grupos_adicionais' => $grupos,
            'bairros' => $bairros,
            'pedidos_recentes' => $pedidos,
        ];
    }

    /**
     * Fallback puro PHP para dump de tabelas caso mysqldump não esteja no PATH.
     */
    private function generatePhpDatabaseBackup(string $filepath): void
    {
        $pdo = $this->getPdo();

        $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

        $out = "-- Backup Clicou Comeu\n-- Gerado em: " . date('Y-m-d H:i:s') . "\n\n";
        $out .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $createTable = $pdo->query("SHOW CREATE TABLE `{$table}`")->fetch(PDO::FETCH_NUM);
            $out .= "DROP TABLE IF EXISTS `{$table}`;\n";
            $out .= $createTable[1] . ";\n\n";

            $rows = $pdo->query("SELECT * FROM `{$table}`")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                $keys = array_map(fn($k) => "`$k`", array_keys($row));
                $vals = array_map(function ($v) {
                    if ($v === null) return 'NULL';
                    return $this->pdo->quote((string)$v);
                }, array_values($row));

                $out .= "INSERT INTO `{$table}` (" . implode(', ', $keys) . ") VALUES (" . implode(', ', $vals) . ");\n";
            }
            $out .= "\n";
        }

        $out .= "SET FOREIGN_KEY_CHECKS=1;\n";
        file_put_contents($filepath, $out);
    }
}
