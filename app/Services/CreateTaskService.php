<?php

namespace App\Services;

use App\Models\Task;
use App\Services\Contracts\CreateTaskServiceInterface;
use Illuminate\Validation\ValidationException;

class CreateTaskService implements CreateTaskServiceInterface
{

    /**
     * @throws ValidationException
     */
    public function validate(Array $data): void
    {
        $existingTask = Task::where('name', $data['name'])->first();

        if ($existingTask) {
            throw ValidationException::withMessages([
                'name' => "Ya existe una tarea con el nombre '{$data['name']}'."
            ]);
        }
    }

    /**
     * @throws ValidationException
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
