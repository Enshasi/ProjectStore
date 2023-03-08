@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'Roles Create')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Roles</li>
@endsection
@section('content')

<form method="post" action="{{ route('dashboard.roles.update' , $role->id)}}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    @include('dashboard.roles.__form')
    <div class="form-group">
        <button type="submit" class='btn btn-success'>Edit</button>
    </div>
</form>

@endsection
