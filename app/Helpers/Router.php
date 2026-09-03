<?php

declare(strict_types=1);

namespace App\Helpers;

class Router
{
    private array $routes = [];

    public function get(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->addRoute('GET', $path, $handler, $middleware);
    }

    public function post(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->addRoute('POST', $path, $handler, $middleware);
    }

    public function patch(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->addRoute('PATCH', $path, $handler, $middleware);
    }

    public function put(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->addRoute('PUT', $path, $handler, $middleware);
    }

    public function delete(string $path, callable|array $handler, array $middleware = []): void
    {
        $this->addRoute('DELETE', $path, $handler, $middleware);
    }

    public function dispatch(Request $request, Response $response, Container $container): void
    {
        $method = $request->method();
        $path = rtrim($request->path(), '/') ?: '/';

        foreach ($this->routes[$method] ?? [] as $route) {
            $params = $this->match($route['path'], $path);

            if ($params === null) {
                continue;
            }

            foreach ($route['middleware'] as $middleware) {
                (new $middleware())->handle($request, $container);
            }

            $handler = $route['handler'];

            if (is_array($handler)) {
                [$class, $action] = $handler;
                $controller = $container->has($class) ? $container->get($class) : new $class($container);
                $controller->{$action}($request, $response, $params);
                return;
            }

            $handler($request, $response, $params);
            return;
        }

        if (str_starts_with($path, '/api/')) {
            $response->json([
                'success' => false,
                'error' => [
                    'code' => 'NOT_FOUND',
                    'message' => 'Recurso nao encontrado',
                ],
            ], 404);
            return;
        }

        $response->view('errors.404', [
            'message' => 'Pagina nao encontrada.',
        ], 404);
    }

    private function addRoute(string $method, string $path, callable|array $handler, array $middleware): void
    {
        $this->routes[$method][] = [
            'path' => rtrim($path, '/') ?: '/',
            'handler' => $handler,
            'middleware' => $middleware,
        ];
    }

    private function match(string $routePath, string $path): ?array
    {
        $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $routePath);
        $pattern = '#^' . $pattern . '$#';

        if (!preg_match($pattern, $path, $matches)) {
            return null;
        }

        return array_filter($matches, static fn ($key): bool => !is_int($key), ARRAY_FILTER_USE_KEY);
    }
}
