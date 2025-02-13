<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Validation\ValidationException;

class DeleteTaskService
{
    /**
     * @throws ValidationException
     */
    public function deleteTask(int $taskId): array
    {
        $task = Task::find($taskId);

        if (!$task) {
            throw ValidationException::withMessages([
                'task' => "La tarea que quieres eliminar no existe."
            ]);
        }

        $task->delete();

        return ['message' => 'Tarea eliminada correctamente'];
    }
}
