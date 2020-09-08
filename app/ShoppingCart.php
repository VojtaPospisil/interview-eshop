<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model {
   public $products = null;
   public $totalQuantity = 0;
   public $totalPrice = 0;
   public $totalItems = 0;

    /**
     * ShoppingCart constructor.
     * @param ShoppingCart|null $oldCart
     */
   public function __construct($oldCart) {
       if ($oldCart) {
           $this->products = $oldCart->products;
           $this->totalQuantity = $oldCart->totalQuantity;
           $this->totalPrice = $oldCart->totalPrice;
           $this->totalItems = $oldCart->totalItems;
       }
   }

    /**
     * @param Products $product
     * @param int $quantity
     */
   public function addToCart(Products $product, $quantity) {
       $productId = $product->id;
       $storeProductPrice = $quantity * $product->price;
       $storedItem = ['totalProductQuantity' => $quantity, 'totalProductPrice' => $storeProductPrice, 'product' =>$product];
//       $storedItem[$productId] = [
////           'product' => $productId,
//           'name' => $product->name,
//           'price' => $product->price,
//           'quantity' => $quantity
////           'totalProductQuantity' => $quantity, 'totalProductPrice' => $storeProductPrice, 'product' =>$product
//       ];

       if ($this->products) {
           if (array_key_exists($productId, $this->products)) {
                $storedItem = $this->products[$productId];
                $storedItem['totalProductQuantity'] += $quantity;
                $storedItem['totalProductPrice'] += $storeProductPrice;
           }
       }

//       $storedItem['totalProductPrice'] = ($quantity + $storedItem['totalProductQuantity']) * $storedItem['product']->price;
       $this->products[$productId] = $storedItem;
//       $this->productId = $storedItem;
       $this->totalQuantity += $quantity;
       $this->totalPrice += $storeProductPrice;
       $this->totalItems = count($this->products);
   }

    /**
     * @param int $id
     */
   public function remove($id) {
       $product = $this->products[$id];
       $this->totalQuantity -= $product['totalProductQuantity'];
       $this->totalPrice -= $product['totalProductPrice'];
       $this->totalItems --;
       unset($this->products[$id]);
   }

    /**
     * @param $id
     * @param $quantity
     * @return mixed
     */
   public function updateQuantity($id, $quantity) {
       $product = $this->products[$id];
       $oldQuantity = $product['totalProductQuantity'];
       $product['totalProductQuantity'] = $quantity;
       $product['totalProductPrice'] = $quantity * $product['product']->price;
       $this->products[$id] = $product;

        if ($oldQuantity < $quantity) {
            $this->totalQuantity ++;
            $this->totalPrice += $product['product']->price;

            return;
        }

        $this->totalQuantity --;
        $this->totalPrice -= $product['product']->price;

        return;
   }

    /**
     * @return int
     */
   public function getTotalquantity() {
       return $this->totalQuantity;
   }

    /**
     * @return array|null
     */
   public function getProducts() {
       return $this->products;
   }

   public function getProductById($id) {
       return $this->products[$id];
   }

    /**
     * @return int
     */
   public function getTotalPrice() {
       return $this->totalPrice;
   }

    /**
     * @return int
     */
   public function getTotalItems() {
       return $this->totalItems;
   }

}
