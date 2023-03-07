<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str ;
class Store extends Model
{
    use HasFactory , Notifiable;
    protected $fillable = [
        'name' , 'description' , 'logo_image' , 'cover_image' , 'status'
    ];
    public static function booting(){
        static::creating(function(Store   $store){
            $store->slug = str::slug($store->name);
        });
    }


}
