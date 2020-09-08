<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'ProductsController@index')->name('index');

Route::post('/product/addToBasket', 'ProductsController@addProduct');
Route::get('/shoppingCart', 'ShoppingCartController@index')->name('shoppingCart');
Route::get('/product/{id}/remove', 'ShoppingCartController@remove')->name('remove');
Route::post('/product/quantityChange', 'ShoppingCartController@quantityChange')->name('quantityChange');
Route::post('/placeOrder', 'ShoppingCartController@placeOrder')->name('placeOrder');
