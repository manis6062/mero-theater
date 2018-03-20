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
                            <h5>Create Movie</h5>
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
                        <div class="card-header artist-header"><a href="{{url('admin/box-office/movies/create')}}"> Create Movie</a></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                 <table class="table m-0 table-bordered common-table ticket-type-table">
            <thead>
            <th>Movie Title(Short Name)</th>
            <th>Distributor</th>
            <th>Duration</th>
            <th>Release Date</th>
            <th>Genre</th>
            <th>Action</th>
            </thead>

            <tbody>
            @if(isset($data) && $data->count() > 0)
                @foreach($data as $dat)
                    <tr>
                        <th><a href="{{url('admin/box-office/movies/'.$dat->id.'/view')}}">{{$dat->movie_title}}:{{$dat->movie_short_name}}</a></th>
                        <td>{{$dat->distributor}}</td>
                        <td>{{$dat->duration}}</td>
                        <td>{{$dat->openingdate}}</td>
                        <td>{{$dat->genre}}</td>
                        <td>

 <a href="{{url('admin/box-office/movies/'.$dat->id.'/edit')}}" class="table-content-edit" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">
                                                        <i class="icon-edit2"></i>Edit
                                                    </a>


  <a href="#" class="table-content-delete delete-movie" data-movieid="{{$dat->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="icon-delete2"></i>Delete
                                                    </a>
                            
                        </td>
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
        $('.delete-movie').on('click', function (e) {
            e.preventDefault();
            var movieId = $(this).data('movieid');
            alertify.confirm("Delete this movie ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/box-office/movies/delete?movieId=' + movieId,
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
