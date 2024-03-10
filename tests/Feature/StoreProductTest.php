<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    public function test_store_product()
    {
        $response = $this->postJson('/api/v1/products', [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);

        $response->assertStatus(201);
    }

    public function test_store_product_validation_name()
    {
        $response = $this->postJson('/api/v1/products', [
            'name' => '',
            'price' => 100,
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);

        $response->assertStatus(422);
    }

    public function test_store_product_validation_price()
    {
        $response = $this->postJson('/api/v1/products', [
            'name' => 'Product 1',
            'price' => 'abc',
            'stock' => 10,
            'description' => 'Description of product 1'
        ]);

        $response->assertStatus(422);
    }

    public function test_store_product_validation_stock()
    {
        $response = $this->postJson('/api/v1/products', [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 'abc',
            'description' => 'Description of product 1'
        ]);

        $response->assertStatus(422);
    }

    public function test_store_product_validation_description()
    {
        $response = $this->postJson('/api/v1/products', [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
            'description' => null,
        ]);

        $response->assertStatus(422);
    }
    public function test_store_product_without_description()
    {
        $response = $this->postJson('/api/v1/products', [
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
        ]);

        $response->assertStatus(422);
    }
}
