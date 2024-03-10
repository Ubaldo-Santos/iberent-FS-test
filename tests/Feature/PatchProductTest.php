<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatchProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_patch_product()
    {
        $product = Product::factory()->count(1)->create();
        $response = $this->patchJson('/api/v1/products/' . $product[0]->id, [
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

    public function test_patch_product_validation_name()
    {
        $test = Product::factory()->count(1)->create();

        $response = $this->patchJson('/api/v1/products/' . $test[0]->id, [
            'name' => '',
            'price' => 100,
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);
        $response->assertStatus(422);
    }

    public function test_patch_product_validation_description()
    {
        $product = Product::factory()->count(1)->create();
        $response = $this->patchJson('/api/v1/products/' . $product[0]->id, [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
            'description' => ''
        ]);

        $response->assertStatus(422);
    }

    public function test_patch_product_validation_price()
    {
        $product = Product::factory()->count(1)->create();
        $response = $this->patchJson('/api/v1/products/' . $product[0]->id, [
            'name' => 'Product 1',
            'price' => 'abc',
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);

        $response->assertStatus(422);
    }

    public function test_patch_product_validation_stock()
    {
        $product = Product::factory()->count(1)->create();

        $response = $this->patchJson('/api/v1/products/' . $product[0]->id, [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 'abc',
            'description' => 'Description of product 1'
        ]);
        $response->assertStatus(422);
    }

    public function test_patch_product_not_found()
    {
        $response = $this->patchJson('/api/v1/products/231', [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);
        $response->assertStatus(404);
    }

    public function test_patch_product_without_data()
    {
        $response = $this->patchJson('/api/v1/products/231', []);
        $response->assertStatus(404);
    }
    public function test_patch_product_with_missing_data()
    {
        $product = Product::factory()->count(1)->create();
        $response = $this->patchJson('/api/v1/products/' . $product[0]->id, [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
        ]);

        $response->assertStatus(200);
    }
}
