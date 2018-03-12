@extends('admin.layout.master')

@section('main-body')
    <section class="content">
        <div class="screen-list" style="width: 80%; margin: 5% 10%;">
            <a href="{{url('admin/seat-management/screens/create')}}">Add New Screen</a>
            <table class="table table-responsive table-bordered">
                <thead>
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
                <th width="100">Action</th>
                </thead>

                <tbody>
                @if(isset($screens) && $screens->count() > 0)
                    @foreach($screens as $sc)
                        <tr>
                            <td>{{$sc->name}}</td>
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
                                <span><a href="{{url('admin/seat-management/screens/'.$sc->slug.'/edit')}}"><i
                                                class="fa fa-edit"></i> Edit</a></span>&nbsp;&nbsp;&nbsp;
                                <br>
                                <span class="delete-screen" data-screenid="{{$sc->id}}"><a href=""><i
                                                class="fa fa-trash"></i> Delete</a></span>&nbsp;&nbsp;&nbsp;
                                <br>
                                <span><a href="{{url('admin/seat-management/screens/'.$sc->slug.'/seat')}}"><i
                                                class="fa fa-clone"></i> Seat</a></span>
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
    </section>
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