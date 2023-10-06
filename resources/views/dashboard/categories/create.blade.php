<x-app-layout>
@section('title' , 'dashboard')
@section('titlePage' , 'Categories Create')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection
@section('content')

<form method="post" action="{{ route('dashboard.categories.store')}}" enctype="multipart/form-data">
    @csrf
    @include('dashboard.categories.__form')

    <div class="form-group">
        <button type="submit" class='btn btn-success'>Create</button>
    </div>
</form>

@endsection
</x-app-layout>
