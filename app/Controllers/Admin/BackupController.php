<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Services\BackupService;

class BackupController
{
    private BackupService $backupService;

    public function __construct(private Container $container)
    {
        $this->backupService = $container->get(BackupService::class);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $session = $this->container->get('session');
        $storageDir = BASE_PATH . '/storage/backups';

        $files = [];
        if (is_dir($storageDir)) {
            $scan = scandir($storageDir);
            foreach ($scan as $f) {
                if ($f !== '.' && $f !== '..' && str_starts_with($f, 'global_') || str_starts_with($f, 'uploads_')) {
                    $full = $storageDir . '/' . $f;
                    $files[] = [
                        'name' => $f,
                        'size' => round(filesize($full) / 1024 / 1024, 2) . ' MB',
                        'date' => date('d/m/Y H:i:s', filemtime($full)),
                    ];
                }
            }
        }

        // Ordena arquivos mais recentes primeiro
        usort($files, fn($a, $b) => strcmp($b['name'], $a['name']));

        $response->view('admin.backups', [
            'nome' => (string) $session->get('user_nome', $session->get('nome', 'Superadmin')),
            'files' => $files,
            'csrfToken' => $request->getAttribute('csrf_token'),
        ]);
    }

    public function generateDatabase(Request $request, Response $response, array $params = []): void
    {
        $session = $this->container->get('session');
        try {
            $filepath = $this->backupService->generateGlobalDatabaseBackup();
            $filename = basename($filepath);

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);
            exit;
        } catch (\Throwable $e) {
            $session->setFlash('error', 'Falha ao gerar backup do banco de dados: ' . $e->getMessage());
            $response->redirect('/admin/backups');
        }
    }

    public function generateUploads(Request $request, Response $response, array $params = []): void
    {
        $session = $this->container->get('session');
        try {
            $filepath = $this->backupService->generateGlobalUploadsBackup();
            $filename = basename($filepath);

            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);
            exit;
        } catch (\Throwable $e) {
            $session->setFlash('error', 'Falha ao gerar backup de mídias: ' . $e->getMessage());
            $response->redirect('/admin/backups');
        }
    }
}
