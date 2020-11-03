<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Auth
Route::group(['namespace' => 'Api\Auth'], function (){
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('register', 'RegisterController@register')->name('register');

    Route::group(['middleware' => ['auth:api']], function () {
//        Route::get('email/verify/{hash}', 'VerificationController@verify')->name('verification.verify');
//        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
        Route::get('user', 'AuthenticationController@user')->name('user');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });
});

Route::group(['namespace' => 'Api'], function () {
    // Products
    Route::get('/products', 'ProductController@index');
    Route::get('/product/{id}', 'ProductController@detail');

    //Cart
    Route::get('/cart', 'CartController@index');
    Route::post('/addToCart', 'CartController@addToCart');
    Route::post('/changeQuantity', 'CartController@changeQuantity');
    Route::post('/removeFromCart', 'CartController@removeFromCart');
    Route::get('/cartInfo', 'CartController@cartInfo');

    // Order
    Route::get('/orderOverview', 'OrderController@orderConfirmation');
    Route::get('/placeOrder', 'OrderController@placeOrder')->name('placeOrder');


//    Route::group(['middleware' => ['auth:api']], function () {
//        Route::get('/placeOrder', 'OrdersController@placeOrder')->name('placeOrder');
//    });
});



