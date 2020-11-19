<?php

namespace App\Http\Transformers\Auth;

use App\Http\Transformers\TransformerAbstract;

class AuthTransformer extends TransformerAbstract
{
    public function transform(array $data)
    {
        return [
            'access_token' => $data,
            'token_type' => 'Bearer'
        ];
    }
}