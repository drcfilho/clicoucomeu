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
        private ProductRepository $products
    ) {
    }

    public function loadBySlug(string $slug): ?array
    {
        $tenant = $this->tenantResolver->resolveBySlug($slug);

        if ($tenant === null) {
            return null;
        }

        $settings = $this->configurations->findByTenantId((int) $tenant['id']);
        $neighborhoodRows = $this->neighborhoods->findActiveByTenantId((int) $tenant['id']);
        $paymentMethodRows = $this->paymentMethods->findActiveByTenantId((int) $tenant['id']);
        $categoryRows = $this->categories->findActiveByTenantId((int) $tenant['id']);
        $productRows = $this->products->findActiveByTenantId((int) $tenant['id']);
        $variationRows = $this->products->findVariationsByTenantId((int) $tenant['id']);
        $addonGroupRows = $this->products->findAddonGroupsByTenantId((int) $tenant['id']);

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
        ];
    }
}
