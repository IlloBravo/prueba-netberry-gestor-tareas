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
    public function validate(int $taskId): Task
    {
        $task = Task::find($taskId);

        if (!$task) {
            throw new CannotDeleteTaskException($taskId);
        }

        return $task;
    }

    /**
     * @throws CannotDeleteTaskException
     */
    public function delete(int $taskId): array
    {
        $task = $this->validate($taskId);

        $task->delete();

        return ['message' => 'Tarea eliminada correctamente'];
    }
}
