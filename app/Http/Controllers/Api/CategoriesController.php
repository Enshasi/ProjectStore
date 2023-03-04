<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('parent:id,name')->paginate(4);
        return $categories ;
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
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|numeric|exists:categories,id',
            'status' => 'in:active,archived',
         ]);
        $category = Category::create($request->all());
        return $category ;
    }

    public function show(Category $category)
    {
        return $category->load('parent') ;
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'sometimes|required|string|min:3|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|numeric|exists:categories,id',
            'status' => 'in:active,archived',
        ]);
        $category = $category->update($request->all());
        return $category ;
    }


    public function destroy($id)
    {
        Category::destroy($id);
        return [
            'message' => 'category deleted successfully',

        ];

    }
}
