<?php

declare(strict_types=1);

namespace App\Controllers\Painel;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;

class DashboardController
{
    public function __construct(private Container $container)
    {
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $tenantId = (int) ($_SESSION['tenant_id'] ?? 0);
        $period = (string) $request->get('period', 'hoje');

        $startDate = null;
        $endDate = null;
        $today = date('Y-m-d');

        if ($period === 'hoje') {
            $startDate = $today;
            $endDate = $today;
        } elseif ($period === '7dias') {
            $startDate = date('Y-m-d', strtotime('-6 days'));
            $endDate = $today;
        } elseif ($period === '30dias') {
            $startDate = date('Y-m-d', strtotime('-29 days'));
            $endDate = $today;
        } elseif ($period === 'personalizado') {
            $startDate = (string) $request->get('start_date', '');
            $endDate = (string) $request->get('end_date', '');
            if (!$startDate) $startDate = null;
            if (!$endDate) $endDate = null;
        }

        /** @var \App\Repositories\OrderRepository $orderRepo */
        $orderRepo = $this->container->get(\App\Repositories\OrderRepository::class);

        $metrics = $orderRepo->getDashboardMetrics($tenantId, $startDate, $endDate);
        $topProducts = $orderRepo->getTopProducts($tenantId, $startDate, $endDate, 5);
        $paymentMethods = $orderRepo->getTopPaymentMethods($tenantId, $startDate, $endDate);
        $topNeighborhoods = $orderRepo->getTopNeighborhoods($tenantId, $startDate, $endDate, 5);

        /** @var \App\Repositories\CategoryRepository $categoryRepo */
        $categoryRepo = $this->container->get(\App\Repositories\CategoryRepository::class);
        /** @var \App\Repositories\ProductRepository $productRepo */
        $productRepo = $this->container->get(\App\Repositories\ProductRepository::class);
        /** @var \App\Repositories\NeighborhoodRepository $neighborhoodRepo */
        $neighborhoodRepo = $this->container->get(\App\Repositories\NeighborhoodRepository::class);
        /** @var \App\Repositories\StoreHoursRepository $hoursRepo */
        $hoursRepo = $this->container->get(\App\Repositories\StoreHoursRepository::class);

        $categoriesCount = count($categoryRepo->findAllByTenantId($tenantId));
        $productsCount = count($productRepo->findAllByTenantId($tenantId));
        $neighborhoodsCount = count($neighborhoodRepo->findAllByTenantId($tenantId));
        $hoursCount = count($hoursRepo->findAllByTenantId($tenantId));

        $onboardingSteps = [
            'categorias' => $categoriesCount > 0,
            'produtos' => $productsCount > 0,
            'bairros' => $neighborhoodsCount > 0,
            'horarios' => $hoursCount > 0,
        ];
        $completedOnboardingCount = count(array_filter($onboardingSteps));
        $showOnboarding = $completedOnboardingCount < 4;

        $response->view('painel.dashboard', [
            'period' => $period,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'metrics' => $metrics,
            'topProducts' => $topProducts,
            'paymentMethods' => $paymentMethods,
            'topNeighborhoods' => $topNeighborhoods,
            'onboardingSteps' => $onboardingSteps,
            'completedOnboardingCount' => $completedOnboardingCount,
            'showOnboarding' => $showOnboarding,
        ]);
    }
}
