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
        $response->view('painel.dashboard', [
            'metrics' => [
                'orders_today' => 0,
                'revenue_today' => 0,
                'average_ticket' => 0,
                'open_orders' => 0,
            ],
        ]);
    }
}
