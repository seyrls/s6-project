<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetProductsByCreative()
    {
        $response = $this->get('http://127.0.0.1:8000/api/products/1');

        $response->assertJsonStructure([
            'data' => [
                [
                    'name' => 'tshirt 1',
                    'price' => 9.99,
                    'sku' => 123,
                    'image_url' => 'http://www.googleo.com'
                ]
            ]
        ]);

        $response->assertStatus(200);
    }

    public function testGetProduct()
    {
        $response = $this->get('http://127.0.0.1:8000/api/product/1');

        $response->assertJsonStructure([
            'data' => [
                'name' => 'tshirt 1',
                'price' => 9.99,
                'sku' => 123,
                'image_url' => 'http://www.googleo.com'
            ]
        ]);

        $response->assertStatus(200);
    }

    public function testGetInvalidProduct()
    {
        $response = $this->get('http://127.0.0.1:8000/api/product/100');

        $response->assertJsonStructure([
            'error' => [
                'http_code' => 404,
                'message' => 'Product not found. Please, try it again.'
            ]
        ]);

        $response->assertStatus(200);
    }
}