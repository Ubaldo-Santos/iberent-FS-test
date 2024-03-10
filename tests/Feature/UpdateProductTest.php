<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{

    use RefreshDatabase;
    public function test_update_product()
    {
        $product = Product::factory()->count(1)->create();
        $response = $this->putJson('/api/v1/products/' . $product[0]->id, [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('products', [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);
    }

    public function test_update_product_validation_name()
    {
        $test = Product::factory()->count(1)->create();

        $response = $this->putJson('/api/v1/products/' . $test[0]->id, [
            'name' => '',
            'price' => 100,
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);
        $response->assertStatus(422);
    }


    public function test_update_product_validation_price()
    {
        $product = Product::factory()->count(1)->create();
        $response = $this->putJson('/api/v1/products/' . $product[0]->id, [
            'name' => 'Product 1',
            'price' => 'abc',
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);

        $response->assertStatus(422);
    }

    public function test_update_product_validation_stock()
    {
        $product = Product::factory()->count(1)->create();

        $response = $this->putJson('/api/v1/products/' . $product[0]->id, [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 'abc',
            'description' => 'Description of product 1'
        ]);
        $response->assertStatus(422);
    }

    public function test_update_product_validation_description()
    {
        $product = Product::factory()->count(1)->create();
        $response = $this->putJson('/api/v1/products/' . $product[0]->id, [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
            'description' => null,
        ]);
        $response->assertStatus(422);
    }

    public function test_update_product_without_index()
    {
        $response = $this->putJson('/api/v1/products/', [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);
        $response->assertStatus(405);
    }
    public function test_update_product_not_found()
    {
        $response = $this->putJson('/api/v1/products/654', [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);
        $response->assertStatus(404);
    }

    public function test_update_product_invalid_id()
    {
        $product = Product::factory()->count(1)->create();
        $response = $this->putJson('/api/v1/products/abc', [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);
        $response->assertStatus(404);
    }
}
