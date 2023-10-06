<x-app-layout>
    @section('title', 'users')
    @section('content')


    {{-- @can('create' , 'App\Models\Category') --}}

    <div class="col-md-12 mb-4">
        <div class="card text-left">
            <div class="card-header text-right bg-transparent">
                <a  href="{{route('dashboard.users.create')}}"
                class="btn btn-primary btn-md m-1"><i class="i-Add-User text-black mr-2"></i>
                Add User</a>
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
                        user="grid" aria-describedby="ul-contact-list_info">
                        <thead>
                            <tr user="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label="Name: activate to sort column descending"
                                    style="width: 36.5125px;">#</th>
                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Email: activate to sort column ascending"
                                    style="width: 133.962px;">Name </th>

                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending"
                                    style="width: 41.1625px;">Email</th>
                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending"
                                    style="width: 41.1625px;">Store</th>
                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending"
                                    style="width: 41.1625px;">Created At</th>

                                <th class="sorting" tabindex="0" aria-controls="ul-contact-list"
                                    rowspan="1" colspan="1"
                                    aria-label="Action: activate to sort column ascending"
                                    style="width: 41.1625px;">Action</th>
                            </tr>
                        </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}} </td>
                            <td>{{$user->store->name}} </td>
                            <td>{{$user->created_at->diffForHumans()}}</td>

                            <td>

                                <a href="{{route('dashboard.users.edit' , $user->id)}}" class="ul-link-action text-success"
                                    data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="Edit">
                                    <i class="i-Edit"></i>
                                </a>

                                {{-- @can('delete', $user) --}}
                                <form id="myForm"  method="post" action="{{route('dashboard.users.destroy' , $user->id)}}" class='d-inline'>
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