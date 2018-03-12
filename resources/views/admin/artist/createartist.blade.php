@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Create Artist</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/box-office/artist')}}"><i class="fa fa-meh-o"></i> Artists</a></li>
            <li class="active">Create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <hr>
            <div class="site-setting-general">

                <!-- Panels Start -->
                <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icol32-add"></i> Add New Artist</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form style="padding: 1% 3%;" action="{{url('admin/box-office/artist/submit')}}" class="form-horizontal" method="post" id="createArtistForm" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="artistName" class="col-sm-2 control-label">Name: <span class="req">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" id="artistName" name="artist_name" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="artistAvatar" class="col-sm-2 control-label">Avatar: <span class="req">*</span></label>
                                <div class="col-sm-4">
                                    <input type="file" id="artistAvatar" name="artist_avatar" class="form-control">
                                </div>
                                 (Type: jpeg,
                                jpg, png, bmp, gif, svg | Size: 2mb | Dimension: 200x200)
                            </div>

                            <div class="form-group row">
                                <label for="artistCurrentStatus" class="col-sm-2 control-label" >Current Status: <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="artist_current_status" id="artistCurrentStatus" cols="30" rows="10" class="form-control ckeditor"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="artistEarlyLife" class="col-sm-2 control-label">Early Life: <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="artist_early_life" id="artistEarlyLife" cols="30" rows="10" class="form-control ckeditor"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="artistAchievements" class="col-sm-2 control-label">Achievements: <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="artist_achievements" id="artistAchievements" cols="30" rows="10" class="form-control ckeditor"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="artistHashTags" class="col-sm-2 control-label">Hash Tags: <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="artistHashTags" name="artist_hash_tags" class="form-control">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <input type="submit" class="btn btn-danger subModalBtn " value="Create">
                                </div>
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
            if ($('#artistHashTags').val() == '' || $('#artistName').val() == '' || $('#artistAvatar').val() == '' || CKEDITOR.instances['artistCurrentStatus'].getData() == '' || CKEDITOR.instances['artistEarlyLife'].getData() == '' || CKEDITOR.instances['artistAchievements'].getData() == '') {
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