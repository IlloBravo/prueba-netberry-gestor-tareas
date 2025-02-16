<?php

namespace Database\Factories;

use App\Models\Category;
use App\ValueObjects\CategoryName;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => (new CategoryName($this->faker->unique()->word))->value(),
        ];
    }
}
