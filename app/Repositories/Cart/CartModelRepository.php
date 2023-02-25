<?php
namespace App\Repositories\Cart ;

use App\Models\Cart;
use App\Models\product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str ;
class CartModelRepository implements CartRepository {
    protected $items ;
    public function __construct(){
        $this->items = collect([]);
    }

    public function get(): Collection{
        // return Cart::with('product')->where('cookie_id', "=", $this->cookieId())->get();
        if(!$this->items->count()){
            $this->items = Cart::with('product')->where('cookie_id', "=", $this->cookieId())->get();
        }
        return $this->items;
    }
    public function add(product $product  , $quantity = 1){
        $item = Cart::where('product_id' , "=",$product->id)
        ->where('cookie_id', "=", $this->cookieId())->first();
        if(!$item){

            $cart =  Cart::create([
                'quantity' => $quantity,
                'cookie_id' => $this->cookieId(),
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
            $this->items->push($cart);
            return $cart;
        }
        return $item->increment('quantity', $quantity);
    }
    public function update($id , $quantity){

        Cart::where('id' , $id)
            ->where('cookie_id' , "=",$this->cookieId())->update([
            'quantity' => $quantity
        ]);
    }
    public function delete($id){
        Cart::where('id' , "=",$id)
            ->where('cookie_id' , "=" , $this->cookieId())->delete();
    }
    public function empty(){
        Cart::where('cookie_id' , "=", $this->cookieId())->delete();
    }
    public function total(): float{
        //(float) لو ما مكان عندي قيمة يعني فاضية يعتبرها null
        // return (float) Cart::where('cookie_id' , "=" , $this->cookieId())
        // ->join('products' , 'products.id' , '=' , 'carts.product_id')
        // ->selectRaw('SUM(products.price * carts.quantity) as total')
        // ->value('total');
        return $this->get()->sum(function($item){
            return $item->quantity * $item->product->price ;
        });
    }

    protected function cookieId(){
        $cookie_id = Cookie::get('cart_id');
        if(!$cookie_id){
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }

        return $cookie_id ;
    }


}
