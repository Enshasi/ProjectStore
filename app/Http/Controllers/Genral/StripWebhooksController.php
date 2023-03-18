<?php

namespace App\Http\Controllers\Genral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripWebhooksController extends Controller
{
    //handel
    public function handel(Request $request){

        // Log::debug('Webhook Event Received: ' , $request->all());

        $payload = @file_get_contents('php://input');
        $event = null;

        try {
          $event = \Stripe\Event::constructFrom(
            json_decode($payload, true)
          );
        } catch(\UnexpectedValueException $e) {
          // Invalid payload
          echo '⚠️  Webhook error while parsing basic request.';
          http_response_code(400);
          exit();
        }
        Log::debug('Webhook Event Received: ' , [$event->type]);

        // Handle the event
        switch ($event->type) {
          case 'payment_intent.canceled':
            $paymentIntent = $event->data->object;
            Log::debug('Payment Succeeded: ' , $paymentIntent);
            break;
          case 'payment_method.attached':
            $paymentMethod = $event->data->object;
            Log::debug('PaymentMethod was attached to a Customer: ' , $paymentMethod);
            break;
          default:
            // Unexpected event type
            error_log('Received unknown event type');
        }


    }
    // wieldy-keen-pepped-fancy

}
