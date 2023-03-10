<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProducts;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class ImportProductsController extends Controller
{


    public function create()
    {
        return view('dashboard.products.import');
    }
    public function store(Request $request){
        // dd($request->post('count'));
        $jop = new ImportProducts($request->post('count'));
        $jop->onQueue('import')->delay(now()->addSeconds(5)); // any name queue
       // $jop->onQueue('import'); // any name queue.
        $this->dispatch($jop);
        toastr()->success('العملية قيد التنفيذ');
        return redirect()->back();
    }

}
