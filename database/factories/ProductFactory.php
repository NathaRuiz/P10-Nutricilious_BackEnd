<?php

namespace Database\Factories;

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
            'name' => $this->faker->name,
            'description' => $this->faker->name,
            'stock' => $this->faker->randomNumber(1, 50),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'id_category' => $this->faker->randomNumber(1, 5),
        ];
    }
}
