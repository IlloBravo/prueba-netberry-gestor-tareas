<?php

namespace App\ValueObjects;

use InvalidArgumentException;

final class CategoryName
{
    private string $value;

    public function __construct(string $name)
    {
        $this->ensureIsValid($name);
        $this->value = $name;
    }

    private function ensureIsValid(string $name): void
    {
        if (empty($name)) {
            throw new InvalidArgumentException("El nombre de la categoría no puede estar vacío.");
        }

        if (strlen($name) > 100) {
            throw new InvalidArgumentException("El nombre de la categoría no puede superar los 100 caracteres.");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
