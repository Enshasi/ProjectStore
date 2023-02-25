@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'Categories')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')

<div>
    <a href="{{route('dashboard.categories.create')}}" class="btn btn-success mb-2 mr-2">Create</a>
    <a href="{{route('dashboard.categories.trash')}}" class="btn btn-info mb-2">Trash</a>
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
        <th scope="col">Description</th>
        <th scope="col">Parent Id</th>
        <th scope="col">Image</th>
        <th scope="col">Status</th>
        <th scope="col">Count Product</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>

      </tr>
    </thead>
    <tbody>

        @forelse ($categories as $category)
        <tr>
            <th scope="row">{{$category->id}}</th>
            <td >
                <a href="{{route('dashboard.categories.show' , $category->id)}}">{{$category->name}}</a>
                </td>
            <td>{{$category->description}}</td>
            {{-- <td>{{$category->parent_name}}</td> --}}
            <td>{{$category->parent->name}}</td>
            <td>
                <img width="100" height="100" src="{{asset('uploads/categories/'.$category->image)}}" alt="">
            </td>
            <td>{{$category->status}}</td>
            <td>{{$category->product()->count()}}</td>
            <td>{{$category->created_at}}</td>
            <td>
                <a class='btn btn-success' href="{{route('dashboard.categories.edit' , $category->id)}}">
                    <i class='fas fa-edit'></i>
                </a>
                <form class='d-inline' action="{{route('dashboard.categories.destroy' , $category->id)}}" method="post">
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
        {{$categories->withQueryString()->links()}}


    </div>

@endsection

