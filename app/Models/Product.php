<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'sku',
        'image_url',
    ];

    public function creative()
    {
        return $this->belongsTo(Creative::class);
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderLineItem::class, 'order_line_items', 'product_id');
    }
}
