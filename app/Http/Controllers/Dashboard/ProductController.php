<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProducts;
use App\Models\Category;
use App\Models\product;
use App\Models\Store;
use App\Models\tag;
use Illuminate\Support\Str ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        // $this->authorize('view-any' , product::class); // لو مش ملتزم في التسمية
        // $this->authorize('view'); //policy
        //eger Loading(with)
        $products = Product::with(['category','store'])->paginate();
        return view('dashboard.products.index' , compact('products'));
    }


    public function create()
    {
        // $this->authorize('create' , product::class);
        return view('dashboard.products.create' , [
            'stores' => Store::all(),
            'categories' => Category::all(),
            'product' => new Product(),
            'tags' => new tag()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->authorize('create' , product::class);
        $request->validate([

        ]);
        $data = $request->except('image');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $path = time().'.'.$image->getClientOriginalExtension();
            $images = $image->move("uploads/products",$path);
            $data['image']=$images;
        }
        $result = Product::create($data);

        product::TagsGen($request  , $result);
        toastr()->success('Successfully deleted product');
        return redirect()->route('dashboard.products.index');
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        // $this->authorize('view' ,$product);
        return view('dashboard.products.show' , compact('product'));
    }

    public function edit(product $product)
    {
        // $this->authorize('update' ,$product);
        // $tags = tag::all() ;
        $stores = Store::all();
        $categories = Category::all();
        $tags = implode(', ', $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit' , compact('product' , 'stores' , 'tags' , 'categories'));
    }


    public function update(Request $request, product $product)
    {

        $product->update($request->except('tags'));
        product::TagsGen($request  , $product);

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
        File::delete(public_path('uploads/products/'.$product->image));
        $product->delete();
        // $this->authorize('delete' ,$product);
        toastr()->error('Successfully deleted product');
        return redirect()->route('dashboard.products.index');
    }

}
