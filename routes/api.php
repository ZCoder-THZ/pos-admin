<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CategoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::post('editProfile',[ProfileController::class,'editProfile']);

// Route::get('products',[ProductController::class,'getProducts'])->middleware('auth:sanctum'); for middleware auth
Route::get('products',[ProductController::class,'getProducts']);
Route::get('products/random',[ProductController::class,'getRandomProducts']);
Route::get('product/{id}',[ProductController::class,'getProduct']);

Route::post('order',[OrderController::class,'createOrderAndItems']);
Route::delete('order/{id}',[OrderController::class,'deleteOrderAndItems']);
// Route::post('order-items',[OrderController::class,'createOrderItem']);
Route::get('order/{userId}',[OrderController::class,'getOrder']);
Route::get('order-items/{userId}',[OrderController::class,'getOrderItems']);
Route::get('orderItems/{orderCode}',[OrderController::class,'getOrderItemsByOrderCode']);


Route::get('category',[CategoryController::class,'getCategory']);


// Route::get('products?search=keyword',[ProductController::class,'getProducts']);
