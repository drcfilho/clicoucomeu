<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use App\Repositories\OrderRepository;

class OrderController
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
        $statusFilter = (string) $request->input('status', '');

        $orders = $this->orderRepo->findOrdersByTenantId($tenantId, $statusFilter);
        $counts = $this->orderRepo->getCountsByStatus($tenantId);

        $response->view('painel.pedidos.index', [
            'orders' => $orders,
            'counts' => $counts,
            'currentStatus' => $statusFilter,
            'csrfToken' => $request->getAttribute('csrf_token'),
            'session' => $this->session,
        ]);
    }

    public function show(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        $order = $this->orderRepo->findOrderDetailsById($id, $tenantId);
        if (!$order) {
            $response->json(['success' => false, 'message' => 'Pedido não encontrado'], 404);
            return;
        }

        $response->json(['success' => true, 'order' => $order]);
    }

    public function print(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);
        $format = (string) $request->input('format', '80mm');

        $order = $this->orderRepo->findOrderDetailsById($id, $tenantId);
        if (!$order) {
            $response->view('errors.404', ['message' => 'Pedido não encontrado.'], 404);
            return;
        }

        $tenantRepo = $this->container->get(\App\Repositories\TenantRepository::class);
        $tenant = $tenantRepo->findById($tenantId);

        $response->view('painel.pedidos.imprimir', [
            'order' => $order,
            'tenant' => $tenant,
            'format' => $format,
        ]);
    }

    public function updateStatus(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);
        $data = $request->getParsedBody();
        $newStatus = (string) ($data['status'] ?? '');
        $userId = (int) ($this->session->get('usuario_id') ?? 0);

        $allowedStatuses = ['pendente', 'aceito', 'em_preparo', 'pronto', 'saiu_entrega', 'finalizado', 'cancelado'];
        if (!in_array($newStatus, $allowedStatuses, true)) {
            $this->session->setFlash('error', 'Status inválido.');
            $response->redirect('/painel/pedidos');
            return;
        }

        if ($this->orderRepo->updateOrderStatus($id, $tenantId, $newStatus, $userId)) {
            $this->session->setFlash('success', "Status do pedido #{$id} alterado para {$newStatus}!");
        } else {
            $this->session->setFlash('error', 'Falha ao atualizar status do pedido.');
        }

        $response->redirect('/painel/pedidos');
    }

    public function delete(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $id = (int) ($params['id'] ?? 0);

        if ($this->orderRepo->deleteOrder($id, $tenantId)) {
            $this->session->setFlash('success', "Pedido #{$id} excluído com sucesso!");
        } else {
            $this->session->setFlash('error', 'Falha ao excluir pedido.');
        }

        $response->redirect('/painel/pedidos');
    }

    public function clearCancelled(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);

        if ($this->orderRepo->deleteCancelledOrders($tenantId)) {
            $this->session->setFlash('success', 'Todos os pedidos cancelados foram apagados!');
        } else {
            $this->session->setFlash('error', 'Falha ao apagar pedidos cancelados.');
        }

        $response->redirect('/painel/pedidos?status=cancelado');
    }

    public function poll(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) $request->getAttribute('tenant_id', 0);
        $orders = $this->orderRepo->findOrdersByTenantId($tenantId, null, 20);
        $counts = $this->orderRepo->getCountsByStatus($tenantId);

        $response->json([
            'success' => true,
            'orders' => $orders,
            'counts' => $counts,
        ]);
    }
}
