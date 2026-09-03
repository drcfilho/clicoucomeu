<?php

declare(strict_types=1);

use App\Controllers\Public\OrderController;
use App\Helpers\Router;

$router = new Router();

$router->get('/api/v1/health', static function ($request, $response): void {
    $response->json([
        'success' => true,
        'data' => [
            'status' => 'ok',
        ],
    ]);
});

$router->post('/api/v1/public/{tenant}/orders', [OrderController::class, 'createPublic']);
$router->get('/api/v1/public/orders/{token}', [OrderController::class, 'show']);

return $router;
