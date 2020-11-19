<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreativesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetCreatives()
    {
        $response = $this->get('http://127.0.0.1:8000/api/creatives');

        $response->assertJsonStructure([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Test',
                    'description' => 'TEstesteildsa',
                    'products' => [
                        [
                            'name' => 'tshirt 1',
                            'price' => 9.99,
                            'sku' => 123,
                            'image_url' => 'http://www.googleo.com'
                        ],
                        [
                            'name' => 'tshirt 2',
                            'price' => 10.99,
                            'sku' => 456,
                            'image_url' => 'http://www.googleo.com'
                        ]
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Test 2',
                    'description' => 'lkhdslkfgsd',
                    'products' => [
                        [
                            'name' => 'Painting 1',
                            'price' => 199.99,
                            'sku' => 444,
                            'image_url' => 'http://www.googleo.com'
                        ],
                        [
                            'name' => 'Painting 2',
                            'price' => 299.98,
                            'sku' => 6775,
                            'image_url' => 'http://www.googleo.com'
                        ]
                    ]
                ]
            ]
        ]);

        $response->assertStatus(200);
    }

    public function testGetCreative()
    {
        $response = $this->get('http://127.0.0.1:8000/api/creatives');

        $response->assertJsonStructure([
            'data' => [
                'id' => 1,
                'name' => 'Test',
                'description' => 'TEstesteildsa',
                'products' => [
                    [
                        'name' => 'tshirt 1',
                        'price' => 9.99,
                        'sku' => 123,
                        'image_url' => 'http://www.googleo.com'
                    ],
                    [
                        'name' => 'tshirt 2',
                        'price' => 10.99,
                        'sku' => 456,
                        'image_url' => 'http://www.googleo.com'
                    ]
                ]
            ]
        ]);

        $response->assertStatus(200);
    }
}