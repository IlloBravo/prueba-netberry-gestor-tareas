<?php

namespace App\Services;

use App\Exceptions\TaskAlreadyExistsException;
use App\Models\Task;
use App\Services\Contracts\CreateTaskServiceInterface;
use App\ValueObjects\TaskName;

class CreateTaskService implements CreateTaskServiceInterface
{
    /**
     * @throws TaskAlreadyExistsException
     */
    public function create(Array $data): array
    {
        $taskName = new TaskName($data['name']);
        $task = Task::createOrFail($taskName);
        $task->categories()->attach($data['categories']);

        return [
            'message' => 'Tarea ' . $task->name()->value() . ' creada correctamente',
            'task' => $task->load('categories')
        ];
    }
}
