@extends('admin.layout.master')

@section('main-body')
    <section class="content">
        <div class="screen-list" style="width: 80%; margin: 5% 10%;">
            <a href="{{url('admin/box-office/ticket-types/create')}}">Add New Ticket Type</a>
            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-success">
                    <i class="fa fa-times pull-right closeMessage"></i>
                    <p class="text-center">{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                </div>
            @endif
            <table class="table table-responsive table-bordered">
                <thead>
                <th>Description</th>
                <th>Label</th>
                <th>Ticket Class</th>
                <th>Default Price</th>
                <th>Diaplay Sequence</th>
                <th>Voucher Identifier</th>
                <th>Sales Via</th>
                <th>Ticket Type</th>
                <th>Created On</th>
                <th width="100">Action</th>
                </thead>

                <tbody>
                @if(isset($ticketTypes) && $ticketTypes->count() > 0)
                    @foreach($ticketTypes as $tt)
                        <tr>
                            <td>{{$tt->description}}</td>
                            <td>{{$tt->label}}</td>
                            <td>{{$tt->ticket_class}}</td>
                            <td>{{$tt->default_price}}</td>
                            <td>{{$tt->display_sequence}}</td>
                            <td>{{$tt->voucher_identifier == null ? 'N/A' : $tt->voucher_identifier}}</td>
                            <td>{{$tt->sales_via == null ? 'N/A' : $tt->sales_via}}</td>
                            <td>{{$tt->ticket_type == null ? 'N/A' : $tt->ticket_type}}</td>
                            <td>{{date('M d, Y', strtotime($tt->created_at))}}</td>
                            <td>
                                <span><a href="{{url('admin/box-office/ticket-types/'.$tt->slug.'/edit')}}"><i
                                                class="fa fa-edit"></i> Edit</a></span>&nbsp;&nbsp;&nbsp;
                                <br>
                                <span class="delete-ticket-type" data-ttid="{{$tt->id}}"><a href=""><i
                                                class="fa fa-trash"></i> Delete</a></span>&nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="12" class="text-center">No Any Ticket Found !</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $(document).find('.closeMessage').on('click', function () {
            $(this).parent('div').remove();
        });
        $('.delete-ticket-type').on('click', function (e) {
            e.preventDefault();
            var ttid = $(this).data('ttid');
            alertify.confirm("Delete this ticket type ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/box-office/ticket-types/delete?ttid=' + ttid,
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