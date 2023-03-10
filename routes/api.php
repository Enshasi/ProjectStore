<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\AdminsController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\OrderAddressController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    // return $request->user();
    return Auth::guard('sanctum')->user();
});

Route::ApiResource('/products', ProductsController::class);

Route::ApiResource('/categories', CategoriesController::class)->middleware('auth:sanctum');
Route::ApiResource('/stores', StoreController::class)->middleware('auth:sanctum');
Route::ApiResource('/carts', CartController::class)->middleware('auth:sanctum');
Route::ApiResource('/orders', OrderController::class)->middleware('auth:sanctum');
Route::ApiResource('/orderItems', OrderItemController::class)->middleware('auth:sanctum');
Route::ApiResource('/orderAddress', OrderAddressController::class)->middleware('auth:sanctum');
Route::ApiResource('/users', UsersController::class)->middleware('auth:sanctum');
Route::ApiResource('/admins', AdminsController::class)->middleware('auth:sanctum');

Route::post('auth/access-tokens' , [AccessTokensController::class , 'store'])
->middleware('guest:sanctum');

Route::delete('auth/access-tokens/{token?}' , [AccessTokensController::class , 'destroy'])->middleware('auth:sanctum');
