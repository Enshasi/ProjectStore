<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create', compact('order'));
    }
    //create payment
    public function createStripePaymentIntent(Order $order){
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $amount = $order->items->sum(function($item){
            return $item->price * $item->quantity;
        });
        $paymentIntents = $stripe->paymentIntents->create(
          ['amount' => 1000,
          'currency' => 'usd',
          'payment_method_types' => ['card']
          ]
        );

        return [
            'client_secret' => $paymentIntents->client_secret,
        ];
    }
    //call back from stripe
    public function confirm(Request $request , Order $order){
        dd($request->all());
    }
}
