<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShoppingCartController extends Controller
{
    /**
     * @return View
     */
    public function index() {
        $data = array();

        if(Session::has('cart')) {
            $cart = Session::get('cart');
//            dd($cart);

            $data = array(
                'products' => $products = $cart->getProducts(),
                'totalQuantity' => $totalQuantity = $cart->getTotalQuantity(),
                'totalPrice' => $totalPrice = $cart->getTotalPrice()
            );

        }
//        dd($data);
        return view('ShoppingCart.shoppingCart',  $data
        );

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function remove($id) {
        if (Session::has('cart')) {
            /**
             * @param ShoppingCart $cart
             */
            $cart = Session::get('cart');
            $productRemoved = $cart->getProductById($id);
            $cart->remove($id);

            if (Session::get('cart')->getTotalItems() === 0) {
                Session::forget('cart');
                return response()->json(['success'=> null]);
            }

            return response()->json(['success'=> 'Produkt ' . $productRemoved['product']->name . ' byl odstraněn z košíku.']);
        }
    }

    public function quantityChange(Request $request) {
        $id = $request->productId;
        $quantity = $request->quantity;

        if (Session::has('cart')) {
            $cart = Session::get('cart');
            $cart->updateQuantity($id, $quantity);
            Session::put('cart', $cart);
        }

        return response()->json(['success'=> 'Produkt ' . ' byl upraven.']);

    }
}
