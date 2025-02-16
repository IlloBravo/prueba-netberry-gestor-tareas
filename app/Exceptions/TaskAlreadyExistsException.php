<?php

namespace App\Exceptions;

use Exception;

class TaskAlreadyExistsException extends Exception
{
    public function __construct(string $name)
    {
        parent::__construct("La tarea $name ya existe.");
    }
}
