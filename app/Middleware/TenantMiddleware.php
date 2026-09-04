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
        /** @var \App\Helpers\Session $session */
        $session = $container->get('session');
        /** @var \App\Helpers\Response $response */
        $response = $container->get('response');

        if (!$session->has('tenant_id')) {
            $response->redirect('/login');
            exit;
        }

        $sessionSlug = (string) $session->get('tenant_slug', '');
        $sessionPerfil = (string) $session->get('perfil', '');

        // Validação de rota tenant
        $routeTenant = (string) $request->getAttribute('route_tenant', '');
        if ($routeTenant !== '' && $sessionPerfil !== 'superadmin' && mb_strtolower($routeTenant) !== mb_strtolower($sessionSlug)) {
            // Se tentar acessar o painel de outro tenant sem ser superadmin
            if ($sessionSlug !== '') {
                $response->redirect("/{$sessionSlug}/painel");
            } else {
                $response->redirect('/login');
            }
            exit;
        }
    }
}
