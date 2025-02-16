<?php

namespace Database\Factories;

use App\Models\Task;
use App\ValueObjects\TaskName;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'name' => (new TaskName($this->faker->text(50)))->value(),
        ];
    }
}
