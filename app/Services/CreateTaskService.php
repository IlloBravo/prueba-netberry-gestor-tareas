<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CreateTaskService
{
    /**
     * @throws ValidationException
     */
    public function validateAndCreateTask(Request $request): array
    {
        $existingTask = Task::where('name', $request->input('name'))->first();

        if ($existingTask) {
            throw ValidationException::withMessages([
                'name' => "Ya existe una tarea con el nombre '{$request->input('name')}'. Por favor, usa un nombre diferente."
            ]);
        }

        $task = Task::create(['name' => $request->input('name')]);
        $task->categories()->attach($request->input('categories'));

        return [
            'message' => 'Tarea creada correctamente',
            'task' => $task->load('categories')
        ];
    }
}
