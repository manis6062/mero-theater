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
       <div class="main-content">
                        
                        <!-- Row start -->
                        <div class="row gutters setting-page">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="setting-wrapper">
                                            <div class="card-header">
                                                <h4>General</h4>
                                            </div>
                                            <div class="setting-list">
                                                <ul>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="general-setting.html">general setting</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="#">custom Dashboard</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="profile.html">Your Account</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="glaccount.html">GL account</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="#">Sales Tax</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="#">Distributors</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="#">People</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="setting-wrapper">
                                            <div class="card-header">
                                                <h4>Post Setting</h4>
                                            </div>
                                            <div class="setting-list">
                                                <ul>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="#">Refond and Voids</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="pointsale.html">Point of sale</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="{{url('admin/content-management/payment-gateway')}}">Payment types</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="{{url('admin/crm')}}">Work Stations</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="#">Customer display profile</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="{{url('admin/counter')}}">Set up your POS</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="setting-wrapper">
                                            <div class="card-header">
                                                <h4>Your Cinema</h4>
                                            </div>
                                            <div class="setting-list">
                                                <ul>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="{{url('admin/seat-management/screens')}}">Sites and screens</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="#">media</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="#">attributes</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="setting-wrapper">
                                            <div class="card-header">
                                                <h4>Users</h4>
                                            </div>
                                            <div class="setting-list">
                                                <ul>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="#">Email Address</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="{{url('admin/crm')}}">Users</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="{{url('admin/change_password')}}">change Password</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="feature-notice.html">feature notifications</a>
                                                    </li>
                                                    <li>
                                                        <i class="icon-chevron-right"></i>
                                                        <a href="{{url('admin/profile')}}">Customer display profile</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->
                        </div>
                    <!-- END: .main-content -->
                    </div>
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
