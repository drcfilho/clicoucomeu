<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\Admin\TenantController;
use App\Controllers\Cozinha\KitchenController;
use App\Controllers\Painel\CategoryController;
use App\Controllers\Painel\ProductController;
use App\Controllers\Painel\AddonController;
use App\Controllers\Painel\NeighborhoodController;
use App\Controllers\Painel\PaymentMethodController;
use App\Controllers\Painel\StoreHoursController;
use App\Controllers\Painel\CouponController;
use App\Controllers\Painel\OrderController as PainelOrderController;
use App\Controllers\Painel\DashboardController;
use App\Controllers\Public\HomeController;
use App\Controllers\Public\OrderController;
use App\Controllers\Public\RegisterController;
use App\Helpers\Router;
use App\Middleware\AuthMiddleware;
use App\Middleware\PermissionMiddleware;
use App\Middleware\TenantMiddleware;

$router = new Router();

$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/cadastrar', [RegisterController::class, 'showRegister']);
$router->post('/cadastrar', [RegisterController::class, 'register']);
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
$router->get('/{tenant}/painel', [DashboardController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);

$router->get('/painel/categorias', [CategoryController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/categorias', [CategoryController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/categorias', [CategoryController::class, 'store'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/categorias', [CategoryController::class, 'store'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/categorias/{id}/editar', [CategoryController::class, 'update'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/categorias/{id}/editar', [CategoryController::class, 'update'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/categorias/{id}/toggle', [CategoryController::class, 'toggle'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/categorias/{id}/toggle', [CategoryController::class, 'toggle'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/categorias/{id}/excluir', [CategoryController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/categorias/{id}/excluir', [CategoryController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);

$router->get('/painel/produtos', [ProductController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/produtos', [ProductController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/produtos', [ProductController::class, 'store'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/produtos', [ProductController::class, 'store'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/produtos/{id}/editar', [ProductController::class, 'update'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/produtos/{id}/editar', [ProductController::class, 'update'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/produtos/{id}/disponibilidade', [ProductController::class, 'toggleAvailability'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/produtos/{id}/disponibilidade', [ProductController::class, 'toggleAvailability'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/produtos/{id}/duplicar', [ProductController::class, 'duplicate'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/produtos/{id}/duplicar', [ProductController::class, 'duplicate'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/produtos/{id}/excluir', [ProductController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/produtos/{id}/excluir', [ProductController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/painel/produtos/{id}/variacoes', [ProductController::class, 'variations'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/produtos/{id}/variacoes', [ProductController::class, 'variations'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/produtos/{id}/variacoes', [ProductController::class, 'storeVariation'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/produtos/{id}/variacoes', [ProductController::class, 'storeVariation'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/produtos/{id}/variacoes/{varId}/editar', [ProductController::class, 'updateVariation'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/produtos/{id}/variacoes/{varId}/editar', [ProductController::class, 'updateVariation'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/produtos/{id}/variacoes/{varId}/excluir', [ProductController::class, 'deleteVariation'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/produtos/{id}/variacoes/{varId}/excluir', [ProductController::class, 'deleteVariation'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);

/* Rotas de Grupos e Adicionais */
$router->get('/painel/adicionais', [AddonController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/adicionais', [AddonController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/adicionais', [AddonController::class, 'storeGroup'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/adicionais', [AddonController::class, 'storeGroup'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/adicionais/{id}/editar', [AddonController::class, 'updateGroup'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/adicionais/{id}/editar', [AddonController::class, 'updateGroup'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/adicionais/{id}/excluir', [AddonController::class, 'deleteGroup'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/adicionais/{id}/excluir', [AddonController::class, 'deleteGroup'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/painel/adicionais/{id}/itens', [AddonController::class, 'items'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/adicionais/{id}/itens', [AddonController::class, 'items'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/adicionais/{id}/itens', [AddonController::class, 'storeItem'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/adicionais/{id}/itens', [AddonController::class, 'storeItem'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/adicionais/{id}/itens/{itemId}/editar', [AddonController::class, 'updateItem'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/adicionais/{id}/itens/{itemId}/editar', [AddonController::class, 'updateItem'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/adicionais/{id}/itens/{itemId}/excluir', [AddonController::class, 'deleteItem'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/adicionais/{id}/itens/{itemId}/excluir', [AddonController::class, 'deleteItem'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);

/* Rotas de Bairros e Taxas de Entrega */
$router->get('/painel/bairros', [NeighborhoodController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/bairros', [NeighborhoodController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/bairros', [NeighborhoodController::class, 'store'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/bairros', [NeighborhoodController::class, 'store'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/bairros/{id}/editar', [NeighborhoodController::class, 'update'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/bairros/{id}/editar', [NeighborhoodController::class, 'update'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/bairros/{id}/toggle', [NeighborhoodController::class, 'toggle'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/bairros/{id}/toggle', [NeighborhoodController::class, 'toggle'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/bairros/{id}/excluir', [NeighborhoodController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/bairros/{id}/excluir', [NeighborhoodController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);

/* Rotas de Formas de Pagamento */
$router->get('/painel/pagamentos', [PaymentMethodController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/pagamentos', [PaymentMethodController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/pagamentos', [PaymentMethodController::class, 'store'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/pagamentos', [PaymentMethodController::class, 'store'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/pagamentos/{id}/editar', [PaymentMethodController::class, 'update'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/pagamentos/{id}/editar', [PaymentMethodController::class, 'update'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/pagamentos/{id}/toggle', [PaymentMethodController::class, 'toggle'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/pagamentos/{id}/toggle', [PaymentMethodController::class, 'toggle'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/pagamentos/{id}/excluir', [PaymentMethodController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/pagamentos/{id}/excluir', [PaymentMethodController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);

/* Rotas de Horários de Funcionamento */
$router->get('/painel/horarios', [StoreHoursController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/horarios', [StoreHoursController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/horarios', [StoreHoursController::class, 'save'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/horarios', [StoreHoursController::class, 'save'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/horarios/manual', [StoreHoursController::class, 'toggleManual'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/horarios/manual', [StoreHoursController::class, 'toggleManual'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);

/* Rotas de Cupons de Desconto */
$router->get('/painel/cupons', [CouponController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/cupons', [CouponController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/cupons', [CouponController::class, 'store'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/cupons', [CouponController::class, 'store'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/cupons/{id}/editar', [CouponController::class, 'update'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/cupons/{id}/editar', [CouponController::class, 'update'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/cupons/{id}/toggle', [CouponController::class, 'toggle'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/cupons/{id}/toggle', [CouponController::class, 'toggle'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/cupons/{id}/excluir', [CouponController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/cupons/{id}/excluir', [CouponController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);

/* Rotas de Configurações do Tenant */
$router->get('/painel/configuracoes', [\App\Controllers\Painel\SettingsController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/configuracoes', [\App\Controllers\Painel\SettingsController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/configuracoes', [\App\Controllers\Painel\SettingsController::class, 'save'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/configuracoes', [\App\Controllers\Painel\SettingsController::class, 'save'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);

/* Rotas do Painel de Pedidos em Tempo Real */
$router->get('/painel/pedidos', [PainelOrderController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/pedidos', [PainelOrderController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/painel/pedidos/polling', [PainelOrderController::class, 'poll'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/pedidos/polling', [PainelOrderController::class, 'poll'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/painel/pedidos/{id}', [PainelOrderController::class, 'show'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/pedidos/{id}', [PainelOrderController::class, 'show'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/painel/pedidos/{id}/imprimir', [PainelOrderController::class, 'print'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/painel/pedidos/{id}/imprimir', [PainelOrderController::class, 'print'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/pedidos/limpar-cancelados', [PainelOrderController::class, 'clearCancelled'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/pedidos/limpar-cancelados', [PainelOrderController::class, 'clearCancelled'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/pedidos/{id}/status', [PainelOrderController::class, 'updateStatus'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/pedidos/{id}/status', [PainelOrderController::class, 'updateStatus'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/painel/pedidos/{id}/excluir', [PainelOrderController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/painel/pedidos/{id}/excluir', [PainelOrderController::class, 'delete'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);

$router->get('/cozinha', [KitchenController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/cozinha', [KitchenController::class, 'index'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/cozinha/polling', [KitchenController::class, 'poll'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}/cozinha/polling', [KitchenController::class, 'poll'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/cozinha/{id}/status', [KitchenController::class, 'updateStatus'], [
    AuthMiddleware::class,
    TenantMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/{tenant}/cozinha/{id}/status', [KitchenController::class, 'updateStatus'], [
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
$router->post('/admin/tenants/{id}/bloquear', [TenantController::class, 'block'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/admin/tenants/{id}/admin', [TenantController::class, 'createAdmin'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/admin/tenants/{id}/plano', [TenantController::class, 'updatePlan'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->post('/admin/tenants/{id}/prorrogar-trial', [TenantController::class, 'extendTrial'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/admin/tenants/{id}/acessar', [TenantController::class, 'impersonate'], [
    AuthMiddleware::class,
    PermissionMiddleware::class,
]);
$router->get('/{tenant}', [HomeController::class, 'index']);

return $router;
