<?php

namespace Tests\Feature\Auth;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class ProductControllerTest extends TestCase
{
    public function test_products_table_is_created()
    {
        $this->artisan('migrate');

        $this->assertTrue(Schema::hasTable('products'));
    }

    // use RefreshDatabase;

    public function test_new_product_register(): void
    {
        $user = User::firstOrCreate(['rol_id' => 1]);
        $this->actingAs($user);

        $faker = Faker::create();
        $response = $this->post('api/admin/products/create', [
            'name' => $faker->name,
            'description' => 'This is a test product.',
            'stock' => 10,
            'price' => 19.99,
            'status' => 'Active',
            'id_category' => 2,
            'id_userCompany' => $user->id,
        ]);

        $response->assertStatus(201);
    }

    public function test_show_products(): void
    {
        $companyUser = User::factory()->create(['rol_id' => 3]);

        $this->actingAs($companyUser);

        $response = $this->get('api/company/products');
        
        $response->assertStatus(200);
    }


    public function test_show_one_product(): void
    {
        $faker = \Faker\Factory::create();

        $product = Product::create([
            'name' => $faker->name,
            'description' => 'This is a test product.',
            'stock' => 10,
            'price' => 19.99,
            'status' => 'Active',
            'id_category' => 2,
            'id_userCompany' => 2,
        ]);

        $response = $this->get("api/products/{$product->id}");

        $response->assertStatus(200);
    }

    public function test_update_product(): void
    {
        $user = User::firstOrCreate(['rol_id' => 1]);
        $this->actingAs($user);

        $faker = Faker::create();
        $product = Product::create([
            'name' => $faker->name,
            'description' => 'This is a test product.',
            'stock' => 10,
            'price' => 19.99,
            'status' => 'Active',
            'id_category' => 2,
            'id_userCompany' => $user->id,
        ]);
        $updateproduct = [
            'name' => $faker->name,
            'description' => 'Este es un producto de prueba',
            'stock' => 8,
            'price' => 15.50,
            'status' => 'Inactive',
            'id_category' => 3,
        ];

        $response = $this->put("/api/admin/products/update/{$product->id}", $updateproduct);
        $response->assertStatus(200);
    }

    public function test_destroy_an_existing_product(): void
    {
        $user = User::firstOrCreate(['rol_id' => 1]);
        $this->actingAs($user);

        $faker = Faker::create();
        $response = Product::create([
            'name' => $faker->name,
            'description' => 'This is a test product.',
            'stock' => 10,
            'price' => 19.99,
            'status' => 'Active',
            'id_category' => 2,
            'id_userCompany' => $user->id,
        ]);

        $response = $this->delete("/api/admin/products/delete/{$response->id}");
        $response->assertStatus(200);
    }
}
