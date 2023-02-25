@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'products')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">products</li>
@endsection
@section('content')

<div>
    <a href="{{route('dashboard.products.create')}}" class="btn btn-success mb-2 mr-2">Create</a>
    {{-- <a href="{{route('dashboard.products.trash')}}" class="btn btn-info mb-2">Trash</a> --}}
</div>

<form action="{{URL::current()}}" method="get" class='d-flex'>
    <x-form.input name="name" :value="request('name')" />

    <select name="status" class="form-control form-select">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
    </select>
    <button type="submit" class='btn btn-success'>Search</button>
</form>
<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Store</th>
        <th scope="col">Category</th>
        <th scope="col">Status</th>
        <th scope="col">price</th>
        <th scope="col">Actions</th>

      </tr>
    </thead>
    <tbody>

        @forelse ($products as $product)
        <tr>
            <th scope="row">{{$product->id}}</th>
            <td>{{$product->name}}</td>
            <td>{{$product->store->name}}</td>
            <td>{{$product->category->name}}</td>

            <td>{{$product->status}}</td>
            <td>{{$product->price}}</td>
            <td>
                <a class='btn btn-success' href="{{route('dashboard.products.edit' , $product->id)}}">
                    <i class='fas fa-edit'></i>
                </a>
                <form class='d-inline' action="{{route('dashboard.products.destroy' , $product->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button class='btn btn-danger'>
                        <i class='fas fa-trash'></i>
                    </button>


                </form>
            </td>

        </tr>
        @empty
             <td>None Data</td>
        @endforelse


    </tbody>
</table>
        <div>
        {{$products->withQueryString()->links()}}


    </div>

@endsection

