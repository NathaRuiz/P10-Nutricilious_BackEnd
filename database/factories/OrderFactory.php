<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['Processing', 'Cancelled', 'Confirmed', 'Shipping', 'Delivered']),
            'user_id' => $this->faker->numberBetween(1, 6), 
            'unit_quantity' => $this->faker->randomNumber(1, 50),
            'total_price' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
