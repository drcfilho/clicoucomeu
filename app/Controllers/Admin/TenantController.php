<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;

class TenantController
{
    public function __construct(private Container $container)
    {
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $response->json([
            'success' => true,
            'data' => [
                'tenants' => [],
            ],
        ]);
    }
}
