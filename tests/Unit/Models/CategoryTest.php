<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_category_belongs_to_many_tasks()
    {
        $category = Category::factory()->create();

        $task1 = Task::factory()->create();
        $task2 = Task::factory()->create();

        $category->tasks()->attach([$task1->id, $task2->id]);

        $this->assertTrue($category->tasks->contains($task1));
        $this->assertTrue($category->tasks->contains($task2));
    }
}
