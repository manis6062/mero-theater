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
                            <h5>Create Artist</h5>
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
                        <div class="card-header artist-header"><a href="{{url('admin/box-office/artist/create')}}"> Create Artist</a></div>
                        <div class="card-body">
                             @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                                </div>
                            @endif
                            <div class="table-responsive">
                                 <table class="table m-0 table-bordered common-table ticket-type-table">
            <thead>
            <th>Artist Name</th>
            <th>Avatar</th>
            <th>Hash Tags</th>
            <th>Action</th>
            </thead>

            <tbody>
            @if(isset($data) && $data->count() > 0)
                @foreach($data as $dat)
                    <tr>
                        <th><a href="{{url('admin/box-office/artist/'.$dat->id.'/view')}}">{{$dat->artists_name}}</a></th>
                        <td><img src="{{asset('artists/'.$dat->artists_avatar)}}" class="img img-responsive"></td>
                        <td>{{$dat->hashtag}}</td>
                        <td>

 <a href="{{url('admin/box-office/artist/'.$dat->id.'/edit')}}" class="table-content-edit" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">
                                                        <i class="icon-edit2"></i>Edit
                                                    </a>

                                                       <a href="#" class="table-content-delete delete-artist" data-artistid="{{$dat->id}}" data-toggle="tooltip"
                                                       data-placement="top" title="Delete">
                                                        <i class="icon-delete2"></i>Delete
                                                    </a>
                    </tr>
                @endforeach
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
        $('.delete-artist').on('click', function (e) {
            e.preventDefault();
            var artistId = $(this).data('artistid');
            alertify.confirm("Delete this artist ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/box-office/artist/delete?artistId=' + artistId,
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

