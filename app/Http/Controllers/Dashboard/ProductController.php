<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use App\Models\Store;
use App\Models\tag;
use Illuminate\Support\Str ;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        //eger Loading(with)
        $products = Product::with(['category','store'])->paginate();
        return view('dashboard.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    public function edit(product $product)
    {
        // $tags = tag::all() ;
        $stores = Store::all();
        $categories = Category::all();
        $tags = implode(', ', $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit' , compact('product' , 'stores' , 'tags' , 'categories'));
    }


    public function update(Request $request, product $product)
    {
        // dd($request->post('tags'));  //string json
        $product->update($request->except('tags'));
        // $tags = explode(',', $request->post('tags'));
        $tags = json_decode($request->post('tags')); //string json
        $saved_tags = Tag::all();
        $tag_id = [];
        foreach ($tags as $item){ //$item === Obj
            $slug = str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if(!$tag){
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_id[] = $tag->id;
        }
        $product->tags()->sync($tag_id);
        toastr()->success('Successfully created product');
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }
}
