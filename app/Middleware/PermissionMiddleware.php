<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Helpers\Container;
use App\Helpers\Request;

class PermissionMiddleware
{
    public function handle(Request $request, Container $container): void
    {
        $session = $container->get('session');
        $response = $container->get('response');

        if (!$session->has('perfil')) {
            $this->deny($request, $response);
        }

        $profile = (string) $session->get('perfil');
        $allowedProfiles = $this->allowedProfilesForPath($request->path());

        if ($allowedProfiles === []) {
            return;
        }

        if (!in_array($profile, $allowedProfiles, true)) {
            $this->deny($request, $response);
        }
    }

    private function allowedProfilesForPath(string $path): array
    {
        if (str_starts_with($path, '/admin')) {
            return ['superadmin'];
        }

        if (str_starts_with($path, '/cozinha')) {
            return ['superadmin', 'admin', 'cozinha'];
        }

        if (str_starts_with($path, '/painel')) {
            return ['superadmin', 'admin', 'operador'];
        }

        return [];
    }

    private function deny(Request $request, mixed $response): never
    {
        if (str_starts_with($request->path(), '/api/')) {
            $response->json([
                'success' => false,
                'error' => [
                    'code' => 'FORBIDDEN',
                    'message' => 'Voce nao tem permissao para acessar este recurso.',
                ],
            ], 403);

            exit;
        }

        $response->view('errors.403', [
            'message' => 'Voce nao tem permissao para acessar esta area.',
        ], 403);

        exit;
    }
}
