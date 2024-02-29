<?php

namespace Database\Seeders;
use App\Models\Order;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create(["status" => "Processing"]);
        Order::create(["status" => "Cancelled"]);
        Order::create(["status" => "Confirmed"]);
        Order::create(["status" => "Shipping"]);
        Order::create(["status" => "Delivered"]);
    }
}
