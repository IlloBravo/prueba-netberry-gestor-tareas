<?php

namespace Tests\Unit\Services;

use App\Models\Category;
use App\Services\CreateTaskService;
use App\Services\DeleteTaskService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteTaskServiceTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @throws ValidationException
     */
    #[Test]
    public function it_deletes_a_task_successfully()
    {
        $categories = Category::factory()->count(2)->create();

        $taskService = new CreateTaskService();
        $taskCreated = $taskService->create([
            'name' => 'Nueva Tarea',
            'categories' => $categories->pluck('id')->toArray(),
        ]);

        $service = new DeleteTaskService();
        $response = $service->delete($taskCreated['task']['id']);

        $this->assertEquals('Tarea eliminada correctamente', $response['message']);
    }

    #[Test]
    public function it_throws_an_exception_if_task_does_not_exist()
    {
        $service = new DeleteTaskService();

        $this->expectException(ValidationException::class);
        $service->delete(1);
    }
}
