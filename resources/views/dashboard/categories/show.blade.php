@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , $category->name)
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">{{$category->name}}</li>
@endsection
@section('content')

<div>
    <a href="{{route('dashboard.categories.index')}}" class="btn btn-success mb-2 mr-2">Back</a>

</div>

<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Store</th>
        <th scope="col">Status</th>
        <th scope="col">Created At</th>
        <th scope="col">Action</th>


      </tr>
    </thead>
    <tbody>
        @php
            $products = $category->product()->with('store')->paginate(2) ;
        @endphp
        @forelse ( $products as $product)
        <tr>
            <th scope="row">{{$product->id}}</th>
            <td>{{$product->name}}</td>
            <td>{{$product->store->name}}</td>
            <td>{{$product->status}}</td>
            <td>{{$product->created_at}}</td>
            <td>
                <a class='btn btn-success' href="{{route('dashboard.categories.edit' , $product->id)}}">
                    <i class='fas fa-edit'></i>
                </a>
            </td>

        </tr>
        @empty
             <td>None Data</td>


        @endforelse


    </tbody>
</table>
    {{$products->links()}}
        <div>



    </div>

@endsection

