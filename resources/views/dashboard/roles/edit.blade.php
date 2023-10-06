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


        <div class="card-header text-left bg-transparent">
            <button type="submit"
            class="btn btn-primary btn-md m-1"><i class="i-Add-User text-black mr-2"></i>
            Add role</button>
        </div>    </div>
</form>

@endsection
