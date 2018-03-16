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
                            <h5>Ticket types</h5>
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
                        <div class="card-header artist-header"><a href="{{url('admin/box-office/ticket-types/create')}}"> Create New Ticket
                                type</a></div>
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
                                    <tr>
                                        <th>Description</th>
                                        <th>Lavel</th>
                                        <th>Ticket Class</th>
                                        <th>Default Price</th>
                                        <th>Diaplay Sequence</th>
                                        <th>Voucher Identifier</th>
                                        <th>Sales Via</th>
                                        <th>Ticket Type</th>
                                        <th>Created On</th>
                                        <th class="table-action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($ticketTypes) && $ticketTypes->count() > 0)
                                        @foreach($ticketTypes as $tt)
                                            <tr>
                                                <th scope="row"><a href="#"> {{$tt->description}}</a></th>
                                                <td>{{$tt->label}}</td>
                                                <td>{{$tt->ticket_class}}</td>
                                                <td>{{$tt->default_price}}</td>
                                                <td>{{$tt->display_sequence}}</td>
                                                <td>{{$tt->voucher_identifier == null ? 'N/A' : $tt->voucher_identifier}}</td>
                                                <td>{{$tt->sales_via == null ? 'N/A' : $tt->sales_via}}</td>
                                                <td>{{$tt->ticket_type == null ? 'N/A' : $tt->ticket_type}}</td>
                                                <td>{{date('M d, Y', strtotime($tt->created_at))}}</td>
                                                <td>
                                                    <a href="{{url('admin/box-office/ticket-types/'.$tt->slug.'/edit')}}" class="table-content-edit" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">
                                                        <i class="icon-edit2"></i>Edit
                                                    </a>
                                                    <a href="#" class="table-content-delete delete-ticket-type" data-ttid="{{$tt->id}}" data-toggle="tooltip"
                                                       data-placement="top" title="Delete">
                                                        <i class="icon-delete2"></i>Delete
                                                    </a>
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