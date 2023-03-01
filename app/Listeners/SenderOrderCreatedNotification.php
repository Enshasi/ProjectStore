<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SenderOrderCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreate $event)
    {


            $order = $event->order;
        //One User
        $user = User::where('store_id' , $order->store_id)->first();


        $user->notify(new OrderCreatedNotification($order));
        //Multi User
        // $users = User::where('store_id','=' , $order->store_id)->get();
        // Notification::send($users  , new OrderCreatedNotification($order));
    }
}
