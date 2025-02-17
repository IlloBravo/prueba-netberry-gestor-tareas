<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Services\Contracts\CreateTaskServiceInterface;
use App\Services\Contracts\DeleteTaskServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected CreateTaskServiceInterface $createTaskService;
    protected DeleteTaskServiceInterface $deleteTaskService;

    public function __construct
    (
        CreateTaskServiceInterface $createTaskService,
        DeleteTaskServiceInterface $deleteTaskService
    )
    {
        $this->createTaskService = $createTaskService;
        $this->deleteTaskService = $deleteTaskService;
    }

    public function index(): View
    {
        return view('tasks.index', ['categories' => Category::all()]);
    }

    public function getTasks(): JsonResponse
    {
        return response()->json(Task::with('categories')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->only(['name', 'categories']);
        $response = $this->createTaskService->create($data);
        return response()->json($response);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->deleteTaskService->delete($id);
        return response()->json($response);
    }
}
