<?php

namespace App\Models;

use App\Observers\CartObServer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str ;
class Cart extends Model
{
    use HasFactory;
    public $incrementing  = false ;
    protected $fillable = [
        'cookie_id','user_id' , 'product_id' , 'quantity' ,'options'
    ];
    //Ob Servers => Action in Model
    //Or
    //Event 1-creating -> created , updating->created
    //deleting -> deleted

    //Listen
    public static function booted(){
        //Single Method
        // static::creating(function (Cart $cart){
        //     $cart->id = Str::uuid(); //Random Key
        // });
        //More Method
        static::observe(CartObServer::class);
        // static::addGlobalScope('cookie_id' , function(Builder $builder){
        //     $builder->where('cookie_id', $this->cookie_id());
        // });
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous',
        ]);

    }
    public function product(){
        return $this->belongsTo(product::class);
    }

    public  function cookieId(){
        $cookie_id = Cookie::get('cart_id');
        if(!$cookie_id){
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }

        return $cookie_id ;
    }
}
