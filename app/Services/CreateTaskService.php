<?php

namespace App\Services;

use App\Exceptions\TaskAlreadyExistsException;
use App\Models\Task;
use App\Services\Contracts\CreateTaskServiceInterface;

class CreateTaskService implements CreateTaskServiceInterface
{
    /**
     * @throws TaskAlreadyExistsException
     */
    public function create(Array $data): array
    {
        $task = Task::createOrFail($data['name']);
        $task->categories()->attach($data['categories']);

        return [
            'message' => 'Tarea ' . $task->name . ' creada correctamente',
            'task' => $task->load('categories')
        ];
    }
}
