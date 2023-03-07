<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\StoreController;
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

Route::post('auth/access-tokens' , [AccessTokensController::class , 'store'])
->middleware('guest:sanctum');

Route::delete('auth/access-tokens/{token?}' , [AccessTokensController::class , 'destroy'])->middleware('auth:sanctum');
