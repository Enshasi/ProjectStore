<?php

namespace App\Listeners;

use App\Facades\Cart;
use App\Models\product;
use Database\Factories\ProductFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeductProductQuantity
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
    public function handle()
    {
        //update products set quantity = 'quantity - 1'
        foreach (Cart::get() as $item){
                product::where('id' , '=' , $item->product_id)->update([
                    'quantity' => DB::raw("quantity - {$item->quantity}") ,
                ]);
        }
    }
}
