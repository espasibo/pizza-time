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

Route::get('currency/list', 'Api\CurrencyController@get_list');

Route::prefix('products')->group(function () {

    Route::get('menu', 'Api\ProductsController@get_menu');
    Route::get('types', 'Api\ProductsController@get_types');
    Route::get('service', 'Api\ProductsController@get_service');
});

Route::prefix('orders')->group(function () {

    Route::post('save', 'Api\OrdersController@save');
    Route::get('list', 'Api\OrdersController@orders_list');
    Route::get('user', 'Api\OrdersController@user');
});