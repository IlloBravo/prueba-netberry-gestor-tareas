<?php

namespace App\Services\Contracts;

interface CreateTaskServiceInterface
{
    public function create(array $data): array;
}
