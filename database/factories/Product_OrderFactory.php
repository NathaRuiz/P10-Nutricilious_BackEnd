<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Product_OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->numberBetween(1, 6),
            'id_product' => $this->faker->numberBetween(1, 6),
            'product_quantity' => $this->faker->randomNumber(1, 50),
            'total_price' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
