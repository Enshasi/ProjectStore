<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order_item;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_item = Order_item::with(['product:id,name' , 'order'])->get();
        return $order_item ;
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
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'product_name' => 'nullable|string',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'options' => 'nullable'
       ]);
         $order_item = Order_item::create($request->all());
            return [
                'message' => 'Order item created successfully',
                'order_item' => $order_item
            ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderItem = Order_item::with(['product:id,name' , 'order'])->findOrFail($id);
        return $orderItem ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order_item = Order_item::findOrFail($id);
        $request->validate([
            'order_id' => 'sometimes|required|integer|exists:orders,id',
            'product_id' => 'sometimes|required|integer|exists:products,id',
            'product_name' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:1',
            'quantity' => 'sometimes|required|numeric|min:1',
            'options' => 'nullable'
       ]);
        $order_item->update($request->all());
        return [
            'message' => 'Order item updated successfully',
            'order_item' => $order_item
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
        Order_item::destroy($id);

        return [
            'message' => 'Order item deleted successfully',

        ];
    }
}
