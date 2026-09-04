<?php

declare(strict_types=1);

namespace App\Controllers\Public;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use RuntimeException;

class OrderController
{
    public function __construct(private Container $container)
    {
    }

    public function show(Request $request, Response $response, array $params = []): void
    {
        $order = $this->container->get('orderService')->findPublicStatusByToken((string) ($params['token'] ?? ''));

        if ($order === null) {
            $response->json([
                'success' => false,
                'error' => [
                    'code' => 'NOT_FOUND',
                    'message' => 'Pedido nao encontrado',
                ],
            ], 404);
            return;
        }

        $response->json([
            'success' => true,
            'data' => [
                'order_number' => (int) $order['numero'],
                'token' => $order['token'],
                'status' => $order['status'],
                'total' => (float) $order['total'],
                'customer_name' => $order['cliente_nome'],
                'fulfillment_type' => $order['tipo_recebimento'],
                'created_at' => $order['criado_em'],
            ],
        ]);
    }

    public function showPage(Request $request, Response $response, array $params = []): void
    {
        $token = (string) ($params['token'] ?? '');
        $order = $this->container->get('orderService')->findPublicStatusByToken($token);

        if ($order === null) {
            $response->view('errors.404', [
                'message' => 'Pedido nao encontrado.',
            ], 404);
            return;
        }

        $response->view('public.order-status', [
            'order' => $order,
            'token' => $token,
        ]);
    }

    public function createPublic(Request $request, Response $response, array $params = []): void
    {
        $ip = $request->ip();
        if (!\App\Helpers\RateLimiter::check('create_order_' . $ip, 10, 60)) {
            $response->json([
                'success' => false,
                'error' => [
                    'code' => 'TOO_MANY_REQUESTS',
                    'message' => 'Muitas requisições enviadas. Aguarde um momento.',
                ],
            ], 429);
            return;
        }

        try {
            $result = $this->container->get('orderService')->createPublicOrder(
                (string) ($params['tenant'] ?? ''),
                $request->json()
            );
        } catch (RuntimeException $exception) {
            $response->json([
                'success' => false,
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => $exception->getMessage(),
                ],
            ], 422);
            return;
        }

        $response->json([
            'success' => true,
            'data' => $result,
        ], 201);
    }
}
