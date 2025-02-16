<?php

namespace App\Exceptions;

use Exception;

class CategoryAlreadyExistsException extends Exception
{
    public function __construct(string $name)
    {
        parent::__construct("La categoría $name ya existe.");
    }
}
