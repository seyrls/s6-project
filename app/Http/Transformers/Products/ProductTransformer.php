<?php

namespace App\Http\Transformers\Products;

use App\Http\Transformers\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    public function transform(array $data)
    {
        return [
            'name' => $data['name'],
            'price' => $data['price'],
            'sku' => $data['sku'],
            'image_url' => $data['image_url'],
        ];
    }
}