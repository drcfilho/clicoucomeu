<?php

declare(strict_types=1);

namespace App\Helpers;

use InvalidArgumentException;

class Container
{
    private array $entries = [];
    private array $resolved = [];

    public function set(string $id, mixed $value): void
    {
        $this->entries[$id] = $value;
    }

    public function get(string $id): mixed
    {
        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        if (!array_key_exists($id, $this->entries)) {
            throw new InvalidArgumentException("Container entry not found: {$id}");
        }

        $entry = $this->entries[$id];
        $value = is_callable($entry) ? $entry() : $entry;

        $this->resolved[$id] = $value;

        return $value;
    }
}
