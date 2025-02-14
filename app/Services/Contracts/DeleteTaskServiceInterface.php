<?php

namespace App\Services\Contracts;

use App\Models\Task;

/**
 * Interfaz para la eliminación de tareas.
 *
 * En una aplicación más grande, podríamos extraer la validación a un servicio separado
 * (ValidateTaskServiceInterface), pero en este caso, mantener `validate()` dentro del
 * servicio nos da un código más simple y fácil de leer.
 */
interface DeleteTaskServiceInterface {
    public function validate(int $taskId): void;
    public function delete(int $taskId): array;
}

