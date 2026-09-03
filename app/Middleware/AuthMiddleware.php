<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Helpers\Container;
use App\Helpers\Request;

class AuthMiddleware
{
    public function handle(Request $request, Container $container): void
    {
        $session = $container->get('session');
        $response = $container->get('response');

        if (!$session->has('usuario_id')) {
            $response->redirect('/login');
        }
    }
}
