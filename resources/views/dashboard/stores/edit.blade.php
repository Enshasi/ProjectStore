@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'Categories Create')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')

<form method="post" action="{{ route('dashboard.categories.update' , $categories->id)}}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    @include('dashboard.categories.__form')
    <div class="form-group">
        <button type="submit" class='btn btn-success'>Edit</button>
    </div>
</form>

@endsection
