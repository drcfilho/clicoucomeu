<?php

declare(strict_types=1);

function env(string $key, mixed $default = null): mixed
{
    return $_ENV[$key] ?? $_SERVER[$key] ?? $default;
}

function base_path(string $path = ''): string
{
    return BASE_PATH . ($path !== '' ? '/' . ltrim($path, '/') : '');
}

function asset(string $path): string
{
    $cleanPath = '/' . ltrim($path, '/');
    $realPath = BASE_PATH . '/public' . $cleanPath;
    if (file_exists($realPath)) {
        $mtime = filemtime($realPath);
        return $cleanPath . '?v=' . $mtime;
    }
    return $cleanPath . '?v=' . time();
}
