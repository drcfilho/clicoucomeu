<?php

declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = BASE_PATH . '/app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

use App\Services\BackupService;

echo "[" . date('Y-m-d H:i:s') . "] 🚀 Iniciando rotina automatizada de backup global...\n";

try {
    $service = new BackupService();
    
    // Backup Banco MySQL
    $sqlFile = $service->generateGlobalDatabaseBackup();
    echo "[" . date('Y-m-d H:i:s') . "]  Dump do banco gerado: " . basename($sqlFile) . " (" . round(filesize($sqlFile) / 1024 / 1024, 2) . " MB)\n";

    // Backup Mídias
    $zipFile = $service->generateGlobalUploadsBackup();
    echo "[" . date('Y-m-d H:i:s') . "] 📦 Arquivo de mídias gerado: " . basename($zipFile) . " (" . round(filesize($zipFile) / 1024 / 1024, 2) . " MB)\n";

    echo "[" . date('Y-m-d H:i:s') . "] 🎉 Backup concluído com sucesso!\n";
} catch (\Throwable $e) {
    echo "[" . date('Y-m-d H:i:s') . "] ❌ Erro ao executar backup: " . $e->getMessage() . "\n";
    exit(1);
}
