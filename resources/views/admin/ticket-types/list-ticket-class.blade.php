@extends('admin.layout.master1')

@section('main-body')
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
                            <h5>Ticket Class</h5>
                            <h6 class="sub-heading">Welcome to Merotheatre Admin </h6>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="right-actions">
                            <span class="last-login">Last Login: 2 hours ago</span>
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
                        <div class="card-header artist-header"><a href="{{url('admin/box-office/ticket-types/classes/create')}}"> Create New Class</a></div>
                        <div class="card-body">
                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table m-0 table-bordered common-table">
                                    <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Class Description</th>
                                        <th>Created On</th>
                                        <th class="table-action">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($ticketClasses) && $ticketClasses->count() > 0)
                                        @foreach($ticketClasses as $tt)
                                            <tr>
                                                <th scope="row">{{$tt->class_name}}</th>
                                                <td>{{$tt->class_description}}</td>
                                                <td>{{date('M d, Y', strtotime($tt->created_at))}}</td>
                                                <td>
                                                    <a href="{{url('admin/box-office/ticket-types/classes/'.$tt->slug.'/edit')}}" class="table-content-edit" data-toggle="tooltip"
                                                       data-placement="top" title="Edit">
                                                        <i class="icon-edit2"></i>Edit
                                                    </a>
                                                    <a href="#" class="table-content-delete delete-ticket-class" data-toggle="tooltip"
                                                       data-placement="top" title="Delete" data-tcid="{{$tt->id}}">
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
@stop

@section('scripts')
    <script>
        $(document).find('.closeMessage').on('click', function () {
            $(this).parent('div').remove();
        });
        $('.delete-ticket-class').on('click', function (e) {
            e.preventDefault();
            var classId = $(this).data('tcid');
            alertify.confirm("Delete this ticket class ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/box-office/ticket-types/delete-ticket-class?classId=' + classId,
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