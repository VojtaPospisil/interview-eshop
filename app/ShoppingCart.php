<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    public $products = array();

    /**
     * @param Products $product
     * @param int $quantity
     */
    public function store(Products $product, int $quantity)
    {
        $this->products[$product->id] = array(
            'product' => $product,
            'quantity' => $quantity,
            'totalPrice' => $product->price * $quantity
        );
    }

//    /**
//     * @param $product
//     * @param $quantity
//     */
//    public function changeQuantity($product, $quantity)
//    {
//        if ($this->productInCart($product->id)) {
//            $this->products[$product->id]['quantity'] = $quantity;
//            $this->products[$product->id]['totalPrice'] = $product->price * $quantity;
//
//            return;
//        }
//    }

    public function updateQuantity($product, $quantity)
    {
        $this->products[$product->id]['quantity'] = $quantity;
        $this->products[$product->id]['totalPrice'] = $product->price * $quantity;
    }

//    /**
//     * @param Products $product
//     * @param int $quantity
//     */
//    public function addToCart(Products $product, $quantity)
//    {
//        $productId = $product->id;
//        $storeProductPrice = $quantity * $product->price;
//        $storedItem = array(
//            'totalProductQuantity' => $quantity,
//            'totalProductPrice' => $storeProductPrice,
//            'product' =>$product
//        );
//
//        if(array_key_exists($product->id, $this->products)) {
//            $storedItem = $this->products[$productId];
//            $storedItem['totalProductQuantity'] += $quantity;
//            $storedItem['totalProductPrice'] += $storeProductPrice;
//        }
//
//        $this->products[$productId] = $storedItem;
//        $this->totalQuantity += $quantity;
//        $this->totalPrice += $storeProductPrice;
//    }

    /**
     * @param int $id
     */
    public function remove($id)
    {
        unset($this->products[$id]);
    }
//
//    /**
//     * @param $id
//     * @param $quantity
//     * @return mixed
//     */
//    public function updateQuantity($id, $quantity)
//    {
//        $product = $this->products[$id];
//        $oldQuantity = $product['totalProductQuantity'];
//        $product['totalProductQuantity'] = $quantity;
//        $product['totalProductPrice'] = $quantity * $product['product']->price;
//        $this->products[$id] = $product;
//
//        if ($oldQuantity < $quantity) {
//            $this->totalQuantity ++;
//            $this->totalPrice += $product['product']->price;
//
//            return;
//        }
//
//        $this->totalQuantity --;
//        $this->totalPrice -= $product['product']->price;
//
//        return;
//    }
    /**
     * @param $id
     * @return bool
     */
    public function productInCart($id)
    {
        return isset($this->products[$id]);
    }

    /**
     * @return int|null
     */
    public function getTotalQuantity()
    {
        $totalQuantity = 0;
        foreach ($this->products as $product) {
            $totalQuantity += $product['quantity'];
        }

        return $totalQuantity;
    }

    /**
     * @return int
     */
    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice += $product['totalPrice'];
        }

        return $totalPrice;
    }

    /**
     * @return array|null
     */
    public function getProducts()
    {
        return $this->products;
    }
}
