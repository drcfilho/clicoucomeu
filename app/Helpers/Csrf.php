<?php

declare(strict_types=1);

namespace App\Helpers;

class Csrf
{
    public function __construct(private Session $session)
    {
    }

    public function token(): string
    {
        $token = $this->session->get('_csrf_token');

        if (is_string($token) && $token !== '') {
            return $token;
        }

        $token = bin2hex(random_bytes(32));
        $this->session->set('_csrf_token', $token);

        return $token;
    }

    public function validate(?string $token): bool
    {
        $stored = $this->session->get('_csrf_token');
        return is_string($stored) && is_string($token) && hash_equals($stored, $token);
    }
}
