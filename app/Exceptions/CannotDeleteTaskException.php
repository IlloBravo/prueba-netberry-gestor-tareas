<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CannotDeleteTaskException extends Exception
{
    public function __construct(int $taskId)
    {
        parent::__construct("No se pudo eliminar la tarea con ID $taskId.");
    }

    public function render(): JsonResponse
    {
        return response()->json(['errors' => $this->getMessage()], 422);
    }
}