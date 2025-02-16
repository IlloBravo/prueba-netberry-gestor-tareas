<?php

namespace App\Exceptions;

use Exception;

class CannotDeleteTaskException extends Exception
{
    public function __construct(int $taskId)
    {
        parent::__construct("No se pudo eliminar la tarea con ID $taskId.");
    }
}
