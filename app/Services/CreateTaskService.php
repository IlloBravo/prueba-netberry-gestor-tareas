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
    public function validate(Array $data): void
    {
        $existingTask = Task::where('name', $data['name'])->first();

        if ($existingTask) {
            throw new TaskAlreadyExistsException($data['name']);
        }
    }

    /**
     * @throws TaskAlreadyExistsException
     */
    public function create(Array $data): array
    {
        $this->validate($data);

        $task = Task::create(['name' => $data['name']]);
        $task->categories()->attach($data['categories']);

        return [
            'message' => 'Tarea creada correctamente',
            'task' => $task->load('categories')
        ];
    }
}
