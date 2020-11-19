<?php

namespace Tests\Feature;

use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetProductsByCreative()
    {
        $response = $this->post('http://127.0.0.1:8000/api/orders', [
            'cart' => [
                [
                    'product_id' => 1,
                    'quantity' => 1,
                ],
                [
                    'product_id' => 2,
                    'quantity' => 1,
                ],
            ]
        ]);

        $response->assertJsonStructure([
            'data' => [
                'subtotal' => 20.98,
                'tax' => 2.74,
                'total' => 23.72
            ]
        ]);

        $response->assertStatus(204);
    }
}