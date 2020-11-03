<?php


namespace App\Providers;

use App\Products;
use App\ShoppingCart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
//    public static $cartSession = null;
//
//    public function __construct()
//    {
//        $this->cartSession = Session::has('cart') ? Session::get('cart') : new ShoppingCart();
//    }

    public static function addToCart(Products $product, ?int $quantity)
    {
        $cart = Session::has('cart') ? Session::get('cart') : new ShoppingCart();
        $quantity = $quantity ?? 1;
//        $cart = Session::has('cart') ? Session::get('cart') : new ShoppingCart();
//        $cart->store($product, $quantity);
        $cart->store($product, $quantity);
        Session::put('cart', $cart->cartSession);

        return;

//        if (Session::has('cart')) {
//            $cart = Session::get('cart');
//            $cart->store($product, $quantity);
////            $cart = $cart->inCart($product->id) ? $cart->update($product, $quantity) : $cart->add($product, $quantity);
//            return $cart;
//        }
//
//        $cart = Session::has('cart') ? Session::get('cart') : new shoppingCart();
//        $cart->update($product, $quantity);

    }

    public function changeQunatity($productId, $quantity)
    {
        $cart = Session::has('cart') ? Session::get('cart') : new ShoppingCart();
        $cart->changeQuantity($productId, $quantity);
//        dd('hey');
        Session::put('cart', $cart);

        return;
    }

    public function getSession() {
        return $this->cartSession;
    }

}
