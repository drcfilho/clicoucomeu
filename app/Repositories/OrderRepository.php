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
            $sql .= ' AND p.status = :status';
            $params['status'] = $status;
        }

        $sql .= ' ORDER BY p.created_at DESC, p.id DESC LIMIT ' . (int) $limit;

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
                    c.nome AS cliente_nome_cadastrado, c.telefone AS cliente_telefone
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
            'SELECT pi.*, pr.nome AS produto_nome, v.nome AS variacao_nome
             FROM pedido_itens pi
             LEFT JOIN produtos pr ON pr.id = pi.produto_id
             LEFT JOIN produto_variacoes v ON v.id = pi.variacao_id
             WHERE pi.pedido_id = :pedido_id'
        );
        $stmtItems->execute(['pedido_id' => $orderId]);
        $items = $stmtItems->fetchAll() ?: [];

        // Buscar adicionais para cada item
        foreach ($items as &$item) {
            $stmtAddons = $this->db->prepare(
                'SELECT pia.*, a.nome AS adicional_nome, g.nome AS grupo_nome
                 FROM pedido_item_adicionais pia
                 LEFT JOIN adicionais a ON a.id = pia.adicional_id
                 LEFT JOIN grupos_adicionais g ON g.id = a.grupo_id
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
                'INSERT INTO pedido_historicos (pedido_id, usuario_id, status, observacao)
                 VALUES (:pedido_id, :usuario_id, :status, :observacao)'
            );
            $stmtHist->execute([
                'pedido_id' => $orderId,
                'usuario_id' => $userId,
                'status' => $newStatus,
                'observacao' => 'Status alterado via painel para ' . $newStatus,
            ]);

            $this->db->commit();
            return true;
        } catch (\Throwable $e) {
            $this->db->rollBack();
            return false;
        }
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
            if (array_key_exists($status, $counts)) {
                $counts[$status] = (int) $row['total'];
            }
        }

        return $counts;
    }
}
