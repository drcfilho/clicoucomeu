<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\TenantResolver;
use App\Repositories\CouponRepository;
use App\Repositories\NeighborhoodRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\ProductRepository;
use DateTimeImmutable;
use DateTimeZone;
use PDO;
use RuntimeException;

class OrderService
{
    public function __construct(
        private ?PDO $db,
        private array $appConfig,
        private TenantResolver $tenantResolver,
        private ProductRepository $products,
        private NeighborhoodRepository $neighborhoods,
        private PaymentMethodRepository $paymentMethods,
        private ?CouponService $couponService = null,
        private ?CouponRepository $couponRepo = null
    ) {
    }

    public function createPublicOrder(string $tenantSlug, array $payload): array
    {
        if ($this->db === null) {
            throw new RuntimeException('Banco indisponivel');
        }

        $tenant = $this->tenantResolver->resolveBySlug($tenantSlug);
        if ($tenant === null) {
            throw new RuntimeException('Tenant nao encontrado');
        }

        $tenantId = (int) $tenant['id'];
        $customer = $payload['customer'] ?? [];
        $fulfillment = $payload['fulfillment'] ?? [];
        $payment = $payload['payment'] ?? [];
        $items = $payload['items'] ?? [];

        if (!is_array($customer) || trim((string) ($customer['name'] ?? '')) === '') {
            throw new RuntimeException('Nome do cliente e obrigatorio');
        }

        if (!is_array($customer) || trim((string) ($customer['whatsapp'] ?? '')) === '') {
            throw new RuntimeException('WhatsApp do cliente e obrigatorio');
        }

        if (!is_array($items) || $items === []) {
            throw new RuntimeException('Carrinho vazio');
        }

        $this->assertStoreOpen($tenantId, (string) ($tenant['timezone'] ?? 'America/Sao_Paulo'));

        $paymentMethodId = (int) ($payment['payment_method_id'] ?? 0);
        $paymentMethods = $this->paymentMethods->findIndexedByTenantId($tenantId);
        $paymentMethod = $paymentMethods[$paymentMethodId] ?? null;
        if ($paymentMethod === null) {
            throw new RuntimeException('Forma de pagamento invalida');
        }

        $type = (string) ($fulfillment['type'] ?? 'retirada');
        $type = $type === 'delivery' ? 'delivery' : 'retirada';

        $bairroId = $type === 'delivery' ? (int) ($fulfillment['bairro_id'] ?? 0) : 0;
        $bairro = null;
        if ($type === 'delivery') {
            $neighborhoods = $this->neighborhoods->findIndexedByTenantId($tenantId);
            $bairro = $neighborhoods[$bairroId] ?? null;
            if ($bairro === null) {
                throw new RuntimeException('Bairro invalido');
            }
        }

        $productIds = [];
        $variationIds = [];
        $addonIds = [];

        foreach ($items as $item) {
            $productIds[] = (int) ($item['product_id'] ?? 0);
            if (!empty($item['variation_id'])) {
                $variationIds[] = (int) $item['variation_id'];
            }
            foreach (($item['addons'] ?? []) as $addonId) {
                $addonIds[] = (int) $addonId;
            }
        }

        $productMap = $this->products->findIndexedByIdsForTenant($tenantId, $productIds);
        $variationMap = $this->products->findVariationsIndexedByIdsForTenant($tenantId, $variationIds);
        $addonMap = $this->products->findAddonsIndexedByIdsForTenant($tenantId, $addonIds);

        $calculatedItems = [];
        $subtotal = 0.0;

        foreach ($items as $item) {
            $productId = (int) ($item['product_id'] ?? 0);
            $product = $productMap[$productId] ?? null;
            if ($product === null) {
                throw new RuntimeException('Produto invalido no carrinho');
            }

            $quantity = max(1, (int) ($item['quantity'] ?? 1));
            $variation = null;
            $unitPrice = $product['preco'] !== null ? (float) $product['preco'] : 0.0;
            $variationId = (int) ($item['variation_id'] ?? 0);

            if ($variationId > 0) {
                $variation = $variationMap[$variationId] ?? null;
                if ($variation === null || (int) $variation['produto_id'] !== $productId) {
                    throw new RuntimeException('Variacao invalida no carrinho');
                }
                $unitPrice = (float) $variation['preco'];
            }

            $selectedAddons = [];
            $addonsTotal = 0.0;

            foreach (($item['addons'] ?? []) as $addonId) {
                $addon = $addonMap[(int) $addonId] ?? null;
                if (
                    $addon === null
                    || !in_array($productId, $addon['produto_ids'] ?? [], true)
                ) {
                    throw new RuntimeException('Adicional invalido no carrinho');
                }

                $selectedAddons[] = $addon;
            }

            $addonsTotal = $this->calculateAddonsTotal($selectedAddons);

            $lineTotal = ($unitPrice + $addonsTotal) * $quantity;
            $subtotal += $lineTotal;

            $calculatedItems[] = [
                'product' => $product,
                'variation' => $variation,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'addons_total' => $addonsTotal,
                'line_total' => $lineTotal,
                'notes' => trim((string) ($item['notes'] ?? '')),
                'addons' => $selectedAddons,
            ];
        }

        $deliveryFee = $bairro !== null ? (float) $bairro['taxa_entrega'] : 0.0;
        $discount = 0.0;
        $couponId = null;

        $couponCode = trim((string) ($payload['coupon_code'] ?? ''));
        if (!empty($couponCode) && $this->couponService !== null) {
            $couponResult = $this->couponService->validateAndCalculate($tenantId, $couponCode, $subtotal, $deliveryFee);
            if ($couponResult['valid']) {
                $discount = (float) $couponResult['discount'];
                $couponId = (int) $couponResult['coupon']['id'];
            }
        }

        $total = max(0.0, $subtotal + $deliveryFee - $discount);

        $this->db->beginTransaction();

        try {
            $clientId = $this->findOrCreateClient(
                $tenantId,
                trim((string) $customer['name']),
                preg_replace('/\D+/', '', (string) $customer['whatsapp']) ?: trim((string) $customer['whatsapp'])
            );
            $number = $this->nextOrderNumber($tenantId);
            $token = $this->generateUniqueOrderToken();

            $orderStmt = $this->db->prepare(
                'INSERT INTO pedidos
                 (tenant_id, cliente_id, bairro_id, forma_pagamento_id, cupom_id, numero, token,
                  cliente_nome, cliente_whatsapp, tipo_recebimento, endereco, numero_endereco, complemento,
                  referencia, bairro_nome, forma_pagamento_nome, troco_para, subtotal, taxa_entrega, desconto,
                  total, observacao, status)
                 VALUES
                 (:tenant_id, :cliente_id, :bairro_id, :forma_pagamento_id, :cupom_id, :numero, :token,
                  :cliente_nome, :cliente_whatsapp, :tipo_recebimento, :endereco, :numero_endereco, :complemento,
                  :referencia, :bairro_nome, :forma_pagamento_nome, :troco_para, :subtotal, :taxa_entrega, :desconto,
                  :total, :observacao, :status)'
            );

            $orderStmt->execute([
                'tenant_id' => $tenantId,
                'cliente_id' => $clientId,
                'bairro_id' => $bairro !== null ? (int) $bairro['id'] : null,
                'forma_pagamento_id' => $paymentMethodId,
                'cupom_id' => $couponId,
                'numero' => $number,
                'token' => $token,
                'cliente_nome' => trim((string) $customer['name']),
                'cliente_whatsapp' => preg_replace('/\D+/', '', (string) $customer['whatsapp']) ?: trim((string) $customer['whatsapp']),
                'tipo_recebimento' => $type,
                'endereco' => $type === 'delivery' ? (string) ($fulfillment['address'] ?? '') : null,
                'numero_endereco' => $type === 'delivery' ? (string) ($fulfillment['number'] ?? '') : null,
                'complemento' => $type === 'delivery' ? (string) ($fulfillment['complement'] ?? '') : null,
                'referencia' => $type === 'delivery' ? (string) ($fulfillment['reference'] ?? '') : null,
                'bairro_nome' => $bairro !== null ? (string) $bairro['nome'] : null,
                'forma_pagamento_nome' => (string) $paymentMethod['nome'],
                'troco_para' => !empty($payment['change_for']) ? (float) $payment['change_for'] : null,
                'subtotal' => $subtotal,
                'taxa_entrega' => $deliveryFee,
                'desconto' => $discount,
                'total' => $total,
                'observacao' => trim((string) ($payload['notes'] ?? '')) ?: null,
                'status' => 'novo',
            ]);

            $orderId = (int) $this->db->lastInsertId();

            $itemStmt = $this->db->prepare(
                'INSERT INTO pedido_itens
                 (tenant_id, pedido_id, produto_id, variacao_id, produto_nome, variacao_nome, quantidade,
                  valor_unitario, valor_adicionais, valor_total, observacao)
                 VALUES
                 (:tenant_id, :pedido_id, :produto_id, :variacao_id, :produto_nome, :variacao_nome, :quantidade,
                  :valor_unitario, :valor_adicionais, :valor_total, :observacao)'
            );
            $addonStmt = $this->db->prepare(
                'INSERT INTO pedido_item_adicionais
                 (tenant_id, pedido_item_id, adicional_id, nome, quantidade, valor_unitario, valor_total)
                 VALUES
                 (:tenant_id, :pedido_item_id, :adicional_id, :nome, 1, :valor_unitario, :valor_total)'
            );

            foreach ($calculatedItems as $calculatedItem) {
                $itemStmt->execute([
                    'tenant_id' => $tenantId,
                    'pedido_id' => $orderId,
                    'produto_id' => (int) $calculatedItem['product']['id'],
                    'variacao_id' => $calculatedItem['variation'] !== null ? (int) $calculatedItem['variation']['id'] : null,
                    'produto_nome' => (string) $calculatedItem['product']['nome'],
                    'variacao_nome' => $calculatedItem['variation'] !== null ? (string) $calculatedItem['variation']['nome'] : null,
                    'quantidade' => $calculatedItem['quantity'],
                    'valor_unitario' => $calculatedItem['unit_price'],
                    'valor_adicionais' => $calculatedItem['addons_total'],
                    'valor_total' => $calculatedItem['line_total'],
                    'observacao' => $calculatedItem['notes'] !== '' ? $calculatedItem['notes'] : null,
                ]);

                $orderItemId = (int) $this->db->lastInsertId();

                foreach ($calculatedItem['addons'] as $addon) {
                    $addonStmt->execute([
                        'tenant_id' => $tenantId,
                        'pedido_item_id' => $orderItemId,
                        'adicional_id' => (int) $addon['adicional_id'],
                        'nome' => (string) $addon['adicional_nome'],
                        'valor_unitario' => (float) $addon['preco'],
                        'valor_total' => (float) $addon['preco'],
                    ]);
                }
            }

            $historyStmt = $this->db->prepare(
                'INSERT INTO pedido_historico_status (tenant_id, pedido_id, usuario_id, status_anterior, status_novo, observacao)
                 VALUES (:tenant_id, :pedido_id, NULL, NULL, :status_novo, :observacao)'
            );
            $historyStmt->execute([
                'tenant_id' => $tenantId,
                'pedido_id' => $orderId,
                'status_novo' => 'novo',
                'observacao' => 'Pedido criado pelo cliente no cardapio publico',
            ]);

            if ($couponId !== null && $this->couponRepo !== null) {
                $this->couponRepo->incrementUsage($couponId);
            }

            $this->db->commit();

            return [
                'order_id' => $orderId,
                'order_number' => $number,
                'token' => $token,
                'status' => 'novo',
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'discount' => $discount,
                'total' => $total,
            ];
        } catch (\Throwable $exception) {
            $this->db->rollBack();
            throw $exception;
        }
    }

