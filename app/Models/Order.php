<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;
    protected  $fillable = [
        'store_id',
        'user_id',
        'payment_method',
        'number' ,
        'status',
        'payment_status',
    ];

    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Customer'
        ]);
    }
    public function products(){
        return $this->belongsToMany(product::class ,
        'order_items' ,
        'order_id' ,
        'product_id' ,
         'id' , 'id')
         ->using(Order_item::class)->withPivot([
            'product_name' , 'price' , 'quantity' , 'options'
         ]);
    }
    public function addresses(){
        return $this->hasMany(OrderAddrese::class , 'order_id' , 'id');
    }
    public function billingAddress(){
        return $this->hasOne(OrderAddrese::class , 'order_id' , 'id')
            ->where('type', '=', 'billing');
    }
    public function shippingAddress(){
        return $this->hasOne(OrderAddrese::class , 'order_id' , 'id')
                ->where('type', '=', 'shipping');
    }
    //ob server
    public static function booted()
    {
        static::creating(function (Order $order){
            //2022001 , 2022001
            $order->number = Order::getNextOrderNumber() ;
        });
    }
    public static function getNextOrderNumber(){
        $year  = Carbon::now()->year ;
        $number = Order::whereYear('created_at' , $year)->max('number');
        if($number){
            return $number +1;
        }
        return $year.'0001' ;
    }
}
