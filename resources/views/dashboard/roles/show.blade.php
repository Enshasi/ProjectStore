@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , $category->name)
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">{{$category->name}}</li>
@endsection
@section('content')

<div>
    <a href="{{route('dashboard.roles.index')}}" class="btn btn-success mb-2 mr-2">Back</a>

</div>

<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>

        <th scope="col">Created At</th>
        <th scope="col">Action</th>


      </tr>
    </thead>
    <tbody>

        @forelse ( $roles as $product)
        <tr>
            <th scope="row">{{$role->id}}</th>
            <td>{{$role->name}}</td>
           <td>{{$role->created_at}}</td>
            <td>
                <a class='btn btn-success' href="{{route('dashboard.roles.edit' , $role->id)}}">
                    <i class='fas fa-edit'></i>
                </a>
            </td>

        </tr>
        @empty
             <td>None Data</td>


        @endforelse


    </tbody>
</table>
    {{$roles->links()}}
        <div>



    </div>

@endsection

