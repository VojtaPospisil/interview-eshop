<?php


namespace App\Helpers;

use App\ShoppingCart;
use Illuminate\Support\Facades\Session;


class Helper
{

    public static function SetMessage($key ,$message){
        Session::put($key, $message);
//        Session::put('user_message_type', $type);
        Session::save();
    }
    public static function ForgetMessage($key){
        Session::forget($key);
//        Session::forget('user_message_type');
        Session::save();
    }

    /**
     * @return false|string|null
     */
    public static function getCartJson() {

        if (!Session::has('cart')) {
            return null;
        }

        $data = Session::get('cart');
        $cartJson = array();

        foreach ($data->products as $key => $product) {
            $cartProducts[] = array(
                'productId' => $product['product']->id,
                'productName' => $product['product']->name,
                'productPrice' =>$product['product']->price,
                'productQuantity' => $product['quantity'],
                'totalProductPrice' => $product['totalPrice']
            );
            $cartJson['products'] = $cartProducts;
            $cartJson['totalPrice'] = Session::get('cart')->getTotalPrice();
        }

        return json_encode($cartJson);
    }

    public static function getShoppingCartSession() {
        return Session::has('cart') ? Session::get('cart') : null;

    }
}
