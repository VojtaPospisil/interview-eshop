<?php

namespace App\Http\Controllers;

use App\Products;
use App\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * @return View
     */
    public function index() {
        $products = Products::all();

        return view('products.products')->with('products', $products);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProduct(Request $request) {
        $product = Products::find($request->productId);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new ShoppingCart($oldCart);
        $cart->addToCart($product, $request->quantity);
        Session::put('cart', $cart);

        return response()->json(['success'=>'Produkt' . $product->name . 'byl přidán do košíku',  ]);

    }
}
