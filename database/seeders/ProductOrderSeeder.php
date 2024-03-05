<?php

namespace Database\Seeders;
use App\Models\Product_Order;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product_Order::factory()->count(3)->create();
    }
}
