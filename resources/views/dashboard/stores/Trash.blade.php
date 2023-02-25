@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'Categories')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
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
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col">Status</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>

      </tr>
    </thead>
    <tbody>

        @forelse ($categories as $category)
        <tr>
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->name}}</td>
            <td>{{$category->description}}</td>

            <td>
                <img width="100" height="100" src="{{asset('uploads/categories/'.$category->image)}}" alt="">
            </td>
            <td>{{$category->status}}</td>
            <td>{{$category->created_at}}</td>
            <td>
                <form class='d-inline' action="{{route('dashboard.categories.restore' , $category->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button class='btn btn-info'>
                        <i class='fas fa-receipt'></i>
                    </button>


                </form>

                <form class='d-inline' action="{{route('dashboard.categories.forceDelete' , $category->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button class='btn btn-danger'>
                        <i class='fas fa-trash-restore'></i>
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

