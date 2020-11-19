<?php

namespace App\Http\Transformers\Orders;

use App\Http\Transformers\Products\ProductTransformer;
use App\Http\Transformers\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['products'];

    public function transform($data)
    {
        return [
            'id' => $data->id,
            'subtotal' => $data->subtotal,
            'tax' => $data->tax,
            'fee' => $data->fee,
            'total' => $data->total,
        ];
    }

    public function includeProducts($data)
    {
        if (empty($data->products)) {
            return $this->collection($data->items, new ProductTransformer());
        }

        return $this->null();
    }
}