@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'products Create')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">products</li>
@endsection
@section('content')

<form method="post" action="{{ route('dashboard.products.update' , $product->id)}}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    @include('dashboard.products.__form')
    <div class="form-group">
        <button type="submit" class='btn btn-success'>Edit</button>
    </div>
</form>

@endsection
