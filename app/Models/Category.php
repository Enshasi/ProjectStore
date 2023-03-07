<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str ;
class Category extends Model
{
    use HasFactory , SoftDeletes;
    //protected $table = "categories";
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'image',
        'slug',
        'status',
    ];
    protected $hidden  = [
        'created_at','updated_at' ,'delete_at','image'
    ];
    protected $appends = ['image_url'];
    public function product(){
        return $this->hasMany(product::class , 'category_id'   , 'id');
    }
    public function parent(){
        return $this->belongsTo(Category::class , 'parent_id' , 'id')
        ->withDefault([
            'name' => 'Primary Parent'
        ]);
    }
    public function child(){
        return $this->hasMany(Category::class , 'parent_id' , 'id');
    }

    public function scopeFilter(Builder $builder , $filter){
        $builder->when($filter['name'] ?? false ,function(Builder $builder , $value){
            $builder->where('categories.name',"LIKE", "%$value%") ;
        });
        $builder->when($filter['status'] ?? false ,function(Builder $builder , $value){
            $builder->where('categories.status', $value) ;
        });


    }
    public function scopeActive(Builder $builder){
        $builder->where('status', 'active');
    }
    public function getImageUrlAttribute(){
        if(!$this->image){
            return "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSW3lHsd5UxRkPizImJu-ObyALM_aUCOfKq1PaEDj4UYkwE9VZCzvzYK3DP3G0O42QR_po&usqp=CAU";

        }
        if(Str::startsWith($this->image , ['https://' , 'https://'])){
            return $this->image ;
        }
        return  asset('uploads/categories/'.$this->image);
    }
    public static function booted(){

        static::creating(function(Category $category){
            $category->slug = Str::slug($category->name);
        });
    }
    public static function rolues($id = 0 ){
        return [
            'name' => ['required' , 'string' , "min:5" , "max:255" , "unique:categories,name,$id",
            // function($attribute , $value , $fail){
            //     if(strtolower($value) == 'laravel'){
            //         return $fail('This is not a valid And Not Allowed');
            //     }
            // },
            // new Filter(['laravel'  , 'php' , 'html']),
            "filter:php,laravel,html",
        ],
            'parent_id' => ['nullable' , 'int' , 'exists:categories,id' ],
            'image'  => ['nullable' , 'image'],

        ];
    }

}
