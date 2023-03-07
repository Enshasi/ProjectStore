<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cart = Cart::with(['user:id,name' ,  'product:id,name'])->get();
        return $cart;
    }

    public function store(Request $request , Cart $cart)
    {
        $request->validate([
            'product_id' =>['nullable' ,'int' ,'exists:products,id'],
            'quantity' =>['nullable' ,'int' ,'min:1'],
        ]);
        $cart->create([
            'quantity' => $request->post('quantity'),
            'cookie_id' => $request->post('cookie_id' , $request->userAgent()),
            'user_id' => Auth::id(),
            'product_id' => $request->post('product_id'),
            ]
        );
        return response()->json([
            'message' => 'Item Added successfully'
        ] , 201);
    }

    public function show(Cart $cart)
    {
        return $cart->load(['user' ,  'product']);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id )
    {

        $cart = Cart::findOrFail($id)->update(
            [
                'quantity' => $request->post('quantity'),
                'cookie_id' => $request->post('cookie_id' , $request->userAgent()),
                'user_id' => Auth::id(),
                'product_id' => $request->post('product_id'),
                ]
        );
        return response()->json([
            'message' => 'Item Updated successfully'
        ] , 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id){
        $cart = Cart::findOrFail($id);
        $user = Auth::user();
        if($user){
            $cart->where('user_id' , $user->id)->delete();
        }
        return response()->json([
            'message' => 'Cart Empty successfully'
        ] , 201);
    }
}
