<?php

declare(strict_types=1);

namespace App\Validation;

class Validator
{
    public function required(array $data, array $fields): array
    {
        $errors = [];

        foreach ($fields as $field) {
            $value = $data[$field] ?? null;

            if ($value === null || $value === '') {
                $errors[$field] = 'Campo obrigatorio';
            }
        }

        return $errors;
    }
}
