<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::
        with(['store:id,name' , 'products:id,name' , 'addresses:id,order_id,first_name,last_name'])->
        where('user_id', Auth::user()->id)->get();
        return $order ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|numeric|exists:stores,id',
            'user_id' => 'nullable|numeric|exists:users,id',
            'payment_method' => 'required|string',
            'status' => 'in:pending,processing,delivering ,completed , cancelled',
            'payment_status' => 'in:pending,paid,failed',
        ]);
        $order = Order::create($request->all());
        return [
            'message' => 'Order Created Successfully',
            'order' => $order,
        ];




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $order->load(['store:id,name' , 'products:id,name' , 'addresses:id,order_id,first_name,last_name']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Order $order)
    {
        $request->validate([
            'store_id' => 'sometimes|required|numeric|exists:stores,id',
            'user_id' => 'nullable|numeric|exists:users,id',
            'payment_method' => 'sometimes|required|string',
            'status' => 'in:pending,processing,delivering ,completed , cancelled',
            'payment_status' => 'in:pending,paid,failed',

        ]);
        $order->update($request->all());
        return [
            'message' => 'Order Updated Successfully',
            'order' => $order,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);
        return [
            'message' => 'Order Deleted Successfully',
        ];
    }
}
