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
                            <h5>List Of Inquiries</h5>
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
                        <div class="card-body">
                            <div class="table-responsive">
                  <table class="table m-0 table-bordered common-table">
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

<a href="#" class="table-content-delete delete-inquiry" data-id="{{$iq->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
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
