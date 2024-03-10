<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Alimentos veganos']);
        Category::create(['name' => 'Proteína vegetale']);
        Category::create(['name' => 'Proteína animal']);
        Category::create(['name' => 'Granos y cereales']);
        Category::create(['name' => 'Lácteos']);
        Category::create(['name' => 'Snacks saludables']);
        Category::create(['name' => 'Frutas y verduras']);
        Category::create(['name' => 'Aceites y condimentos saludables']);
    }
}
