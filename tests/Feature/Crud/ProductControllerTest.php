<?php

namespace Tests\Feature\Auth;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;
use App\Models\Product;
use Illuminate\Support\Facades\Schema; 

class ProductControllerTest extends TestCase
{
    public function test_products_table_is_created()
    {
        // Ejecuta la migración
        $this->artisan('migrate');

        // Asegura que la tabla 'resources' exista en la base de datos
        $this->assertTrue(Schema::hasTable('products'));
    }

    // use RefreshDatabase;

    public function test_new_product_register(): void
    {
        $faker = Faker::create();
        $response = $this->post('api/products', [
            'name' => $faker->name,
            'description' => 'This is a test product.',
            'stock' => 10,
            'price' => 19.99,
            'status' => 'Active',
            'id_category' => 2,
        ]);
        
        $response->assertStatus(201);
    }

    public function test_show_products(): void
    {
        $faker = Faker::create();
        $response = $this->get('api/products', [

        ]);
        
        $response->assertStatus(200);
    }

    
    public function test_show_one_product(): void
    {
        $faker = Faker::create();
        $response = Product::create([
                'name' => $faker->name,
                'description' => 'This is a test product.',
                'stock' => 10,
                'price' => 19.99,
                'status' => 'Active',
                'id_category' => 2,
        ]);

        $response = $this->get("/api/products/{$response->id}");
        $response->assertStatus(200);
    }

    public function test_update_product(): void
    {
        $faker = Faker::create();
        $product = Product::create([
                'name' => $faker->name,
                'description' => 'This is a test product.',
                'stock' => 10,
                'price' => 19.99,
                'status' => 'Active',
                'id_category' => 2,
        ]);
        $updateproduct =[
            'name' => $faker->name,
            'description' => 'Este es un producto de prueba',
            'stock' => 8,
            'price' => 15.50,
            'status' => 'Inactive',
            'id_category' => 3,
    ];

        $response = $this->put("/api/products/{$product->id}",$updateproduct);
        $response->assertStatus(200);
    }

    public function test_destroy_an_existing_product(): void
    {
        $faker = Faker::create();
        $response = Product::create([
                'name' => $faker->name,
                'description' => 'This is a test product.',
                'stock' => 10,
                'price' => 19.99,
                'status' => 'Active',
                'id_category' => 2,
        ]);

        $response = $this->delete("/api/products/{$response->id}");
        $response->assertStatus(200);
    }

}
