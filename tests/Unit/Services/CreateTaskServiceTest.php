<?php

namespace Tests\Unit\Services;

use App\Exceptions\TaskAlreadyExistsException;
use App\Models\Category;
use App\Models\Task;
use App\Services\CreateTaskService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateTaskServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @throws TaskAlreadyExistsException
     */
    #[Test]
    public function test_it_creates_a_task_successfully()
    {
        $categories = Category::factory()->count(2)->create();

        $taskService = new CreateTaskService();
        $taskToCreate = $taskService->create([
            'name' => 'Nueva Tarea',
            'categories' => $categories->pluck('id')->toArray(),
        ]);

        $task = Task::find($taskToCreate['task']['id']);

        $this->assertDatabaseHas('tasks', ['name' => 'Nueva Tarea']);
        $this->assertDatabaseHas('task_category', [
            'task_id' => $task->id,
            'category_id' => $categories->first()->id,
        ]);
    }

    /**
     * @throws ValidationException
     */
    #[Test]
    public function it_throws_an_exception_if_task_already_exists()
    {
        Task::factory()->create(['name' => 'Tarea duplicada']);

        $this->expectException(ValidationException::class);

        $service = new CreateTaskService();
        $service->create([
            'name' => 'Tarea duplicada',
            'categories' => [1, 2]
        ]);
    }
}
