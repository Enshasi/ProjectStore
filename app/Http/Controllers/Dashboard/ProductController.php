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
        // $this->authorize('view-any' , product::class); // لو مش ملتزم في التسمية
        $this->authorize('view'); //policy
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
        $this->authorize('create' , product::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create' , product::class);


    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('view' ,$product);
        return view('dashboard.products.show' , compact('product'));
    }

    public function edit(product $product)
    {
        $this->authorize('update' ,$product);
        // $tags = tag::all() ;
        $stores = Store::all();
        $categories = Category::all();
        $tags = implode(', ', $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit' , compact('product' , 'stores' , 'tags' , 'categories'));
    }


    public function update(Request $request, product $product)
    {
        $this->authorize('update' ,$product);

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
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete' ,$product);
        toastr()->success('Successfully deleted product');
        return redirect()->route('dashboard.products.index');
    }
}
