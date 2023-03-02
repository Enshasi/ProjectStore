<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
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

Route::get('/', [HomeController::class , 'index'])->name('home');

//Controller Products
Route::get('products',[ ProductsController::class , 'index'])->name('products.index');
//where id = id  replace , Where slug = slug
Route::get('products/{product:slug}', [ProductsController::class  , 'show'])->name('products.show');
Route::resource('carts', CartController::class);

//checkouts
Route::get('checkout',[CheckoutController::class , 'create'])->name('checkout.create');
Route::post('checkout',[CheckoutController::class , 'store'])->name('checkout.store');
//require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
