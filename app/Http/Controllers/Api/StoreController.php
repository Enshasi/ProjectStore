<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::paginate();
        return $store ;
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
            'name'  => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:255',
            'logo_image' => 'nullable|image',
            'cover_image' => 'nullable|image',
            'status' => 'in:active,inactive'
        ]);
        Store::create($request->all());
        return Response::json([
            'message' => 'Created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
       return  $store ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store )
    {
        $request->validate([
            'name'  => 'sometimes|required|string|min:3|max:255',
            'description' => 'nullable|string|max:255',
            'logo_image' => 'nullable|image',
            'cover_image' => 'nullable|image',
            'status' => 'in:active,inactive'
        ]);

        $store->update($request->all());
        return Response::json([
            'message' => 'Updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return Response::json([

            'message' => 'Deleted successfully',

        ]);
    }
}
