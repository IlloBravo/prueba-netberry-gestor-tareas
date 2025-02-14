<?php

namespace App\Services;

use App\Models\Task;
use App\Services\Contracts\DeleteTaskServiceInterface;
use Illuminate\Validation\ValidationException;

class DeleteTaskService implements DeleteTaskServiceInterface
{
    /**
     * @throws ValidationException
     */
    public function validate(int $taskId): void
    {
        $task = Task::find($taskId);

        if (!$task) {
            throw ValidationException::withMessages([
                'task' => "La tarea que quieres eliminar no existe."
            ]);
        }
    }

    /**
     * @throws ValidationException
     */
    public function delete(int $taskId): array
    {
        $this->validate($taskId);

        $task = Task::find($taskId);
        $task->delete();

        return ['message' => 'Tarea eliminada correctamente'];
    }
}
