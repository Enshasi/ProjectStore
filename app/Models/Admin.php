<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User
{
    use HasApiTokens, HasFactory  , Notifiable;
    protected $fillable = ['username' , 'password' , 'name'  , 'phone_number' , 'status' , 'super_admin' ,'email'];

}
