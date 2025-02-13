<?php

namespace Tests\Feature\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_shows_index_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertViewIs('tasks.index')
            ->assertViewHas('categories');
    }

    #[Test]
    public function it_returns_all_tasks_in_index_json()
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/get-all-tasks');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    #[Test]
    public function it_creates_a_task_via_api()
    {
        $category = Category::factory()->make();
        $task = Task::factory()->make();

        $response = $this->postJson('/create-tasks', [
            'name' => $task->name,
            'categories' => $category->id
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Tarea creada correctamente']);

        $this->assertDatabaseHas('tasks', ['name' => $task->name]);
    }

    #[Test]
    public function it_returns_error_when_create_non_correct_task()
    {
        Task::factory()->create([
            'name' => 'Tarea Duplicada'
        ]);

        $response = $this->postJson('/create-tasks', [
            'name' => 'Tarea Duplicada',
            'categories' => [1]
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure(['errors']);
    }

    #[Test]
    public function it_deletes_a_task_via_api()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/tasks/{$task->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Tarea eliminada correctamente']);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    #[Test]
    public function it_returns_error_when_deleting_non_existent_task()
    {
        $response = $this->deleteJson("/tasks/9999");

        $response->assertStatus(422)
            ->assertJsonStructure(['errors']);
    }
}
