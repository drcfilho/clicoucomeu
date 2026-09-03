<?php

declare(strict_types=1);

namespace App\Controllers\Public;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;

class HomeController
{
    public function __construct(private Container $container)
    {
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $slug = $params['tenant'] ?? null;
        $appName = $this->container->get('config')['app']['name'];

        if ($slug === null) {
            $response->view('public.landing', [
                'appName' => $appName,
                'featuredTenant' => [
                    'name' => 'Piemonte Pizzaria',
                    'slug' => 'piemonte',
                ],
            ]);
            return;
        }

        $menu = $this->container->get('menuService')->loadBySlug((string) $slug);

        if ($menu === null) {
            $response->view('errors.404', [
                'message' => 'Cardapio nao encontrado para este tenant.',
            ], 404);
            return;
        }

        $response->view('public.home', [
            'appName' => $appName,
            'slug' => $slug,
            'tenant' => $menu['tenant'],
            'settings' => $menu['settings'],
            'neighborhoods' => $menu['neighborhoods'],
            'paymentMethods' => $menu['payment_methods'],
            'categories' => $menu['categories'],
        ]);
    }
}
