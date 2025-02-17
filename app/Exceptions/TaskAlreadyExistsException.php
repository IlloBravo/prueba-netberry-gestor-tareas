<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class TaskAlreadyExistsException extends Exception
{
    public function __construct(string $name)
    {
        parent::__construct("La tarea $name ya existe.");
    }

    public function render(): JsonResponse
    {
        return response()->json(['errors' => $this->getMessage()], 422);
    }
}
