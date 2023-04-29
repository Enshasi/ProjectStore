<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    // public function __construct(){
    //     $this->authorizeResource(Category::class , 'category');
    // }
    public function index()
    {
        // Gate::authorize('categories.view');
        $request  = request();
        $query = Category::with(['parent'])
        // leftJoin('categories as parents' , 'parents.id' , "=" ,'categories.parent_id' )
        // ->select('categories.*' , 'parents.name as parent_name')
        ->filter($request->query());
        $categories = $query
        // ->withCount('products as products_number') //Count products
        // ->withCount(['products as product_number' => function($query){
            // $query->where('products' , "=" ,'active')
       // }]) //Count status
        ->paginate(3);

        return view('dashboard.categories.index' , compact('categories' ));
    }


    public function create()
    {
        // Gate::authorize('categories.create');

        $parents  = Category::all();
        $categories = new Category();
        return view('dashboard.categories.create' , compact('parents' , 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Gate::authorize('categories.create');
        $request->validate(Category::rolues());
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        $data = $request->except('image');
        $image_name = null;

        $data['image'] = $this->uploadeImage($request);
        $categories = Category::create($data);
        toastr()->success('Successfully created Category');
        return redirect()->route('dashboard.categories.index');
    }

    public function show(Category $category)
    {
        // Gate::authorize('categories.view');
        return view('dashboard.categories.show' , compact('category'));
    }

    public function edit($id)
    {
        // Gate::authorize('categories.update');

        try{
            $categories = Category::findOrFail($id);
            $parents = Category::where('id', "<>", $id)->where(function ($query) use ($id) {
                $query->whereNull('parent_id')->OrWhere('parent_id', "<>", $id);
            })->get();

            return view('dashboard.categories.edit' , compact('categories', 'parents'));
        }catch(\Exception $e){

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Gate::authorize('categories.update');
        $request->validate(Category::rolues($id));
        $categories = Category::findOrFail($id);
        $data = $request->except('image');
        $image_name = $categories->image;

        if($request->hasFile('image')){

            $data['image'] = $this->uploadeImage($request , $categories) ;
            File::delete(public_path('uploads/categories/'.$categories->image));
        }

        $categories->update($data);
        toastr()->success('Successfully deleted Category');
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Gate::authorize('categories.delete');
        $categories = Category::findOrFail($id);
        $categories->delete();
        toastr()->error('Successfully deleted Category');
        return redirect()->route('dashboard.categories.index');
    }
       //create And Update Image
    protected function uploadeImage(Request $request){
        if(!$request->hasFile('image')){
            return ;
        }
        $image = $request->file('image');
        $image_name = rand().time().$image->getClientOriginalName();
        $image->move(public_path('uploads/categories/') , $image_name);

        return $image_name;
    }
    public function trash(){
        $categories = Category::onlyTrashed()->paginate(4);
        return view('dashboard.categories.Trash' , compact('categories'));
    }
    public function restore($id){
        $categories = Category::onlyTrashed()->findOrFail($id);
        $categories->restore();
        toastr()->success('Successfully Restore Category');
        return redirect()->route('dashboard.categories.index');
    }
    public function forceDelete($id){
        $categories = Category::onlyTrashed()->findOrFail($id);
        File::delete(public_path('uploads/categories/'.$categories->image));
        $categories->forceDelete();
        toastr()->error('Successfully Delete Category');
        return redirect()->route('dashboard.categories.index');
    }
}
