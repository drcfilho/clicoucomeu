<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\Admin\TenantController;
use App\Controllers\Cozinha\KitchenController;
use App\Controllers\Painel\DashboardController;
use App\Controllers\Public\HomeController;
use App\Controllers\Public\OrderController;
use App\Helpers\Router;
use App\Middleware\AuthMiddleware;
use App\Middleware\PermissionMiddleware;
use App\Middleware\TenantMiddleware;

$router = new Router();

$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout'], [
    AuthMiddleware::class,
]);
$router->get('/', [HomeController::class, 'index']);
$router->get('/pedido/{token}', [OrderController::class, 'showPage']);
$router->get('/admin', [TenantController::class, 'home'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/painel', [DashboardController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/cozinha', [KitchenController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/admin/tenants', [TenantController::class, 'index'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/admin/tenants', [TenantController::class, 'store'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/admin/tenants/{id}/editar', [TenantController::class, 'edit'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/admin/tenants/{id}/editar', [TenantController::class, 'update'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/admin/tenants/{id}/ativar', [TenantController::class, 'activate'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}', [HomeController::class, 'index']);

return $router;
