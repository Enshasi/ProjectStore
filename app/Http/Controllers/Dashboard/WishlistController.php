<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
    }
    public function store(Request $request)
    {

        wishlist::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,

        ]);
        toastr()->success('Product Added to Wishlist');
        return redirect()->back();
    }
    public function destroy($id)
    {

        $wishlist = wishlist::find($id);
        $wishlist->delete();


    }
}
