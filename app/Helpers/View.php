<?php

declare(strict_types=1);

namespace App\Helpers;

use RuntimeException;

class View
{
    public function __construct(private string $basePath)
    {
    }

    public function render(string $view, array $data = []): string
    {
        $file = rtrim($this->basePath, '/') . '/' . str_replace('.', '/', $view) . '.php';

        if (!is_file($file)) {
            throw new RuntimeException("View not found: {$view}");
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $file;
        return (string) ob_get_clean();
    }
}
