<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class GetProductsTest extends TestCase
{

    public function test_get_products_response_empty()
    {
        $response = $this->get('api/v1/products');
        $response->assertStatus(200);
    }

    public function test_get_products_response_with_data()
    {
        Product::factory()->count(1)->create();
        $response = $this->get('api/v1/products');
        $response->assertStatus(200);
    }

    // check the response data

    public function test_get_products_response_data()
    {
        Product::factory()->count(1)->create();
        $response = $this->get('api/v1/products');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'created_at',
                    'updated_at',
                ]
            ]
        ]);
    }
}
