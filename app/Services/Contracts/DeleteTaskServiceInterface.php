<?php

namespace App\Services\Contracts;

use App\Models\Task;

interface DeleteTaskServiceInterface {
    public function validate(int $taskId): Task;
    public function delete(int $taskId): array;
}

