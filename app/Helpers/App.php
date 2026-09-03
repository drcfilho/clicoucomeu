<?php

declare(strict_types=1);

namespace App\Helpers;

class App
{
    public function __construct(private Container $container)
    {
    }

    public function run(): void
    {
        $session = $this->container->get('session');
        $request = $this->container->get('request');
        $response = $this->container->get('response');
        $errorHandler = $this->container->get('errorHandler');

        $session->start();
        $errorHandler->register();

        if ($session->isExpired()) {
            $session->destroy();
            $session->start();
        }

        $session->touch();

        try {
            $path = $request->path();
            $router = str_starts_with($path, '/api/')
                ? $this->container->get('apiRouter')
                : $this->container->get('router');

            $router->dispatch($request, $response, $this->container);
        } catch (\Throwable $exception) {
            $errorHandler->render($exception, $request, $response);
        }
    }
}
