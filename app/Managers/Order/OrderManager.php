<?php

namespace App\Managers\Order;

use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;

class OrderManager
{
    private $repo;
    private $product_repo;

    public function __construct(Order $repo, Product $product_repo)
    {
        $this->repo = $repo;
        $this->product_repo = $product_repo;
    }

    public function getOrders(int $user_id)
    {
         return $this->repo::where('user_id', $user_id);
    }

    public function getOrder(int $order_id)
    {
        return $this->repo::findOrFail($order_id);
    }

    public function createOrder(array $data)
    {
        $subtotal = 0;
        $tax = 0;
        $fees = 0;
        $total = 0;
        $cart = [];

        foreach ($data as $item) {
            $product = $this->product_repo::find($item->product_id);
            $subtotal += $product->price * $item->quantity;
            $cart[] = [
                'quantity' => $item->quantity,
                'vendor_id' => $product->type->vendors->id,
                'product_id' => $product->id,
            ];
        }

        $tax = $subtotal * 0.13; //Ontario only
        $total = $subtotal + $tax + $fees;

        $order = new Order();
        $order->subtotal = $subtotal;
        $order->tax = $tax;
        $order->fee = $fees;
        $order->total = $total;
        $order->saveOrFail();

        foreach ($cart as $item) {
            $order_item = new OrderLineItem();
            $order_item->quantity = $item['quantity'];
            $order_item->product_id = $item['product_id'];
            $order_item->vendor_id = $item['vendor_id'];
            $order_item->order_id = $order->id;
            $order_item->saveOrFail();
        }
    }
}