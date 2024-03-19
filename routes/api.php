<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['prefix' => 'auth'], function (){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::get('products', [ProductController::class, 'getProducts']);

Route::group(['prefix' => 'cart'], function(){
    Route::get('user', [CartController::class, 'userCart']);
    Route::post('add', [CartController::class, 'addToCart']);
    Route::post('delete', [CartController::class, 'deleteFromCart']);
    Route::post('update', [CartController::class, 'updateCart']);
});

Route::post('checkout', [OrderController::class, 'checkout']);
