<?php

declare(strict_types=1);

namespace App\Helpers;

use Throwable;

class ErrorHandler
{
    public function __construct(private Logger $logger, private bool $debug = false)
    {
    }

    public function register(): void
    {
        set_exception_handler(function (Throwable $exception): void {
            $this->log($exception);
        });
    }

    public function render(Throwable $exception, Request $request, Response $response): void
    {
        $this->log($exception);

        $payload = [
            'success' => false,
            'error' => [
                'code' => 'INTERNAL_ERROR',
                'message' => $this->debug ? $exception->getMessage() : 'Erro interno do servidor',
            ],
        ];

        if (str_starts_with($request->path(), '/api/')) {
            $response->json($payload, 500);
            return;
        }

        $message = $payload['error']['message'];
        http_response_code(500);
        echo '<!DOCTYPE html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Erro</title></head><body><main><h1>Erro</h1><p>' .
            htmlspecialchars($message, ENT_QUOTES, 'UTF-8') .
            '</p></main></body></html>';
    }

    private function log(Throwable $exception): void
    {
        $this->logger->error($exception->getMessage(), [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ]);
    }
}
