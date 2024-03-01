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
        Category::create(['name' => 'Alimentos veganos y saludables']);
        Category::create(['name' => 'Proteínas vegetales']);
        Category::create(['name' => 'Granos y cereales']);
        Category::create(['name' => 'Snacks saludables']);
        Category::create(['name' => 'Frutas y verduras']);
        Category::create(['name' => 'Proteína animal']);
        Category::create(['name' => 'Aceites y condimentos saludables']);
    }
}
