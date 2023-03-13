<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Auth\SocialGetUserInfoController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\Front\ProductsController;
use App\Services\CurrencyConverter;
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
Route::group(
    ['prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
Route::get('/', [HomeController::class , 'index'])->name('home');

//Controller Products
Route::get('products',[ ProductsController::class , 'index'])->name('products.index');
//where id = id  replace , Where slug = slug
Route::get('products/{product:slug}', [ProductsController::class  , 'show'])->name('products.show');
Route::resource('carts', CartController::class);

//checkouts
Route::get('checkout',[CheckoutController::class , 'create'])->name('checkout.create');
Route::post('checkout',[CheckoutController::class , 'store'])->name('checkout.store');

//Currency
Route::post('currency',[CurrencyConverterController::class , 'store'])->name('currency.store');

Route::view('auth/2fa' , 'front/auth.tow-factor-auth');


});
//google and facebook auth
Route::get('auth/{provider}/redirect'  , [SocialLoginController::class ,'redirect' ])->name('auth.socialite.redirect');
Route::get('auth/{provider}/callback'  , [SocialLoginController::class , 'callback' ])->name('auth.socialite.callback');
Route::get('auth/{provider}/user'  , [SocialGetUserInfoController::class , 'index' ])->name('auth.socialite.index');

//Payments
Route::get('payments/{order}/pay' , [PaymentsController::class , 'create'])->name('orders.payments.create');
Route::post('orders/{order}/stripe/payment-intent' , [PaymentsController::class , 'createStripePaymentIntent'])
->name('stripe.paymentIntent.create');

//call back from stripe
Route::get('orders/{order}/pay/stripe/callback' , [PaymentsController::class , 'confirm'])->name('stripe.return');
//require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
