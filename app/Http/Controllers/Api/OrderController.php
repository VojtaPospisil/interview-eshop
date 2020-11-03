<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Orders;
use App\ProductsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $orders = Orders::where('user_id', $userId)->get();

        return view('orders.orderOverview')->with('orders', $orders);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function placeOrder()
    {
//        if (!Auth::check()) {
//            Redirect::to('login')->send();
//        }

        $userId = Auth::id();
        $cart = Session::get('cart');

        $order = new Orders();
        $order->user_id = $userId;
        $order->total_price = $cart->getTotalPrice();
        $order->save();

        foreach ($cart->getProducts() as $product) {
            ProductsOrder::create($product, $order->id);
        }

        Session::forget('cart');
    }

    public function orderConfirmation() {
        $order = Orders::with('productOrder')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();

         return response()->json([
           'order' => $order
        ], 200);

    }
}
