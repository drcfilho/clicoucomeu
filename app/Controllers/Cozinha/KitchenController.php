<?php

declare(strict_types=1);

namespace App\Controllers\Cozinha;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Repositories\OrderRepository;

class KitchenController
{
    private OrderRepository $orderRepo;
    private Session $session;

    public function __construct(private Container $container)
    {
        $this->orderRepo = $container->get(OrderRepository::class);
        $this->session = $container->get(Session::class);
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $tenantRepo = $this->container->get(\App\Repositories\TenantRepository::class);
        $tenant = $tenantRepo->findById($tenantId);

        $planoKey = (string) ($tenant['plano'] ?? 'mvp');
        $planDetails = \App\Services\PlanService::getPlanDetails($planoKey);

        if (!($planDetails['kds_enabled'] ?? false)) {
            $this->session->setFlash('error', 'A tela de Cozinha (KDS) é um recurso exclusivo dos planos Pro e Enterprise.');
            $response->redirect('/painel');
            return;
        }

        $rawOrders = $this->orderRepo->findOrdersByTenantId($tenantId, null, 100);

        // A cozinha exibe apenas pedidos que estao em preparo (aceitos pelo painel)
        $relevantOrders = array_values(array_filter($rawOrders, static function ($o): bool {
            return in_array($o['status'], ['em_preparo', 'preparando'], true);
        }));

        $detailedOrders = [];
        foreach ($relevantOrders as $o) {
            $details = $this->orderRepo->findOrderDetailsById((int) $o['id'], $tenantId);
            if ($details) {
                $detailedOrders[] = $details;
            }
        }

        $response->view('cozinha.index', [
            'orders' => $detailedOrders,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function updateStatus(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);
        $data = $request->getParsedBody();
        $newStatus = (string) ($data['status'] ?? 'pronto');
        $userId = (int) ($this->session->get('usuario_id') ?? 0);

        if ($this->orderRepo->updateOrderStatus($id, $tenantId, $newStatus, $userId)) {
            $this->session->setFlash('success', "Pedido #{$id} alterado para {$newStatus}!");
        } else {
            $this->session->setFlash('error', 'Falha ao atualizar pedido na cozinha.');
        }

        $response->redirect('/cozinha');
    }

    public function poll(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $rawOrders = $this->orderRepo->findOrdersByTenantId($tenantId, null, 100);

        $relevantOrders = array_values(array_filter($rawOrders, static function ($o): bool {
            return in_array($o['status'], ['em_preparo', 'preparando'], true);
        }));

        $detailedOrders = [];
        foreach ($relevantOrders as $o) {
            $details = $this->orderRepo->findOrderDetailsById((int) $o['id'], $tenantId);
            if ($details) {
                $detailedOrders[] = $details;
            }
        }

        $response->json([
            'success' => true,
            'orders' => $detailedOrders,
        ]);
    }
}
