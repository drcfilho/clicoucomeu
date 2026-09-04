<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Helpers\Container;
use App\Helpers\Request;
use App\Helpers\Response;
use App\Helpers\Session;
use RuntimeException;

class CsrfMiddleware
{
    public function handle(Request $request, Container $container): void
    {
        // Valida CSRF token apenas em métodos de mutação de estado (POST, PUT, PATCH, DELETE)
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            $path = $request->path();
            
            // Isenta endpoints públicos de API e webhooks da validação CSRF (possuem validação por token/payload próprio)
            if (str_starts_with($path, '/api/')) {
                return;
            }

            /** @var \App\Helpers\Csrf $csrf */
            $csrf = $container->get('csrf');
            $postToken = (string) ($request->input('_csrf') ?? $request->getParsedBody()['_csrf'] ?? '');

            if (!$csrf->validate($postToken)) {
                /** @var Session $session */
                $session = $container->get('session');
                /** @var Response $response */
                $response = $container->get('response');

                $session->setFlash('error', 'Sessão expirada ou token de segurança inválido. Tente novamente.');
                $response->redirect($request->uri());
                exit;
            }
        }
    }
}
