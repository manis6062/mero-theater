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
                            <h5>View Artist</h5>
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
                       <div class="artist-profile-div">
                <h1 class="text-center">{{$viewdata->artists_name}}</h1>


                <div class="artist-profile-first-sec">
                    <div class="col-md-12">
                        <img src="{{asset('artists/'.$viewdata->artists_avatar)}}" alt="" class="img img-responsive">
                    </div>

                    <div class="col-md-12 cur-st-div">
                        {!! $viewdata->artists_current_status !!}
                    </div>
                </div>


                <div class="clearfix"></div>


                <div class="artist-profile-second-sec">
                    <h1 class="text-center">Early Life</h1>
                    <div class="col-md-12 ear-li-div">
                        {!! $viewdata->artists_early_life !!}
                    </div>
                </div>


                <div class="clearfix"></div>


                <div class="artist-profile-second-sec">
                    <h1 class="text-center">Achievements</h1>
                    <div class="col-md-12 ear-li-div">
                        {!! $viewdata->artists_achievements !!}
                    </div>
                </div>

                <div class="clearfix"></div>


                <div class="artist-profile-second-sec">
                    <h1 class="text-center">Hash Tags</h1>
                    <div class="col-md-12 ear-li-div">
                        {!!$viewdata->hashtag !!}
                    </div>
                </div>
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

