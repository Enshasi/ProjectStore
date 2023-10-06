<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Concerns\HasRoles;
class Admin extends User
{
    use HasApiTokens, HasFactory  , Notifiable , HasRoles;
    protected $fillable = ['username' , 'password' , 'name'  , 'phone_number' , 'status' , 'super_admin' ,'email'];
    public function profile(){
        return $this->hasOne(Profile::class , 'admin_id' , 'id')->withDefault();
    }
}
