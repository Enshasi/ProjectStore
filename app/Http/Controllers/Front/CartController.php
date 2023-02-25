<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{

    protected $cart ;
    public function __construct(CartRepository $cart){
        $this->cart = $cart;
    }
    public function index(CartRepository $cart) //CartRepository in app service container
    {
    //    $repository = App::make('cart'); //App== Service Container

        // $items = $cart->get();
        return view('front.cart' , [
            'cart' => $cart
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request , CartRepository $cart )
    {
        $request->validate([
            'product_id' =>['required' ,'int' ,'exists:products,id'],
            'quantity' =>['nullable' ,'int' ,'min:1'],
        ]);
        $product = product::findOrFail($request->post('product_id'));
        // if($request->expectsJson()){
        //     return response()->json([
        //         'message' => 'Item Added successfully'
        //     ] , 201);
        // }
        $cart->add($product , $request->post('quantity'));
        toastr()->success('Successfully Add Cart ');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            // 'product_id' =>['required' ,'int' ,'exists:products,id'],
            'quantity' =>['required' ,'int' ,'min:1'],
        ]);
       // $product = product::findOrFail($request->post('product_id'));

        $this->cart->update($id , $request->post('quantity'));
        toastr()->success('Successfully Update Cart ');
        return redirect()->back();

    }


    public function destroy($id)
    {
        $this->cart->delete($id);
        toastr()->success('Successfully Delete Cart ');
        return redirect()->back();
    }
}
