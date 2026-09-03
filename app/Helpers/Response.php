<?php

declare(strict_types=1);

namespace App\Helpers;

class Response
{
    public function __construct(private ?View $view = null)
    {
    }

    public function json(array $payload, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function view(string $view, array $data = [], int $status = 200): void
    {
        http_response_code($status);

        if ($this->view === null) {
            throw new \RuntimeException('View renderer not configured');
        }

        echo $this->view->render($view, $data);
    }

    public function redirect(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}
