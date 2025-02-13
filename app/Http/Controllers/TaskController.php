<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Services\CreateTaskService;
use App\Services\DeleteTaskService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    protected CreateTaskService $taskService;
    protected DeleteTaskService $deleteTaskService;

    public function __construct(CreateTaskService $taskService, DeleteTaskService $deleteTaskService)
    {
        $this->taskService = $taskService;
        $this->deleteTaskService = $deleteTaskService;
    }

    public function indexJson(): JsonResponse
    {
        return response()->json(Task::with('categories')->get());
    }

    public function index(): View
    {
        return view('tasks.index', ['categories' => Category::all()]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $response = $this->taskService->validateAndCreateTask($request);
            return response()->json($response);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $response = $this->deleteTaskService->deleteTask($id);
            return response()->json($response);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
