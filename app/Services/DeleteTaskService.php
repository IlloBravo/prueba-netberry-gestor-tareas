<?php

namespace App\Services;

use App\Exceptions\CannotDeleteTaskException;
use App\Models\Task;
use App\Services\Contracts\DeleteTaskServiceInterface;

class DeleteTaskService implements DeleteTaskServiceInterface
{
    /**
     * @throws CannotDeleteTaskException
     */
    public function delete(int $taskId): array
    {
        $task = Task::findOrFail($taskId);
        $task->deleteOrFail();

        return ['message' => 'Tarea eliminada correctamente'];
    }
}
