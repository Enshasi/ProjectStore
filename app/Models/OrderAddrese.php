<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class OrderAddrese extends Model
{
    use HasFactory;
    public $timestamps = false ;

    public $table = 'order_addreses';
    protected $fillable = [
        'order_id', 'type', 'first_name', 'last_name', 'email', 'phone_number',
        'street_address', 'city', 'postal_code', 'state', 'country',
    ];
    public function getNameAttribute(){
            return $this->first_name . ' ' . $this->last_name ;
    }
    public function getCountryAttribute(){
            return Countries::getName($this->name) ;
    }
}
