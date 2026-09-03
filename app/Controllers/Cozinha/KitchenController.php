<?php

declare(strict_types=1);

namespace App\Controllers\Cozinha;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;

class KitchenController
{
    public function __construct(private Container $container)
    {
    }

    public function index(Request $request, Response $response, array $params = []): void
    {
        $response->view('cozinha.index');
    }
}
