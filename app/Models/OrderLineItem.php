<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLineItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'quantity',
        'vendor_id',
        'product_id',
        'order_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products', 'product_id');
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendors', 'vendor_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders', 'vendor_id');
    }
}