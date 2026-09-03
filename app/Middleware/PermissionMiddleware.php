<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Helpers\Container;
use App\Helpers\Request;
use RuntimeException;

class PermissionMiddleware
{
    public function handle(Request $request, Container $container): void
    {
        $session = $container->get('session');

        if (!$session->has('perfil')) {
            throw new RuntimeException('Perfil nao encontrado');
        }
    }
}
