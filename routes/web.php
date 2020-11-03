<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Front

    //Products
    Route::view('/', 'products.index');
    Route::get('/product/{id}', 'Api\ProductController@detail')->name('product.detail');

    //Cart
    Route::post('/product/addToBasket', 'Api\CartController@addToCart')->name('addToCart');
    Route::get('/product/{id}/remove', 'CartController@remove')->name('remove');
    Route::post('/product/quantityChange', 'CartController@quantityChange')->name('quantityChange');
    Route::view('/shoppingCart', 'shoppingCart.index')->name('shoppingCart');

    //Orders
    Route::get('/orderOverview', 'Api\OrderController@orderConfirmation');

// Admin
//Route::get('/admin', 'ProductController@index');
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/admin', 'ProductController@index')->name('product.index');
        Route::resource('admin/product', 'ProductController');
        Route::get('admin/orders', 'OrderController@index')->name('order.index');
        Route::get('admin/order/{order}', 'OrderController@show')->name('order.show');
    });

Auth::routes();
