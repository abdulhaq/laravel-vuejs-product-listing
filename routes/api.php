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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// List products
Route::get('products', 'App\Http\Controllers\ProductController@index');

// List single product
Route::get('product/{id}', 'App\Http\Controllers\ProductController@show');

// Create new product
Route::post('product', 'App\Http\Controllers\ProductController@store');

// Update product
Route::put('product', 'App\Http\Controllers\ProductController@store');

// Delete product
Route::delete('product/{id}', 'App\Http\Controllers\ProductController@destroy');