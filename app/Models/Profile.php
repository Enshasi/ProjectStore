<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    protected $fillable = [
            'user_id',
            'first_name',
            'last_name',
        	'birthday',
            'gender',
            'street_address',
            'city',
            'state',
            'postal_code',
            'country',
            'locale',
    ];
    public function profile(){
        return $this->belongsTo(User::class , 'user_id' , 'id')->withDefault();
    }
}
