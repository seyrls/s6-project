<?php

namespace App\Managers\Product;

use App\Models\Product;

class ProductManager
{
    private $repo;

    public function __construct(Product $repo)
    {
        $this->repo = $repo;
    }

    public function getProducts(int $creative_id)
    {
        return $this->repo::where('creative_id', $creative_id);
    }

    public function getProduct(int $id)
    {
        return $this->repo::findOrFail($id);
    }

    public function createProduct(array $data): bool
    {
        $product = new Product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->sku = $data['sku'];
        $product->image_url = $data['image_url'];

        return $product->saveOrFail();
    }
}