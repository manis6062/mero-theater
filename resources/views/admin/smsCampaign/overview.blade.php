@extends('admin.layout.master1')

@section('main-body')
    <div class="app-main">
        <!-- BEGIN .main-heading -->
        <header class="main-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="page-icon">
                            <i class="icon-laptop_windows"></i>
                        </div>
                        <div class="page-title">
                            <h5>Mero Theatre</h5>
                            <h6 class="sub-heading">Welcome to your Dashboard</h6>
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
            <div class="row gutters overview">
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="email-overview-wrapper">
                                <div class="card-header">
                                    <h4>Delivered SMS</h4>
                                </div>
                                <div class="overview-info">
                                    <span>{{$sms_sent}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="email-overview-wrapper">
                                <div class="card-header">
                                    <h4>Remaining Credit</h4>
                                </div>
                                <div class="overview-info">
                                    <span>{{$available_credit}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="email-overview-wrapper">
                                <div class="card-header">
                                    <h4>Total Contact</h4>
                                </div>
                                <div class="overview-info">
                                    <span>{{$total_contact}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="email-overview-wrapper">
                                <div class="card-header">
                                    <h4>Call for Credit</h4>
                                </div>
                                <div class="overview-info">
                                    <p>E-Signature Pvt. Ltd</p>
                                    <p>3rd Floor, Shanta Plaza, Near Gyaneshwor Height Gyaneshwor-33, Kathmandu</p>
                                    <p>+977 1 4410178 </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end -->
            </div>
            <!-- END: .main-content -->
        </div>
        <!-- END: .main-content -->
    </div>
@stop

