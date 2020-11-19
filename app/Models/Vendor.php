<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function items()
    {
        return $this->belongsToMany(OrderLineItem::class, 'order_line_items', 'vendor_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_types_vendors', 'vendor_id');
    }
}
