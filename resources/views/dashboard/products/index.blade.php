<x-app-layout>
    @section('title', 'Products')
    @section('content')


    {{-- @can('create' , 'App\Models\Category') --}}


<div class="col-md-12 mb-4">
    <div class="card text-left">
        <div class="card-header text-right bg-transparent">
            <a  href="{{route('dashboard.products.create')}}"
            class="btn btn-primary btn-md m-1"><i class="i-Add-User text-black mr-2"></i>
            Add Product</a>
        </div>
        <!-- begin::modal -->
{{-- @endcan --}}



        <!-- end::modal -->

<div class="card-body">

    <div class="table-responsive">
        <div id="ul-contact-list_wrapper"
            class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="ul-contact-list_length">
                        </label></div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div id="ul-contact-list_filter" class="dataTables_filter">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="ul-contact-list" class="display table dataTable no-footer" style="width:100%"
                        role="grid" aria-describedby="ul-contact-list_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label="Name: activate to sort column descending"
                                    style="width: 36.5125px;">#</th>
                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Email: activate to sort column ascending"
                                    style="width: 133.962px;">Name</th>
                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Phone: activate to sort column ascending"
                                    style="width: 79.2625px;">Store </th>
                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Role: activate to sort column ascending"
                                    style="width: 72.625px;">Category</th>
                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Age: activate to sort column ascending"
                                    style="width: 25.425px;">Image</th>

                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending"
                                    style="width: 41.1625px;">Price</th>

                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending"
                                    style="width: 41.1625px;">Quantity</th>

                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending"
                                    style="width: 41.1625px;">Status</th>

                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending"
                                    style="width: 41.1625px;">Action</th>
                            </tr>
                        </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{$loop->index  + 1}}</td>
                            <td>{{$product->name}} </td>
                            <td>{{$product->store->name}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>
                                <img src="{{asset($product->image)}}" width="100px" height="100px" alt="">
                            </td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->status}}</td>
                            <td>
                                {{-- @can('update', $category) --}}
                                <a href="{{route('dashboard.products.edit' , $product->id)}}" class="ul-link-action text-success"
                                    data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="Edit">
                                    <i class="i-Edit"></i>
                                </a>
                                {{-- @endcan --}}
                                {{-- @can('delete', $product) --}}
                                <form id="myForm"  method="post" action="{{route('dashboard.products.destroy' , $product->id)}}" class='d-inline'>
                                    @csrf
                                    @method('DELETE')
                                    <a  href="javascript:void(0);" onclick="document.getElementById('myForm').submit();"

                                    class="ul-link-action  mr-1 border-0 background-transparent">

                                    <i class="i-Eraser-2"></i>
                                </a>
                                </form>
                                {{-- @endcan --}}
                                </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No Data</td>
                        </tr>
                        @endforelse
                    </tbody>
                    </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

</div>
    </div>
</div>
    @endsection

</x-dashboard>
