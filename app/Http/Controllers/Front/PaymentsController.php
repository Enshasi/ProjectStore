<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function create(Order $order)
    {

        return view('front.payments.create', [
            'order' => $order
        ]);
    }
    //create payment
    public function createStripePaymentIntent(Order $order){

        //check Stats  using BackEnd
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $amount  = $order->items->sum(function ($item){
            return $item->price * $item->quantity;
        });
        $paymentIntents = $stripe->paymentIntents->create(
          ['amount' => $amount,
          'currency' => 'usd',
          'payment_method_types' => ['card']
          ]
        );
        try {
            $payment = new Payment();
            $payment->forceFill([
                'order_id' => $order->id,
                'amount' => $paymentIntents->amount,
                'currency' => $paymentIntents->currency,
                'status' => 'pending',
                'method' => 'stripe',
                'transaction_id' => $paymentIntents->id,
                'transaction_data' => json_encode($paymentIntents),
            ])->save();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return [
            'clientSecret' => $paymentIntents->client_secret,
        ];
    }
    //call back from stripe
    public function confirm(Request $request , Order $order ){
        // dd($request->all());
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
          $paymentIntent = $stripe->paymentIntents->retrieve(
                $request->payment_intent ,
            []
          );
          if ($paymentIntent->status == 'succeeded'){
           try{
                    //Update payment
                    $payment = Payment::where('order_id' , $order->id)->first();
                    $payment->forceFill([
                        'status' => 'completed',
                        'transaction_data' => json_encode($paymentIntent),
                    ])->save();
           }catch (\Exception $e){
               return $e->getMessage();
           }
          }
        // event() //Can Add Event
        return redirect()->route('home');

    }
}
