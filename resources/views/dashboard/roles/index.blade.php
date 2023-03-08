@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'Roles')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Roles</li>
@endsection
@section('content')

<div>
    <a href="{{route('dashboard.roles.create')}}" class="btn btn-success mb-2 mr-2">Create</a>

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

        @forelse ($roles as $role)
        <tr>
            <th scope="row">{{$role->id}}</th>
            <td >
                {{$role->name}}
                </td>
            <td>{{$role->created_at}}</td>
            <td>
                <a class='btn btn-success' href="{{route('dashboard.roles.edit' , $role->id)}}">
                    <i class='fas fa-edit'></i>
                </a>
                <form class='d-inline' action="{{route('dashboard.roles.destroy' , $role->id)}}" method="post">
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
        {{$roles->withQueryString()->links()}}


    </div>

@endsection

