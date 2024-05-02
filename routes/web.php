<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::middleware([])->group(function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('list', [AdminController::class, 'getAdminList'])->name('admin#list');
            Route::get('list/changeRole', [AdminController::class, 'ChangeRole'])->name('admin#ChangeRole'); //ajax route
            Route::get('profile', [AdminController::class, 'getProfile'])->name('admin#profile');
            Route::get('profile/editPage/{id}', [AdminController::class, 'editProfilePage'])->name('admin#editProfilePage');
            Route::get('profile/list/detail/{id}', [AdminController::class, 'profileDetail'])->name('admin#profileDetail');
            Route::get('profile/list/delete/{id}', [AdminController::class, 'deleteAdmin'])->name('admin#deleteAdmin');
            Route::post('profile/editPage', [AdminController::class, 'editProfile'])->name('admin#editProfile');
        });
    });
    Route::get('/', [ProductController::class, 'home'])->name('product#homePage');
    Route::prefix('category')->group(function () {
        Route::get('view-by-category/{id}', [ProductController::class, 'viewByCategory'])->name('product#viewByCategory');
    });
    Route::get('orderList', [OrderController::class, 'getOrderList'])->name('order#getOrders');
    Route::get('categoryList', [CategoryController::class, 'categoryList'])->name('category#categoryList');
    Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category#deleteCategory');
    Route::get('orderItems/{order_code}', [OrderController::class, 'getOrderItems'])->name('order#getOrderItems');
    Route::get('ajax/change/status', [OrderController::class, 'ajaxChangeStatus'])->name('order#ajaxChangeStatus');
    Route::prefix('product')->group(function () {
        Route::get('createPage', [ProductController::class, 'productCreatePage'])->name('product#productCreatePage');
        Route::post('create', [ProductController::class, 'createProduct'])->name('product#createProduct');
        Route::get('editPage/{id}', [ProductController::class, 'editProductPage'])->name('product#editProductPage');
        Route::post('edit', [ProductController::class, 'edit'])->name('product#edit');
        Route::get('delete/{id}', [ProductController::class, 'deleteProduct'])->name('product#deleteProduct');
        Route::get('/category/createPage', [CategoryController::class, 'createCategoryPage'])->name('category#createCategoryPage');
        Route::post('/category/create', [CategoryController::class, 'createCategory'])->name('category#createCategory');

        // Route::middleware(['user_auth'])->group(function () {
        //         Route::prefix('user')->group(function () {
        //             Route::get('home',[UserController::class,'home'])->name('user#home');
        //         });
        // });
    });
    Route::get('countries', [CountryController::class, 'index'])->name('country#countryList');
    Route::get('country-list', [CountryController::class, 'getCountryList'])->name('country#getCountryList');
    Route::post('add-country', [CountryController::class, 'storeCountry'])->name('country#storeCountry');
    Route::put('update-country', [CountryController::class, 'updateCountry'])->name('country#updateCountry');
    Route::delete('delete-country/{id}', [CountryController::class, 'deleteCountry'])->name('product#deleteCountry');
    // City
    Route::get('cities', [CityController::class, 'index'])->name('city#cityList');
    Route::get('city-list', [CityController::class, 'getCityList'])->name('city#getCityList');
    Route::post('add-city', [CityController::class, 'storeCity'])->name('city#storeCity');
    Route::put('update-city', [CityController::class, 'updateCity'])->name('city#updateCity');
    Route::delete('delete-city/{id}', [CityController::class, 'deleteCity'])->name('city#deleteCity');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
