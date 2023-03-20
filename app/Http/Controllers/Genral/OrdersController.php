<?php

namespace App\Http\Controllers\Genral;

use App\Events\DeliveryLocationUpdated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function show(Order $order){
        $delivery = $order->delivery()->select([
            'id',
            'order_id',
            'status',
            DB::raw('ST_Y(current_location) AS lng'),
            DB::raw('ST_X(current_location) AS lat')
        ])->first();



        return view('front.orders.show' , [
            'order' => $order,
            'delivery' => $delivery
        ]);
    }
}
