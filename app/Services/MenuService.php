<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\TenantResolver;
use App\Repositories\CategoryRepository;
use App\Repositories\ConfigurationRepository;
use App\Repositories\NeighborhoodRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\ProductRepository;

class MenuService
{
    public function __construct(
        private TenantResolver $tenantResolver,
        private ConfigurationRepository $configurations,
        private NeighborhoodRepository $neighborhoods,
        private PaymentMethodRepository $paymentMethods,
        private CategoryRepository $categories,
        private ProductRepository $products,
        private ?StoreHoursService $storeHoursService = null
    ) {
    }

    public function loadBySlug(string $slug): ?array
    {
        $tenant = $this->tenantResolver->resolveBySlug($slug);

        if ($tenant === null) {
            return null;
        }

        $tenantId = (int) $tenant['id'];
        $settings = $this->configurations->findByTenantId($tenantId);
        $neighborhoodRows = $this->neighborhoods->findActiveByTenantId($tenantId);
        $paymentMethodRows = $this->paymentMethods->findActiveByTenantId($tenantId);
        $categoryRows = $this->categories->findActiveByTenantId($tenantId);
        $productRows = $this->products->findActiveByTenantId($tenantId);
        $variationRows = $this->products->findVariationsByTenantId($tenantId);
        $addonGroupRows = $this->products->findAddonGroupsByTenantId($tenantId);
        $storeStatus = $this->storeHoursService ? $this->storeHoursService->isOpen($tenantId) : ['is_open' => true, 'message' => 'Aberto'];

        $productsByCategory = [];
        foreach ($productRows as $product) {
            $productId = (int) $product['id'];
            $product['preco'] = $product['preco'] !== null ? (float) $product['preco'] : null;
            $product['variacoes'] = $variationRows[$productId] ?? [];
            $product['grupos_adicionais'] = $addonGroupRows[$productId] ?? [];
            $productsByCategory[(int) $product['categoria_id']][] = $product;
        }

        $categories = [];
        foreach ($categoryRows as $category) {
            $categoryId = (int) $category['id'];
            $categories[] = [
                'id' => $categoryId,
                'nome' => $category['nome'],
                'descricao' => $category['descricao'],
                'produtos' => $productsByCategory[$categoryId] ?? [],
            ];
        }

        return [
            'tenant' => $tenant,
            'settings' => $settings,
            'neighborhoods' => $neighborhoodRows,
            'payment_methods' => $paymentMethodRows,
            'categories' => $categories,
            'status_loja' => $storeStatus,
        ];
    }
}
