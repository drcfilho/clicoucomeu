<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Services\StoreHoursService;

class StoreHoursController
{
    private StoreHoursService $storeHoursService;
    private Session $session;

    public function __construct(private Container $container)
    {
        $this->storeHoursService = $container->get(StoreHoursService::class);
        $this->session = $container->get(Session::class);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $schedule = $this->storeHoursService->getWeeklySchedule($tenantId);
        $status = $this->storeHoursService->isOpen($tenantId);

        $response->view('painel.horarios.index', [
            'schedule' => $schedule,
            'status' => $status,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function save(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $data = $request->getParsedBody();
        $scheduleData = (array) ($data['dias'] ?? []);

        if ($this->storeHoursService->saveWeeklySchedule($tenantId, $scheduleData)) {
            $this->session->setFlash('success', 'Horários de funcionamento salvos com sucesso!');
        } else {
            $this->session->setFlash('error', 'Falha ao salvar horários.');
        }

        $response->redirect('/painel/horarios');
    }

    public function toggleManual(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $data = $request->getParsedBody();

        $forceClose = isset($data['forcar_fechamento']) && $data['forcar_fechamento'] === '1';
        $message = trim((string) ($data['fechado_mensagem'] ?? ''));

        $this->storeHoursService->toggleManualClose($tenantId, $forceClose, $message ?: null);

        if ($forceClose) {
            $this->session->setFlash('warning', 'Abertura de pedidos pausada manualmente!');
        } else {
            $this->session->setFlash('success', 'Loja reaberta para pedidos com sucesso!');
        }

        $response->redirect('/painel/horarios');
    }
}
