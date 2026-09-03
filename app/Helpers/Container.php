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

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->resolved) || array_key_exists($id, $this->entries) || class_exists($id);
    }

    public function get(string $id): mixed
    {
        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        // Tenta resolver por alias registrado (ex: 'categoryRepository')
        if (array_key_exists($id, $this->entries)) {
            $entry = $this->entries[$id];
            $value = is_callable($entry) ? $entry($this) : $entry;
            $this->resolved[$id] = $value;
            return $value;
        }

        // Fallback 1: Tenta resolver convertendo FQCN para alias (ex: App\Repositories\CategoryRepository => categoryRepository)
        $shortName = lcfirst(basename(str_replace('\\', '/', $id)));
        if (array_key_exists($shortName, $this->entries)) {
            return $this->get($shortName);
        }

        // Fallback 2: Auto-instanciação de classe válida
        if (class_exists($id)) {
            $reflector = new \ReflectionClass($id);
            $constructor = $reflector->getConstructor();

            if ($constructor === null) {
                $instance = new $id();
            } else {
                $parameters = $constructor->getParameters();
                $dependencies = [];

                foreach ($parameters as $parameter) {
                    $type = $parameter->getType();
                    if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                        $dependencyClass = $type->getName();
                        if ($dependencyClass === self::class) {
                            $dependencies[] = $this;
                        } else {
                            $dependencies[] = $this->get($dependencyClass);
                        }
                    } elseif ($parameter->isDefaultValueAvailable()) {
                        $dependencies[] = $parameter->getDefaultValue();
                    } else {
                        $dependencies[] = null;
                    }
                }

                $instance = $reflector->newInstanceArgs($dependencies);
            }

            $this->resolved[$id] = $instance;
            return $instance;
        }

        throw new InvalidArgumentException("Container entry not found: {$id}");
    }
}
