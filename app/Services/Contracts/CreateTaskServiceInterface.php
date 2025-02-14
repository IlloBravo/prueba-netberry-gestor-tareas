<?php

namespace App\Services\Contracts;

use App\Models\Task;

/**
 * Interfaz para la creación de tareas.
 *
 * En una aplicación más compleja, se podría utilizar un servicio de validación independiente
 * para evitar duplicación de lógica (por ejemplo, ValidateTaskServiceInterface).
 * Sin embargo, en el contexto de esta prueba, se ha optado por un método `validate()`
 * dentro de cada servicio para mantener el código simple y directo.
 */
interface CreateTaskServiceInterface {
    public function validate(array $data): void;
    public function create(array $data): array;
}
