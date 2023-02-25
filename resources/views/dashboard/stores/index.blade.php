@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'stores')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">stores</li>
@endsection
@section('content')

<div>
    <a href="{{route('dashboard.stores.create')}}" class="btn btn-success mb-2 mr-2">Create</a>
    {{-- <a href="{{route('dashboard.stores.trash')}}" class="btn btn-info mb-2">Trash</a> --}}
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
        <th scope="col " width="30%">Description</th>
        <th scope="col">Slug</th>
        <th scope="col">logo Image</th>
        <th scope="col">Status</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>

      </tr>
    </thead>
    <tbody>

        @forelse ($stores as $store)
        <tr>
            <th scope="row">{{$store->id}}</th>
            <td>{{$store->name}}</td>
            <td>{{$store->description}}</td>
            <td>{{$store->slug}}</td>
            <td>
                <img width="100" height="100" src="{{asset('uploads/stores/'.$store->image)}}" alt="">
            </td>
            <td>{{$store->status}}</td>
            <td>{{$store->created_at}}</td>
            <td>
                <a class='btn btn-success' href="{{route('dashboard.stores.edit' , $store->id)}}">
                    <i class='fas fa-edit'></i>
                </a>
                <form class='d-inline' action="{{route('dashboard.stores.destroy' , $store->id)}}" method="post">
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
        {{$stores->withQueryString()->links()}}


    </div>

@endsection

