@extends('layouts.dashboard')
@section('title' , 'dashboard')
{{-- @section('titlePage' , 'dashboard') --}}
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">dashboard</li>
@endsection
@section('content')
<div class="row">
    {{-- <div class="col-lg-12 d-flex justify-content-between">


      <div class="col-lg-2   card card-primary card-outline">
        <div class="card-body">
          <h5 class="card-title">Products</h5>

          <p class="card-text">
               # {{App\Models\Product::count()}}
          </p>

        </div>
      </div><!-- /.card -->
      <div class="col-lg-2   card card-primary card-outline">
        <div class="card-body">
          <h5 class="card-title">Categories</h5>

          <p class="card-text">
               # {{App\Models\Category::count()}}
          </p>

        </div>
      </div><!-- /.card -->
      <div class="col-lg-2   card card-primary card-outline">
        <div class="card-body">
          <h5 class="card-title">Orders</h5>

          <p class="card-text">
               # {{App\Models\Order::count()}}
          </p>

        </div>
      </div><!-- /.card -->
      <div class="col-lg-2   card card-primary card-outline">
        <div class="card-body">
          <h5 class="card-title">Stores</h5>

          <p class="card-text">
               # {{App\Models\Store::count()}}
          </p>

        </div>
      </div><!-- /.card -->

    </div> --}}

  </div>
  {{-- d-flex justify-content-between align-items-center --}}
  <div class="row">
    {{-- <div class="col-md-6 col-lg-6 col-xl-7 over">
        <div class="card">
            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">Payments</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div style="width:100%;">
                    {!! $chartjs2->render() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-7 ">
        <div class="card">
            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">Orders</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div style="width:75%;">
                    {!! $chartjs->render() !!}
                </div>
            </div>
        </div>
    </div> --}}


    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @endsection


{{-- @push('scripts')
@endpush --}}
