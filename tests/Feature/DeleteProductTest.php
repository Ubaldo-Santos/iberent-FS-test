<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_delete_product()
    {
        $product = Product::factory()->count(1)->create();
        $response = $this->deleteJson('/api/v1/products/' . $product[0]->id);
        $response->assertStatus(204);
    }

    public function test_delete_product_not_found()
    {
        $response = $this->deleteJson('/api/v1/products/1');
        $response->assertStatus(404);
    }

    public function test_delete_product_validation_id()
    {
        $response = $this->deleteJson('/api/v1/products/abc');
        $response->assertStatus(404);
    }

    public function test_delete_product_validation_id_empty()
    {
        $response = $this->deleteJson('/api/v1/products/');
        $response->assertStatus(405);
    }

    public function test_delete_product_validation_id_not_numeric()
    {
        $response = $this->deleteJson('/api/v1/products/abc');
        $response->assertStatus(404);
    }
}
