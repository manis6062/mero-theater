@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>View Artist</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('box-office/artist')}}"><i class="fa fa-meh-o"></i> Artists</a></li>
            <li class="active">view</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <hr>
            <div class="site-setting-general">
                <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icol32-page-white-edit"></i> View Artist</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                            <div class="form-group">
                                <label for="artistName">Name: <span class="req">*</span></label>
                                <input type="text" id="artistName" name="artist_name" class="form-control"
                                       value="{{$viewdata->artists_name}}">
                            </div>

                            <div class="form-group">
                                <label for="artistExistingAvatar">Existing Avatar</label>
                                <img src="{{asset('artists/'.$viewdata->artists_avatar)}}" alt="">
                            </div>

                            <div class="form-group">
                                <label for="artistCurrentStatus">Current Status: <span class="req">*</span></label>
                                <textarea name="artist_current_status" id="artistCurrentStatus" cols="30" rows="10" class="form-control ckeditor">{{$viewdata->artists_current_status}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="artistEarlyLife">Early Life: <span class="req">*</span></label>
                                <textarea name="artist_early_life" id="artistEarlyLife" cols="30" rows="10"
                                          class="form-control ckeditor">{{$viewdata->artists_early_life}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="artistAchievements">Achievements: <span class="req">*</span></label>
                                <textarea name="artist_achievements" id="artistAchievements" cols="30" rows="10"
                                          class="form-control ckeditor">{{$viewdata->artists_achievements}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="artistHashTags">Hash Tags: <span class="req">*</span></label>
                                <input type="text" id="artistHashTags" name="artist_hash_tags"
                                       value="{{$viewdata->hashtag}}" class="form-control">
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop