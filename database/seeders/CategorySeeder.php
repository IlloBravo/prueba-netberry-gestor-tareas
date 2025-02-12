<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['PHP', 'Javascript', 'CSS'] as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}
