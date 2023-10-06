
<x-app-layout>
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
        <button type="submit" class='btn btn-primary btn-md m-1'>Edit</button>
    </div>
</form>

@endsection
</x-app-layout>
