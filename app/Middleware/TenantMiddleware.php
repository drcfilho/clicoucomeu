<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Helpers\Container;
use App\Helpers\Request;
use RuntimeException;

class TenantMiddleware
{
    public function handle(Request $request, Container $container): void
    {
        $session = $container->get('session');

        if (!$session->has('tenant_id')) {
            throw new RuntimeException('Tenant nao resolvido na sessao');
        }
    }
}