    private function calculateAddonsTotal(array $addons): float
    {
        $total = 0.0;
        $flavorPrices = [];

        foreach ($addons as $addon) {
            $price = (float) ($addon['preco'] ?? 0);
            $groupName = (string) ($addon['grupo_nome'] ?? '');
            $groupMax = (int) ($addon['grupo_maximo'] ?? 0);

            if ($groupMax === 2 && stripos($groupName, 'sabor') !== false) {
                $flavorPrices[] = $price;
                continue;
            }

            $total += $price;
        }

        return $total + ($flavorPrices !== [] ? max($flavorPrices) : 0.0);
    }

    public function findPublicStatusByToken(string $token): ?array
    {
        if ($this->db === null) {
            return null;
        }

        $stmt = $this->db->prepare(
            'SELECT numero, token, status, total, cliente_nome, tipo_recebimento, criado_em
             FROM pedidos
             WHERE token = :token
             LIMIT 1'
        );
        $stmt->execute(['token' => $token]);
        $row = $stmt->fetch();

        return is_array($row) ? $row : null;
    }

    private function generateUniqueOrderToken(): string
    {
        for ($attempt = 0; $attempt < 5; $attempt += 1) {
            $token = bin2hex(random_bytes(16));

            $stmt = $this->db->prepare('SELECT 1 FROM pedidos WHERE token = :token LIMIT 1');
            $stmt->execute(['token' => $token]);

            if ($stmt->fetchColumn() === false) {
                return $token;
            }
        }

        throw new RuntimeException('Falha ao gerar token unico do pedido');
    }

