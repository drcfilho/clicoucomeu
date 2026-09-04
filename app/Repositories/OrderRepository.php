<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class OrderRepository
{
    public function __construct(private ?PDO $db)
    {
    }

    public function findOrdersByTenantId(int $tenantId, ?string $status = null, int $limit = 50): array
    {
        if ($this->db === null) {
            return [];
        }

        $sql = 'SELECT p.*, 
                       (SELECT COUNT(*) FROM pedido_itens pi WHERE pi.pedido_id = p.id) AS total_itens
                FROM pedidos p
                WHERE p.tenant_id = :tenant_id';
        $params = ['tenant_id' => $tenantId];

        if ($status !== null && $status !== '') {
            if ($status === 'pendente') {
                $sql .= " AND p.status IN ('novo', 'pendente')";
            } elseif ($status === 'em_preparo') {
                $sql .= " AND p.status IN ('em_preparo', 'preparando')";
            } elseif ($status === 'saiu_entrega') {
                $sql .= " AND p.status IN ('saiu_entrega', 'saiu_para_entrega')";
            } else {
                $sql .= ' AND p.status = :status';
                $params['status'] = $status;
            }
        }

        $sql .= ' ORDER BY p.criado_em DESC, p.id DESC LIMIT ' . (int) $limit;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll() ?: [];
    }

    public function findOrderDetailsById(int $orderId, int $tenantId): ?array
    {
        if ($this->db === null) {
            return null;
        }

        $stmt = $this->db->prepare(
            'SELECT p.*, 
                    c.nome AS cliente_nome_cadastrado, c.whatsapp AS cliente_telefone
             FROM pedidos p
             LEFT JOIN clientes c ON c.id = p.cliente_id
             WHERE p.id = :id AND p.tenant_id = :tenant_id'
        );
        $stmt->execute(['id' => $orderId, 'tenant_id' => $tenantId]);
        $order = $stmt->fetch();

        if (!$order) {
            return null;
        }

        // Buscar itens
        $stmtItems = $this->db->prepare(
            'SELECT pi.*
             FROM pedido_itens pi
             WHERE pi.pedido_id = :pedido_id'
        );
        $stmtItems->execute(['pedido_id' => $orderId]);
        $items = $stmtItems->fetchAll() ?: [];

        // Buscar adicionais para cada item
        foreach ($items as &$item) {
            $stmtAddons = $this->db->prepare(
                'SELECT pia.*, pia.nome AS adicional_nome
                 FROM pedido_item_adicionais pia
                 WHERE pia.pedido_item_id = :item_id'
            );
            $stmtAddons->execute(['item_id' => $item['id']]);
            $item['adicionais'] = $stmtAddons->fetchAll() ?: [];
        }

        $order['itens'] = $items;

        return $order;
    }

    public function updateOrderStatus(int $orderId, int $tenantId, string $newStatus, ?int $userId = null): bool
    {
        if ($this->db === null) {
            return false;
        }

        $this->db->beginTransaction();
        try {
            $stmt = $this->db->prepare(
                'UPDATE pedidos SET status = :status WHERE id = :id AND tenant_id = :tenant_id'
            );
            $stmt->execute(['status' => $newStatus, 'id' => $orderId, 'tenant_id' => $tenantId]);

            $stmtHist = $this->db->prepare(
                'INSERT INTO pedido_historico_status (tenant_id, pedido_id, usuario_id, status_novo, observacao)
                 VALUES (:tenant_id, :pedido_id, :usuario_id, :status_novo, :observacao)'
            );
            $stmtHist->execute([
                'tenant_id' => $tenantId,
                'pedido_id' => $orderId,
                'usuario_id' => $userId > 0 ? $userId : null,
                'status_novo' => $newStatus,
                'observacao' => 'Status alterado via painel para ' . $newStatus,
            ]);

            $this->db->commit();
            return true;
        } catch (\Throwable $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function deleteOrder(int $orderId, int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare('DELETE FROM pedidos WHERE id = :id AND tenant_id = :tenant_id');
        return $stmt->execute(['id' => $orderId, 'tenant_id' => $tenantId]);
    }

    public function deleteCancelledOrders(int $tenantId): bool
    {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM pedidos WHERE tenant_id = :tenant_id AND status = 'cancelado'");
        return $stmt->execute(['tenant_id' => $tenantId]);
    }

    public function getCountsByStatus(int $tenantId): array
    {
        if ($this->db === null) {
            return [];
        }

        $stmt = $this->db->prepare(
            'SELECT status, COUNT(*) as total
             FROM pedidos
             WHERE tenant_id = :tenant_id
             GROUP BY status'
        );
        $stmt->execute(['tenant_id' => $tenantId]);
        $rows = $stmt->fetchAll() ?: [];

        $counts = [
            'pendente' => 0,
            'aceito' => 0,
            'em_preparo' => 0,
            'pronto' => 0,
            'saiu_entrega' => 0,
            'finalizado' => 0,
            'cancelado' => 0,
        ];

        foreach ($rows as $row) {
            $status = (string) $row['status'];
            if ($status === 'novo') {
                $counts['pendente'] += (int) $row['total'];
            } elseif ($status === 'preparando') {
                $counts['em_preparo'] += (int) $row['total'];
            } elseif ($status === 'saiu_para_entrega') {
                $counts['saiu_entrega'] += (int) $row['total'];
            } elseif (array_key_exists($status, $counts)) {
                $counts[$status] += (int) $row['total'];
            }
        }

        return $counts;
    }

    public function getDashboardMetrics(int $tenantId, ?string $startDate = null, ?string $endDate = null): array
    {
        if ($this->db === null) {
            return [
                'orders_count' => 0,
                'total_revenue' => 0.0,
                'average_ticket' => 0.0,
                'open_orders' => 0,
            ];
        }

        $params = ['tenant_id' => $tenantId];
        $dateFilter = '';

        if ($startDate !== null && $startDate !== '') {
            $dateFilter .= ' AND DATE(criado_em) >= :start_date';
            $params['start_date'] = $startDate;
        }

        if ($endDate !== null && $endDate !== '') {
            $dateFilter .= ' AND DATE(criado_em) <= :end_date';
            $params['end_date'] = $endDate;
        }

        // Estatísticas do período (apenas pedidos finalizados/entregues para faturamento, ou todos exceto cancelados)
        $sql = "SELECT 
                    COUNT(*) as total_pedidos,
                    COALESCE(SUM(CASE WHEN status NOT IN ('cancelado') THEN total ELSE 0 END), 0) as faturamento_total,
                    COALESCE(AVG(CASE WHEN status NOT IN ('cancelado') THEN total ELSE NULL END), 0) as ticket_medio
                FROM pedidos
                WHERE tenant_id = :tenant_id {$dateFilter}";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch() ?: [];

        // Pedidos abertos no momento (novo, aceito, preparando, pronto, saiu_para_entrega)
        $sqlOpen = "SELECT COUNT(*) as total_abertos
                    FROM pedidos
                    WHERE tenant_id = :tenant_id AND status IN ('novo', 'pendente', 'aceito', 'preparando', 'em_preparo', 'pronto', 'saiu_para_entrega', 'saiu_entrega')";
        $stmtOpen = $this->db->prepare($sqlOpen);
        $stmtOpen->execute(['tenant_id' => $tenantId]);
        $rowOpen = $stmtOpen->fetch() ?: [];

        return [
            'orders_count' => (int) ($row['total_pedidos'] ?? 0),
            'total_revenue' => (float) ($row['faturamento_total'] ?? 0),
            'average_ticket' => (float) ($row['ticket_medio'] ?? 0),
            'open_orders' => (int) ($rowOpen['total_abertos'] ?? 0),
        ];
    }

    public function getTopProducts(int $tenantId, ?string $startDate = null, ?string $endDate = null, int $limit = 5): array
    {
        if ($this->db === null) {
            return [];
        }

        $params = ['tenant_id' => $tenantId];
        $dateFilter = '';

        if ($startDate !== null && $startDate !== '') {
            $dateFilter .= ' AND DATE(p.criado_em) >= :start_date';
            $params['start_date'] = $startDate;
        }

        if ($endDate !== null && $endDate !== '') {
            $dateFilter .= ' AND DATE(p.criado_em) <= :end_date';
            $params['end_date'] = $endDate;
        }

        $sql = "SELECT pi.nome, SUM(pi.quantidade) as total_qtd, SUM(pi.subtotal) as total_valor
                FROM pedido_itens pi
                JOIN pedidos p ON p.id = pi.pedido_id
                WHERE p.tenant_id = :tenant_id AND p.status NOT IN ('cancelado') {$dateFilter}
                GROUP BY pi.nome
                ORDER BY total_qtd DESC, total_valor DESC
                LIMIT " . (int) $limit;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll() ?: [];
    }

    public function getTopPaymentMethods(int $tenantId, ?string $startDate = null, ?string $endDate = null): array
    {
        if ($this->db === null) {
            return [];
        }

        $params = ['tenant_id' => $tenantId];
        $dateFilter = '';

        if ($startDate !== null && $startDate !== '') {
            $dateFilter .= ' AND DATE(criado_em) >= :start_date';
            $params['start_date'] = $startDate;
        }

        if ($endDate !== null && $endDate !== '') {
            $dateFilter .= ' AND DATE(criado_em) <= :end_date';
            $params['end_date'] = $endDate;
        }

        $sql = "SELECT forma_pagamento, COUNT(*) as qtd, SUM(total) as valor_total
                FROM pedidos
                WHERE tenant_id = :tenant_id AND status NOT IN ('cancelado') {$dateFilter}
                GROUP BY forma_pagamento
                ORDER BY qtd DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll() ?: [];
    }

    public function getTopNeighborhoods(int $tenantId, ?string $startDate = null, ?string $endDate = null, int $limit = 5): array
    {
        if ($this->db === null) {
            return [];
        }

        $params = ['tenant_id' => $tenantId];
        $dateFilter = '';

        if ($startDate !== null && $startDate !== '') {
            $dateFilter .= ' AND DATE(criado_em) >= :start_date';
            $params['start_date'] = $startDate;
        }

        if ($endDate !== null && $endDate !== '') {
            $dateFilter .= ' AND DATE(criado_em) <= :end_date';
            $params['end_date'] = $endDate;
        }

        $sql = "SELECT cliente_bairro AS bairro, COUNT(*) as qtd, SUM(total) as valor_total
                FROM pedidos
                WHERE tenant_id = :tenant_id AND status NOT IN ('cancelado') AND cliente_bairro IS NOT NULL AND cliente_bairro != '' {$dateFilter}
                GROUP BY cliente_bairro
                ORDER BY qtd DESC
                LIMIT " . (int) $limit;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll() ?: [];
    }
}
