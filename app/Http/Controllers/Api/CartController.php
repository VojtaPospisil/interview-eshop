<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Products;
use App\Http\Resources\ProductResource;
use App\ShoppingCart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * return Json array of cart
     *
     * @return false|string|null
     */
    public function index()
    {
        return Helper::getCartJson();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function addToCart(Request $request)
    {
        $product = Products::find($request->productId);
        $cart = Session::has('cart') ? Session::get('cart') : new ShoppingCart();
        $quantity = $request->quantity ?? 1;

        if($cart->productInCart($request->productId)) {
            $newQuantity = $cart->products[$request->productId]['quantity'] + $quantity;
            $cart->updateQuantity($product, $newQuantity);
        } else {
            $cart->store($product, $quantity);
        }

        Session::put('cart', $cart);

        return ProductResource::collection(Products::all());
    }

    /**
     * @param Request $request
     * @return false|string|null
     */
    public function changeQuantity(Request $request)
    {
        $product = Products::find($request->productId);
        $cart = Session::has('cart') ? Session::get('cart') : new ShoppingCart();
        $cart->updateQuantity($product, $request->quantity);
        Session::put('cart', $cart);

        return Helper::getCartJson();
    }

    /**
     * @param Request $request
     * @return false|string|null
     */
    public function removeFromCart(Request $request)
    {
        $cart = Session::has('cart') ? Session::get('cart') : new ShoppingCart();
        $cart->remove($request->productId);
        Session::put('cart', $cart);

        return Helper::getCartJson();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function cartInfo() {
        $totalItems = Session::has('cart') ? Session::get('cart')->getTotalQuantity() : null;

        return response()->json([
            'totalItems' => $totalItems
        ], 200);

    }

}