    private function assertStoreOpen(int $tenantId, string $timezone): void
    {
        if (($this->appConfig['dev']['bypass_store_hours'] ?? false) === true) {
            return;
        }

        $now = new DateTimeImmutable('now', new DateTimeZone($timezone));
        $weekday = (int) $now->format('w');
        $currentTime = $now->format('H:i:s');

        $stmt = $this->db->prepare(
            'SELECT abertura, fechamento
             FROM horarios_funcionamento
             WHERE tenant_id = :tenant_id AND dia_semana = :dia_semana AND ativo = 1'
        );
        $stmt->execute([
            'tenant_id' => $tenantId,
            'dia_semana' => $weekday,
        ]);

        $rows = $stmt->fetchAll() ?: [];
        if ($rows === []) {
            throw new RuntimeException('Loja fechada no momento');
        }

        foreach ($rows as $row) {
            $start = (string) $row['abertura'];
            $end = (string) $row['fechamento'];
            if ($start !== '' && $end !== '' && $currentTime >= $start && $currentTime <= $end) {
                return;
            }
        }

        throw new RuntimeException('Loja fechada no momento');
    }

    private function findOrCreateClient(int $tenantId, string $name, string $whatsapp): int
    {
        $findStmt = $this->db->prepare(
            'SELECT id FROM clientes WHERE tenant_id = :tenant_id AND whatsapp = :whatsapp LIMIT 1'
        );
        $findStmt->execute([
            'tenant_id' => $tenantId,
            'whatsapp' => $whatsapp,
        ]);
        $existingId = $findStmt->fetchColumn();

        if ($existingId) {
            $updateStmt = $this->db->prepare(
                'UPDATE clientes SET nome = :nome, atualizado_em = CURRENT_TIMESTAMP WHERE id = :id'
            );
            $updateStmt->execute([
                'nome' => $name,
                'id' => (int) $existingId,
            ]);

            return (int) $existingId;
        }

        $insertStmt = $this->db->prepare(
            'INSERT INTO clientes (tenant_id, nome, whatsapp) VALUES (:tenant_id, :nome, :whatsapp)'
        );
        $insertStmt->execute([
            'tenant_id' => $tenantId,
            'nome' => $name,
            'whatsapp' => $whatsapp,
        ]);

        return (int) $this->db->lastInsertId();
    }

    private function nextOrderNumber(int $tenantId): int
    {
        $insertStmt = $this->db->prepare(
            'INSERT IGNORE INTO sequencias_pedido (tenant_id, ultimo_numero) VALUES (:tenant_id, 0)'
        );
        $insertStmt->execute(['tenant_id' => $tenantId]);

        $updateStmt = $this->db->prepare(
            'UPDATE sequencias_pedido
             SET ultimo_numero = LAST_INSERT_ID(ultimo_numero + 1)
             WHERE tenant_id = :tenant_id'
        );
        $updateStmt->execute(['tenant_id' => $tenantId]);

        return (int) $this->db->query('SELECT LAST_INSERT_ID()')->fetchColumn();
    }
}
