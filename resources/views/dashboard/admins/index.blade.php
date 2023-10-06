<x-app-layout>
    @section('title', 'admins')
    @section('content')


    {{-- @can('create' , 'App\Models\Category') --}}


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
                        admin="grid" aria-describedby="ul-contact-list_info">
                        <thead>
                            <tr admin="row">
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
                                    style="width: 41.1625px;">Status</th>
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
                        @forelse ($admins as $admin)
                        <tr>
                            <td>{{$admin->id}}</td>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->email}} </td>
                            <td>{{$admin->status}} </td>
                            <td>{{$admin->created_at->diffForHumans()}}</td>

                            <td>

                                <a href="{{route('dashboard.admins.edit' , $admin->id)}}" class="ul-link-action text-success"
                                    data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="Edit">
                                    <i class="i-Edit"></i>
                                </a>

                                {{-- @can('delete', $admin) --}}
                                <form id="myForm"  method="post" action="{{route('dashboard.admins.destroy' , $admin->id)}}" class='d-inline'>
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
