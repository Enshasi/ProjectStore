<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderAddrese;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;
class OrderAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderAddress = OrderAddrese::with('order')->select(
            [
                'id',
                'order_id',
                'first_name',
                'last_name',
                'email',
                'phone_number',
                'street_address',
                'city',
                'postal_code',

            ]
        )->get();

        return $orderAddress ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , OrderAddrese $orderAddrese)
    {
        $request->validate([
            'first_name' => 'required|string|min:4|max:255',
            'last_name' => 'required|string|min:4|max:255',
            'email' => 'nullable',
            'phone_number' => 'required|string',
            'street_address' => 'nullable',
            'city' => 'required',
            'postal_code' => 'nullable',
            'order_id' => 'required|integer|exists:orders,id',
            'type' => 'required|in:billing,shipping'

        ]);
        $orderAddrese = OrderAddrese::create($request->all());
        return [
            'message' => 'Order Address Created Successfully' ,
            'orderAdress' => $orderAddrese

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
        $orderAddrese = OrderAddrese::with('order')->select([
            'id',
            'order_id',
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'street_address',
            'city',
            'postal_code',

        ])->findOrfail($id);
        return $orderAddrese;
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
        $request->validate([
            'first_name' => 'sometimes|required|string|min:4|max:255',
            'last_name' => 'sometimes|required|string|min:4|max:255',
            'email' => 'nullable',
            'phone_number' => 'sometimes|required|string',
            'street_address' => 'nullable',
            'city' => 'sometimes|required',
            'postal_code' => 'nullable',
            'order_id' => 'sometimes|required|integer|exists:orders,id',
            'type' => 'sometimes|required|in:billing,shipping',
            'order_id' => 'sometimes|required|integer|exists:orders,id',
            'country' => 'nullable'
        ]);
        $orderAddrese = OrderAddrese::findOrfail($id);
        $orderAddrese->update($request->all());
        return [
            'message' => 'Order Address Updated Successfully' ,
            'orderAdress' => $orderAddrese

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
        OrderAddrese::destroy($id);
        return [
            'message' => 'Order Address deleted Successfully' ,

        ];
    }
}
