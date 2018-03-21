@extends('admin.layout.master1')

@section('main-body')
    <!-- BEGIN .app-main -->
    <div class="app-main">
        <!-- BEGIN .main-heading -->
        <header class="main-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="page-icon">
                            <i class="icon-border_outer"></i>
                        </div>
                        <div class="page-title">
                            <h5>Promotional Banner</h5>
                            <h6 class="sub-heading">Welcome to Merotheatre Admin</h6>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="right-actions">
                            @include('admin.last-login-time')
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END: .main-heading -->
        <!-- BEGIN .main-content -->
        <div class="main-content">

            <!-- Row start -->
            <div class="row gutters">
                <div class=" col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header artist-header"><a href="{{url('admin/content-management/promotional-banner/create')}}"> Add New Promotional Banner</a></div>
                        <div class="card-body">
                            <div class="table-responsive">
        <table class="table m-0 table-bordered common-table">
                <thead>
                <th>SN</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Links</th>
                <th>Created On</th>
                <th>Action</th>
                </thead>

                <tbody>
                @if(isset($data) && $data->count() > 0)
                    @php $i=1 @endphp 
                    @foreach($data as $dat)
                        <tr>
                            <td>{{$i}}</td>
                            <th>{{$dat->banner_name}}</th>
                            <td><img width="50" height="30" src="{{asset('promotional-banner/'.$dat->image)}}" alt=""></td>
                            <td>{!! $dat->description !!}</td>
                            <td>{{$dat->link}}</td>
                            <td>{{date('M d, Y', strtotime($dat->created_at))}}</td>
                            <td>


<a href="{{url('admin/content-management/promotional-banner/'.$dat->id.'/edit')}}" class="table-content-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="icon-edit2"></i>Edit
                                                </a>
                                                <a href="#" class="table-content-delete delete-banner" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-id="{{$dat->id}}">
                                                    <i class="icon-delete2"></i>Delete
                                                </a>
                            </td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No Any Data Found !</td>
                    </tr>
                @endif
                </tbody>
            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- END: .main-content -->
    </div>
    <!-- END: .app-main -->
@stop
@section('scripts')
    <script>
        $('.delete-banner').on('click', function (e) {
            e.preventDefault();
            var Id = $(this).data('id');
            alertify.confirm("Delete this banner ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/content-management/promotional-banner/delete?Id=' + Id,
                        type: 'get',
                        success: function (data) {
                            if (data == 'true') {
                                window.location.reload();
                            } else {
                                alertify.alert("Oops ! something went wrong. Please try again.");
                            }
                        }, error: function (data) {

                        }
                    });
                },
                function () {

                });
        });
    </script>
@stop
