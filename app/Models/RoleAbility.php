<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class RoleAbility extends Model
{
    use HasFactory;
    protected $fillable = ['role_id', 'ability', 'type'];
    public $timestamps = false;
}
