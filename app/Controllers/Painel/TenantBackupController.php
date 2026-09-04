<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Services\BackupService;

class TenantBackupController
{
    private BackupService $backupService;

    public function __construct(private Container $container)
    {
        $this->backupService = $container->get(BackupService::class);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', $_SESSION['tenant_id'] ?? 0);

        $response->view('painel.backup.index', [
            'tenantId' => $tenantId,
            'csrfToken' => $request->getAttribute('csrf_token'),
        ]);
    }

    public function exportJson(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', $_SESSION['tenant_id'] ?? 0);
        
        $data = $this->backupService->exportTenantJson($tenantId);
        $filename = 'backup_restaurante_' . ($data['tenant']['slug'] ?? 'tenant') . '_' . date('Y-m-d') . '.json';

        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
