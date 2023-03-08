@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'roles Create')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">roles</li>
@endsection
@section('content')

<form method="post" action="{{ route('dashboard.roles.store')}}" enctype="multipart/form-data">
    @csrf
    @include('dashboard.roles.__form')

    <div class="form-group">
        <button type="submit" class='btn btn-success'>Create</button>
    </div>
</form>

@endsection
