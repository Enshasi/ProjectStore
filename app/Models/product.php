<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str ;
class product extends Model
{
    use HasFactory;
    protected $fillable = ['name',
    'image' , 'rating' , 'status', 'description','slug' , 'category_id' , 'store_id' , 'price' , 'compare_price'];
    //Api Hidden Column in Response Json
    protected $hidden = [
        'created_at'  ,'updated_at','deleted_at' , 'image'
    ];
    protected $appends  = ['image_url'];//Accessors image in Response Json
    public static function booted(){
        static::addGlobalScope('store', function(Builder $builder) {
            $user = Auth::user() ;
            if($user && $user->store_id){

                $builder->where('store_id' , '=',$user->store_id);
            }

        });
        //Api Add Slug in Creating Product
        static::creating(function(product $product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function category(){
        return $this->belongsTo(Category::class , 'category_id'   , 'id')->withDefault([
            'name' => 'annonymus'
        ]);
    }

    public function store(){
        return $this->belongsTo(Store::class , 'store_id'   , 'id')->withDefault([
            'name' => 'annonymus'
        ]);;
    }
    public function tags(){
        return $this->belongsToMany(tag::class );
       // return $this->belongsToMany(
       // tag::class ,   //Related Model
       // 'product_tag' ,  //pivot Table
       // 'product_id',    //Fk IN table for the current Model
       // 'tag_id',        //Fk IN table for the related Model
       // 'id' ,          //pk current model
        // 'id' );         //pk Related model
    }
    public function scopeActive(Builder $builder){
        $builder->where('status', 'active');
    }

    //Accessors
    public function getImageUrlAttribute(){
       if(!$this->image){
           return "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSW3lHsd5UxRkPizImJu-ObyALM_aUCOfKq1PaEDj4UYkwE9VZCzvzYK3DP3G0O42QR_po&usqp=CAU";
       }
       if(Str::startsWith($this->image,['https://' , 'http://'])){
            return $this->image ;
       }

       return asset('assets/products/'.$this->image);

    }

    public function getSalePercentAttribute(){
        if(!$this->compare_price){
            return 0;
        }
        return number_format(100 - (100 * $this->price / $this->compare_price) , 2) ;
    }
    //api
    public function scopeFilter(Builder  $builder , $filter){
        $options = array_merge([
            'store_id' => null ,
            'category_id' => null,
            'tag_id' => null,
            'status' =>'active',
        ] , $filter);
        $builder->when($options['status'] , function($builder , $status){
           return  $builder->where('status' , $status);
        });
        $builder->when($options['store_id'] , function($builder , $value){
            $builder->where('store_id' , $value);
        });
        $builder->when($options['category_id'] , function($builder , $value){
            $builder->where('category_id' , $value);
        });
        $builder->when($options['tag_id'] , function($builder , $value){
            //1 -  $builder->whereRaw('id IN (SELECT product_id FROM product_tag WHERE tag_id = ?)' , $value);
            //2 -  $builder->whereRaw('EXISTS(SELECT 1 FROM product_tag WHERE tag_id = ? AND product_id = products.id)' , $value);
            $builder->whereExists(function($query) use ($value){
                $query->select(1)
                ->from('product_tag')
                ->whereRaw('product_id = products.id')
                ->where('tag_id' , $value);
            });
            //3 -  $builder->whereHas('tags' , function($builder) use($value){
            //     $builder->whereIn('id' , $value);
            // });

        });

    }
}
