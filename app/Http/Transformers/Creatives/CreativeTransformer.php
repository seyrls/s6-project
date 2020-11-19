<?php

namespace App\Http\Transformers\Creatives;

use App\Http\Transformers\Products\ProductTransformer;
use App\Http\Transformers\TransformerAbstract;

class CreativeTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['products'];

    public function transform(array $data)
    {
        return [
            'name'=> $data['name'],
            'description' => $data['description'],
        ];
    }

    public function includeProducts(array $data)
    {
        if (!empty($data['products'])) {
            return $this->collection($data, new ProductTransformer());
        }

        return $this->null();
    }
}