<?php

declare(strict_types=1);

require_once BASE_PATH . '/app/Helpers/functions.php';
require_once BASE_PATH . '/app/Config/env.php';
require_once BASE_PATH . '/app/Config/app.php';
require_once BASE_PATH . '/app/Config/database.php';
require_once BASE_PATH . '/app/Helpers/Container.php';
require_once BASE_PATH . '/app/Helpers/Request.php';
require_once BASE_PATH . '/app/Helpers/Response.php';
require_once BASE_PATH . '/app/Helpers/View.php';
require_once BASE_PATH . '/app/Helpers/Router.php';
require_once BASE_PATH . '/app/Helpers/App.php';
require_once BASE_PATH . '/app/Helpers/ErrorHandler.php';
require_once BASE_PATH . '/app/Helpers/Logger.php';
require_once BASE_PATH . '/app/Helpers/Database.php';
require_once BASE_PATH . '/app/Helpers/Session.php';
require_once BASE_PATH . '/app/Helpers/Csrf.php';
require_once BASE_PATH . '/app/Validation/Validator.php';
require_once BASE_PATH . '/app/Middleware/AuthMiddleware.php';
require_once BASE_PATH . '/app/Middleware/TenantMiddleware.php';
require_once BASE_PATH . '/app/Middleware/PermissionMiddleware.php';
require_once BASE_PATH . '/app/Helpers/TenantResolver.php';
require_once BASE_PATH . '/app/Repositories/CategoryRepository.php';
require_once BASE_PATH . '/app/Repositories/ConfigurationRepository.php';
require_once BASE_PATH . '/app/Repositories/NeighborhoodRepository.php';
require_once BASE_PATH . '/app/Repositories/PaymentMethodRepository.php';
require_once BASE_PATH . '/app/Repositories/ProductRepository.php';
require_once BASE_PATH . '/app/Repositories/UserRepository.php';
require_once BASE_PATH . '/app/Services/AuthService.php';
require_once BASE_PATH . '/app/Services/MenuService.php';
require_once BASE_PATH . '/app/Services/OrderService.php';
require_once BASE_PATH . '/app/Controllers/AuthController.php';
require_once BASE_PATH . '/app/Controllers/Public/HomeController.php';
require_once BASE_PATH . '/app/Controllers/Public/OrderController.php';
require_once BASE_PATH . '/app/Controllers/Painel/DashboardController.php';
require_once BASE_PATH . '/app/Controllers/Admin/TenantController.php';
require_once BASE_PATH . '/app/Controllers/Cozinha/KitchenController.php';

function bootstrap(): App\Helpers\App
{
    App\Config\loadEnv(BASE_PATH . '/.env');

    $container = new App\Helpers\Container();

    $appConfig = App\Config\appConfig();
    $dbConfig = App\Config\databaseConfig();

    date_default_timezone_set($appConfig['timezone']);

    $container->set('config', [
        'app' => $appConfig,
        'database' => $dbConfig,
    ]);

    $container->set('logger', fn (): App\Helpers\Logger => new App\Helpers\Logger(
        BASE_PATH . '/storage/logs/app.log',
        (bool) $appConfig['debug']
    ));

    $container->set('db', fn (): ?PDO => App\Helpers\Database::connect($dbConfig));
    $container->set('request', fn (): App\Helpers\Request => App\Helpers\Request::capture());
    $container->set('response', function () use ($container): App\Helpers\Response {
        return new App\Helpers\Response($container->get('view'));
    });
    $container->set('view', fn (): App\Helpers\View => new App\Helpers\View(BASE_PATH . '/app/Views'));
    $container->set('session', fn (): App\Helpers\Session => new App\Helpers\Session($appConfig['session']));
    $container->set('csrf', function () use ($container): App\Helpers\Csrf {
        return new App\Helpers\Csrf($container->get('session'));
    });
    $container->set('validator', fn (): App\Validation\Validator => new App\Validation\Validator());
    $container->set('errorHandler', function () use ($container, $appConfig): App\Helpers\ErrorHandler {
        return new App\Helpers\ErrorHandler(
            $container->get('logger'),
            (bool) $appConfig['debug']
        );
    });
    $container->set('tenantResolver', function () use ($container): App\Helpers\TenantResolver {
        return new App\Helpers\TenantResolver(
            $container->get('db'),
            $container->get('logger')
        );
    });
    $container->set('userRepository', function () use ($container): App\Repositories\UserRepository {
        return new App\Repositories\UserRepository($container->get('db'));
    });
    $container->set('categoryRepository', function () use ($container): App\Repositories\CategoryRepository {
        return new App\Repositories\CategoryRepository($container->get('db'));
    });
    $container->set('configurationRepository', function () use ($container): App\Repositories\ConfigurationRepository {
        return new App\Repositories\ConfigurationRepository($container->get('db'));
    });
    $container->set('productRepository', function () use ($container): App\Repositories\ProductRepository {
        return new App\Repositories\ProductRepository($container->get('db'));
    });
    $container->set('neighborhoodRepository', function () use ($container): App\Repositories\NeighborhoodRepository {
        return new App\Repositories\NeighborhoodRepository($container->get('db'));
    });
    $container->set('paymentMethodRepository', function () use ($container): App\Repositories\PaymentMethodRepository {
        return new App\Repositories\PaymentMethodRepository($container->get('db'));
    });
    $container->set('auth', function () use ($container): App\Services\AuthService {
        return new App\Services\AuthService(
            $container->get('userRepository'),
            $container->get('session'),
            $container->get('config')['app']['auth'] ?? []
        );
    });
    $container->set('menuService', function () use ($container): App\Services\MenuService {
        return new App\Services\MenuService(
            $container->get('tenantResolver'),
            $container->get('configurationRepository'),
            $container->get('neighborhoodRepository'),
            $container->get('paymentMethodRepository'),
            $container->get('categoryRepository'),
            $container->get('productRepository')
        );
    });
    $container->set('orderService', function () use ($container): App\Services\OrderService {
        return new App\Services\OrderService(
            $container->get('db'),
            $container->get('config')['app'],
            $container->get('tenantResolver'),
            $container->get('productRepository'),
            $container->get('neighborhoodRepository'),
            $container->get('paymentMethodRepository')
        );
    });
    $container->set('router', function (): App\Helpers\Router {
        return require BASE_PATH . '/routes/web.php';
    });
    $container->set('apiRouter', function (): App\Helpers\Router {
        return require BASE_PATH . '/routes/api.php';
    });

    return new App\Helpers\App($container);
}
