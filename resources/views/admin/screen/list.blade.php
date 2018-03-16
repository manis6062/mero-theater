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
                            <h5>Screens</h5>
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
                        <div class="card-header artist-header"><a href="{{url('admin/seat-management/screens/create')}}"> Create New Screen</a></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table m-0 table-bordered common-table ticket-type-table">
                                    <thead>
                                    <tr>
                                        <th>Screen Name</th>
                                        <th>Screen Number</th>
                                        <th>House Seats</th>
                                        <th>Wheel Chair Seats</th>
                                        <th>Standard Seats</th>
                                        <th>Available Seat Image</th>
                                        <th>Selected Seat Image</th>
                                        <th>Reserved Seat Image</th>
                                        <th>Sold Seat Image</th>
                                        <th>Created On</th>
                                        <th class="table-action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($screens) && $screens->count() > 0)
                                        @foreach($screens as $sc)
                                            <tr>
                                                <th scope="row"><a href="#"> {{$sc->name}}</a></th>
                                                <td>{{$sc->screen_number}}</td>
                                                <td>{{$sc->house_seats}}</td>
                                                <td>{{$sc->wheel_chair_seats}}</td>
                                                <td>{{$sc->standard_seats == null || $sc->standard_seats == '0' ? 'N/A' : $sc->standard_seats}}</td>
                                                <td><img src="{{asset('screen/available-seat-image/'.$sc->available_seat)}}" alt=""></td>
                                                <td><img src="{{asset('screen/selected-seat-image/'.$sc->selected_seat)}}" alt=""></td>
                                                <td><img src="{{asset('screen/reserved-seat-image/'.$sc->reserved_seat)}}" alt=""></td>
                                                <td><img src="{{asset('screen/sold-seat-image/'.$sc->sold_seat)}}" alt=""></td>
                                                <td>{{date('M d, Y', strtotime($sc->created_at))}}</td>
                                                <td>
                                                    <a href="{{url('admin/seat-management/screens/'.$sc->slug.'/edit')}}" class="table-content-edit" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">
                                                        <i class="icon-edit2"></i>Edit
                                                    </a>
                                                    <a href="#" class="table-content-delete delete-screen" data-screenid="{{$sc->id}}" data-toggle="tooltip"
                                                       data-placement="top" title="Delete">
                                                        <i class="icon-delete2"></i>Delete
                                                    </a>
                                                    <a href="{{url('admin/seat-management/screens/'.$sc->slug.'/seat')}}" class="table-content-delete" data-toggle="tooltip"
                                                       data-placement="top" title="Seat">
                                                        <i class="icon-airline_seat_individual_suite"></i>Seat
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">No Any Screen Found !</td>
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
        $('.delete-screen').on('click', function (e) {
            e.preventDefault();
            var screenId = $(this).data('screenid');
            alertify.confirm("Delete this screen ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/seat-management/screens/delete?screenId=' + screenId,
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