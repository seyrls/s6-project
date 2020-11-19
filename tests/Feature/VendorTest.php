<?php

namespace Tests\Feature;

use Tests\TestCase;

class VendorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetProductsByVendor()
    {
        $response = $this->get('http://127.0.0.1:8000/api/vendors/1');

        $response->assertJsonStructure([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Marco Fine Arts',
                    'products' => [
                        [
                            'name' => 'tshirt 1',
                            'price' => 9.99,
                            'sku' => 123,
                            'image_url' => 'http://www.googleo.com'
                        ]
                    ]
                ]
            ]
        ]);

        $response->assertStatus(200);
    }
}