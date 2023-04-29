@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'Categories Create')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Products</li>
@endsection
@section('content')

<form method="post" action="{{ route('dashboard.products.store')}}" enctype="multipart/form-data">
    @csrf
    @include('dashboard.products.__form')

    <div class="form-group">
        <button type="submit" class='btn btn-success'>Create</button>
    </div>
</form>

@endsection
