@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Edit Artists</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/box-office/artist')}}"><i class="fa fa-meh-o"></i> Artists</a></li>
            <li class="active">edit</li>
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
                        <span><i class="icol32-page-white-edit"></i> Edit Artist</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form style="padding: 1% 3%;" action="{{url('admin/box-office/artist/update/'.$editdata->id)}}" class="form-horizontal" method="post" id="createArtistForm" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="artistName">Name: <span class="req">*</span></label>
                                <input type="text" id="artistName" name="artist_name" class="form-control"
                                       value="{{$editdata->artists_name}}">
                            </div>

                            <div class="form-group">
                                <label for="artistExistingAvatar">Existing Avatar</label>
                                <img src="{{asset('artists/'.$editdata->artists_avatar)}}" alt="">
                            </div>

                            <div class="form-group">
                                <label for="artistAvatar">Avatar: <span class="req">*</span></label> (Type: jpeg,
                                jpg, png, bmp, gif, svg | Size: 2mb | Dimension: 200x200)
                                <input type="file" id="artistAvatar" name="artist_avatar" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="artistCurrentStatus">Current Status: <span class="req">*</span></label>
                                <textarea name="artist_current_status" id="artistCurrentStatus" cols="30" rows="10" class="form-control ckeditor">{{$editdata->artists_current_status}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="artistEarlyLife">Early Life: <span class="req">*</span></label>
                                <textarea name="artist_early_life" id="artistEarlyLife" cols="30" rows="10"
                                          class="form-control ckeditor">{{$editdata->artists_early_life}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="artistAchievements">Achievements: <span class="req">*</span></label>
                                <textarea name="artist_achievements" id="artistAchievements" cols="30" rows="10"
                                          class="form-control ckeditor">{{$editdata->artists_achievements}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="artistHashTags">Hash Tags: <span class="req">*</span></label>
                                <input type="text" id="artistHashTags" name="artist_hash_tags"
                                       value="{{$editdata->hashtag}}" class="form-control">
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-danger subModalBtn" value="Update">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


@section('scripts')
    <script>
        $('#createArtistForm').on('submit', function (e) {
            if ($('#artistHashTags').val() == '' || $('#artistName').val() == '' || CKEDITOR.instances['artistCurrentStatus'].getData() == '' || CKEDITOR.instances['artistEarlyLife'].getData() == '' || CKEDITOR.instances['artistAchievements'].getData() == '') {
                e.preventDefault();
                alertify.alert('Please fill up all required fields !');
            }
        });


        $('#artistAvatar').on('change', function () {
            var fileOrg = '';
            var widthOfImg = '';
            var heightOfImg = '';
            var file = $('input#artistAvatar').val();
            if (file != '') {
                var fileSize = $('input#artistAvatar')[0].files[0].size;
                if (fileSize > 2097152) {
                    $('.subModalBtn').prop('disabled', true);
                    alertify.alert('Max size 2 mb only !');
                } else {
                    var ext = $('input#artistAvatar').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg']) == -1) {
                        $('.subModalBtn').prop('disabled', true);
                        alertify.alert('Invalid Image Format !');
                    } else {
                        var fileInput = $(this)[0],
                            fileOrg = fileInput.files && fileInput.files[0];

                        if (fileOrg) {
                            var img = new Image();

                            img.src = window.URL.createObjectURL(fileOrg);

                            img.onload = function () {
                                widthOfImg = img.naturalWidth;
                                heightOfImg = img.naturalHeight;

                                if (widthOfImg != 200 && heightOfImg != 200) {
                                    alertify.alert('Invalid Image Dimension !');
                                    $('.subModalBtn').prop('disabled', true);
                                } else {
                                    $('.subModalBtn').prop('disabled', false);
                                }
                            };
                        }
                    }
                }
            }
        });
    </script>
@stop