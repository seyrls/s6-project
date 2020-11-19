<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtotal',
        'tax',
        'fee',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(OrderLineItem::class, 'order_id');
    }
}
