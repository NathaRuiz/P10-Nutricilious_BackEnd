<?php

namespace Database\Factories;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_userCompany' => User::where('rol_id', 3)->get()->random()->id,
            'name' => $this->faker->name,
            'description' => $this->faker->name,
            'stock' => $this->faker->randomNumber(1, 50),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'id_category' => Category::all()->random()->id,
        ];
    }
}
