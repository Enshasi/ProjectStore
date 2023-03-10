@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'Import Product Create')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Import Product</li>
@endsection
@section('content')

<form method="post" action="{{ route('dashboard.products.import') }}" >
    @csrf

    <div>

        <x-form.input lable="count Import Products " type="text" name="count"  class="form-control" />
    </div>
    <div class="form-group mt-3">
        <button type="submit" class='btn btn-success'>Import</button>
    </div>
</form>

@endsection
