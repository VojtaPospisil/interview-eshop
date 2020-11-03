<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsOrder extends Model
{
    protected $fillable = [
        'name', 'product_price', 'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public static function create($product, $orderId){
        $productOrder = new ProductsOrder();
        $productOrder->order_id = $orderId;
        $productOrder->product_id = $product['product']->id;
        $productOrder->name = $product['product']->name;
        $productOrder->products_price = $product['totalPrice'];
        $productOrder->quantity = $product['quantity'];
        $productOrder->save();
    }
}
