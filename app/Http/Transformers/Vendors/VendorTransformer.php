<?php

namespace App\Http\Transformers\Vendors;

use App\Http\Transformers\Products\ProductTransformer;
use App\Http\Transformers\TransformerAbstract;

class VendorTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['products'];

    public function transform($data)
    {
        return [
            'id' => $data->id,
            'name' => $data->name,
        ];
    }

    public function includeProducts($data)
    {
        if (!empty($data->products)) {
            return $this->collection($data->products, new ProductTransformer());
        }

        return $this->null();
    }
}