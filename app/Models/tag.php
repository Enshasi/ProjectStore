<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'slug' ];
    public  $timestamps = false;
    public function products(){
        // return $this->belongsToMany(
        //     product::class,  //related model
        //     'product_tag',  //pivot table
        //     'tag_id',       // Fk current Model
        //     'product_id',   // Fk related Model
        //     'id',           // pk current Model
        //     'id'            // Fk related Model
        // );
        return $this->belongsToMany(product::class);
    }
}
