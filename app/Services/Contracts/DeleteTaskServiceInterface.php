<?php

namespace App\Services\Contracts;

interface DeleteTaskServiceInterface
{
    public function delete(int $taskId): array;
}

