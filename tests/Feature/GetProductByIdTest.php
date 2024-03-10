<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class GetProductByIdTest extends TestCase
{

    public function test_get_products_response_empty()
    {
        $response = $this->get('api/v1/products/1');
        $response->assertStatus(404);
    }

    public function test_get_products_response_with_data()
    {
        $products = Product::factory()->count(1)->create();
        $response = $this->get('api/v1/products/' . $products[0]->id);
        $response->assertStatus(200);
    }

    public function test_get_products_response_data()
    {
        $products = Product::factory()->count(1)->create();
        $response = $this->get('api/v1/products/' . $products[0]->id);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'price',
                'created_at',
                'updated_at',
            ]
        ]);
    }

    public function test_get_products_response_data_values()
    {
        $products = Product::factory()->count(1)->create();
        $response = $this->get('api/v1/products/' . $products[0]->id);
        $response->assertJsonFragment([
            'id' => $products[0]->id,
            'name' => $products[0]->name,
            'description' => $products[0]->description,
            'price' => $products[0]->price,
            'created_at' => $products[0]->created_at,
            'updated_at' => $products[0]->updated_at,
        ]);
    }
}
