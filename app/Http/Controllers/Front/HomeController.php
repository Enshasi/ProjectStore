<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        //Active Product
        $products = product::with(['category'])->active()->latest()->limit(8)->get();
        $categories = Category::with(['child'])->active()->limit(8)->get();

        return view('front.home' , compact('categories'  , 'products'));
    }
}
