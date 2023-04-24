<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    // 'user_auth'

])->group(function () {

    Route::middleware(['user_auth'])->group(function () {
       Route::group(['prefix'=>'admin'],function(){
        Route::get('list',[AdminController::class,'getAdminList'])->name('admin#list');
        Route::get('list/changeRole',[AdminController::class,'ChangeRole'])->name('admin#ChangeRole');//ajax route
        Route::get('profile',[AdminController::class,'getProfile'])->name('admin#profile');
        Route::get('profile/editPage/{id}',[AdminController::class,'editProfilePage'])->name('admin#editProfilePage');
        Route::get('profile/list/detail/{id}',[AdminController::class,'profileDetail'])->name('admin#profileDetail');
        Route::get('profile/list/delete/{id}',[AdminController::class,'deleteAdmin'])->name('admin#deleteAdmin');
        Route::post('profile/editPage',[AdminController::class,'editProfile'])->name('admin#editProfile');
    });
    Route::get('/', [ProductController::class,'home'])->name('product#homePage');
    });



        Route::get('orderList',[OrderController::class,'getOrderList'])->name('order#getOrders');
        Route::get('orderItems/{order_code}',[OrderController::class,'getOrderItems'])->name('order#getOrderItems');
           Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('order#ajaxChangeStatus');
    Route::prefix('product')->group(function () {
    Route::get('createPage', [ProductController::class,'productCreatePage'])->name('product#productCreatePage');
    Route::post('create',[ProductController::class,'createProduct'])->name('product#createProduct');
    Route::get('editPage/{id}',[ProductController::class,'editProductPage'])->name('product#editProductPage');
    Route::post('edit',[ProductController::class,'edit'])->name('product#edit');
    Route::get('delete/{id}',[ProductController::class,'deleteProduct'])->name('product#deleteProduct');
    Route::get('/category/createPage',[CategoryController::class,'createCategoryPage'])->name('category#createCategoryPage');
    Route::post('/category/create',[CategoryController::class,'createCategory'])->name('category#createCategory');


        Route::middleware(['user_auth'])->group(function () {
                Route::prefix('user')->group(function () {
                    Route::get('home',[UserController::class,'home'])->name('user#home');
                });
        });

    });

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
