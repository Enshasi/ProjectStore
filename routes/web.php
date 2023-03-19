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
use App\Http\Controllers\Genral\OrdersController;
use App\Http\Controllers\Genral\StripWebhooksController;
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



Route::post('orders/stripe/{order}/payment_intent', [PaymentsController::class, 'createStripePaymentIntent'])
    ->name('stripe.paymentIntent.create');
Route::get('orders/{order}/payment' , [PaymentsController::class , 'create'] )->name('orders.payments.create');



Route::get('orders/pay/{order}/stripe/callback' , [PaymentsController::class , 'confirm'] )
    ->name('stripe.return');

//strip webhooks(Live Notifications)
Route::any('stripe/webhook',[StripWebhooksController::class , 'handle']);

//Maping
Route::get('order/{order}' , [OrdersController::class , 'show'])->name('orders.show');

//require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
