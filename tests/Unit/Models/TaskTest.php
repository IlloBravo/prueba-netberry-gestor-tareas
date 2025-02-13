<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_task_belongs_to_many_categories()
    {
        $task = Task::factory()->create();

        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $task->categories()->attach([$category1->id, $category2->id]);

        $this->assertTrue($task->categories->contains($category1));
        $this->assertTrue($task->categories->contains($category2));
    }
}
