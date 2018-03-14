@extends('admin.layout.master')

@section('main-body')
    <section class="content">
        <div class="screen-list" style="width: 80%; margin: 5% 10%;">
            <table class="table table-responsive table-bordered">
                <thead>
                <th>SN</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Message</th>
                <th>Messaged Date</th>
                <th>Action</th>
                </thead>

                <tbody>
                @if(isset($inquires) && $inquires->count() > 0)
                 @php $i=1  @endphp
                    @foreach($inquires as $iq)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$iq->name}}</td>
                            <td>{{$iq->email}}</td>
                            <td>{{$iq->phone_no}}</td>
                            <td>{{$iq->message}}</td>
                            <td>{{date('M d, Y', strtotime($iq->created_at))}}</td>
                            <td>
                                <span class="delete-inquiry" data-id="{{$iq->id}}"><a href=""><i
                                                class="fa fa-trash"></i>Delete</a></span>
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
    </section>
@stop

@section('scripts')
    <script>
        $('.delete-inquiry').on('click', function (e) {
            e.preventDefault();
            var Id = $(this).data('id');
            alertify.confirm("Delete this Inquiry ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/content-management/inquiry/delete?Id=' + Id,
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