<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Devuelve todas las tareas con sus categorías (para AJAX).
     */
    public function indexJson(): JsonResponse
    {
        return response()->json(Task::with('categories')->get());
    }

    /**
     * Carga la vista con las categorías desde la BD.
     */
    public function index(): View
    {
        return view('tasks.index', ['categories' => Category::all()]);
    }

    /**
     * Almacena una nueva tarea con las categorías seleccionadas.
     */
    public function store(Request $request): JsonResponse
    {
        $request->merge(['categories' =>
            array_map('intval', $request->input('categories', []))
        ]);

        $request->validate([
            'name' => 'required|min:5|max:25|regex:/^[a-zA-Z0-9\s]+$/',
            'categories' => 'array|required',
            'categories.*' => 'exists:categories,id'
        ]);

        $task = Task::create(['name' => $request->input('name')]);
        $task->categories()->attach($request->input('categories'));

        return response()->json(['message' => 'Tarea creada correctamente', 'task' => $task->load('categories')]);
    }

    /**
     * Elimina una tarea y sus relaciones.
     */
    public function destroy(int $id): JsonResponse
    {
        Task::findOrFail($id)->delete();
        return response()->json(['message' => 'Tarea eliminada correctamente']);
    }
}
