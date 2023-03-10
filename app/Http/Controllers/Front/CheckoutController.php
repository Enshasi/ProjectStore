<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreate;
use App\Exceptions\InvalidException;
use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\OrderAddrese;
use App\Models\OrderAddress;
// use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\ErrorHandler\Throwing;
use Throwable;
use Symfony\Component\Intl\Countries;
class CheckoutController extends Controller
{
    public function create(CartRepository  $cart){
        if($cart->get()->count() == 0){
            // throw new InvalidException('Cart is Empty');
            return redirect()->route('home');
        }
        return view('front.checkout' ,[
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    }
    public function store(Request $request ,CartRepository $cart){

        $request->validate([
                'addr.billing.first_name' => ['required' , 'string' ,'max:255'],
                'addr.billing.last_name' => ['required' , 'string' ,'max:255'],
                'addr.billing.email' => ['required' , 'string' , 'max:255'],
                'addr.billing.phone_number' => ['required' , 'string' , 'max:255'],
                'addr.billing.country' => ['required' , 'string' , 'max:255'],

        ],);

        // $items = $cart->get();//Collection

        $items = $cart->get()->groupBy('product.store_id')->all(); //return array //key => store_id //product => nameRelated
        DB::beginTransaction();
        try {

        foreach($items as $store_id => $cart_item){
            $order = Order::create([
            'store_id' => $store_id ,
            'user_id' => Auth::id(),
            'payment_method' => 'cod',
        ]);

        foreach($cart_item as $item){
            Order_item::create([
                'order_id' => $order->id ,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name ,
                'price' => $item->product->price,
                'quantity' => $item->quantity

            ]);
        }
        // dd($request->post('addr'));
        foreach($request->post('addr') as $type => $address){
            $address['type'] = $type ;

            $order->addresses()->create($address);
            /*OrderAddrese::create([
                'type'=> $type,
                'order_id' => $order->id,
                'first_name'=> $address['first_name'],
                'last_name'=> $address['last_name'],
                'email'=> $address['email'],
                'phone_number'=> $address['phone_number'],
                'street_address'=> $address['street_address'],
                'city'=> $address['city'],
                'postal_code'=> $address['postal_code'],
                'state'=> $address['state'],
                'country'=> $address['country'],

            ]);*/
        }

        }
        DB::commit();
        event(new OrderCreate($order));
        // $cart->empty();
        //Event Listener
        // event('order.create'); //Or

        return redirect()->back();
    }catch(Throwable $e){
        DB::rollBack();

    }

    }
}
