@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'products')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">products</li>
@endsection
@section('content')
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="col-xl-6">
                    <a class="btn ripple btn-primary mt-3 tx-13 mr-3 mb-0"   href="{{route('dashboard.products.create')}}">Add Product</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1" data-page-length='50'>
                        <thead>
                        <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0"> Name </th>
                            <th class="border-bottom-0">Store </th>
                            <th class="border-bottom-0"> Category</th>
                            <th class="border-bottom-0"> Image</th>
                            <th class="border-bottom-0"> Price</th>
                            <th class="border-bottom-0"> Quantity</th>
                            <th class="border-bottom-0"> Status</th>
                            <th class="border-bottom-0"> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>{{$loop->index  + 1}}</td>
                                <td>{{$product->name}} </td>
                                <td>{{$product->store->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>
                                    <img src="{{asset('uploads/products/'.$product->image)}}" width="100px" height="100px" alt="">
                                </td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->status}}</td>
                                <td>

                                    <a class="modal-effect btn btn-sm btn-info"
                                       href="{{route('dashboard.products.edit',$product->id )}}" ><i class="fas fa-edit"></i></a>


                                    <form method='post' action="{{route('dashboard.products.destroy',$product->id )}}" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>

                            </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No Data</td>
                            </tr>
                            @endforelse
                        </tbody>
                        {{$products->withQueryString()->links()}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->




</div>
@endsection

