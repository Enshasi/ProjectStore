<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:sanctum')->except('index'  , 'show');
    }
    public function index(Request   $request)
    {
        //query => get
        return product::
        filter($request->query())
        // ->with(['category' , 'store' ,'tags'])
        ->with(['category:id,name' , 'store:id,name' ,'tags:id,name'])
        ->paginate(); //$request->query() Or $request->all()
        // return  ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'description'=>'null|string|max:255',
            'category_id' =>'required|exists:categories,id',
            'status' =>'in:active,inactive',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',//greater than

        ]);
        $product = Product::create($request->all());
        // return $product; //or
        return Response::json($product , 201);
    }


    public function show(product $product)
    {
        // return new ProductResource($product);
        return $product->load('category:name,id' , 'store:id,name' ,'tags:id,name' );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,product $product)
    {
        $request->validate([
            'name' =>'sometimes|required|string|max:255', // sometimes if any edit
            'description'=>'nullable|string|max:255',
            'category_id' =>'sometimes|required|exists:categories,id',
            'status' =>'in:active,inactive',
            'price' => 'sometimes|required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',//greater than

        ]);
        $product->update($request->all());
        // return $product; //or
        return Response::json($product , 201);
    }


    public function destroy($id)
    {
        product::destroy($id);
        return [
            'message' => 'Product deleted successfully',
        ];
    }
}
