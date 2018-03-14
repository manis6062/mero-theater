

@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Artist Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/box-office/artist')}}"><i class="fa fa-meh-o"></i> Artists</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <hr>

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
    </section>

@stop