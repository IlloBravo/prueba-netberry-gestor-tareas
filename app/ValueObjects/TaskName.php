<?php

namespace App\ValueObjects;

use InvalidArgumentException;

final class TaskName
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
            throw new InvalidArgumentException("El nombre de la tarea no puede estar vacío.");
        }

        if (strlen($name) > 255) {
            throw new InvalidArgumentException("El nombre de la tarea no puede superar los 255 caracteres.");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
