<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 't_shirt 1',
                'price' => 9.99,
                'sku' => 'abc123',
                'image_url' => 'http://www',
                'creative_id' => 1,
                'product_type_id' => 1,
            ],
            [
                'name' => 't_shirt 2',
                'price' => 10.99,
                'sku' => 'abc9087',
                'image_url' => 'http://www',
                'creative_id' => 1,
                'product_type_id' => 1,
            ],
            [
                'name' => 'painting 1',
                'price' => 100.99,
                'sku' => '12345',
                'image_url' => 'http://www',
                'creative_id' => 2,
                'product_type_id' => 2,
            ],
            [
                'name' => 'painting 2',
                'price' => 200.99,
                'sku' => '987654',
                'image_url' => 'http://www',
                'creative_id' => 2,
                'product_type_id' => 2,
            ],
        ]);
    }
}