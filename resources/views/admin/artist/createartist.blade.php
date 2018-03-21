@extends('admin.layout.master1')

@section('styles')
    <style>
        .create-form {
            width: 70%;
            margin-left: 15%;
            margin-right: 15%;
            margin-top: 5%;
            margin-bottom: 5%;
            border: 1px solid #ddd;
            padding: 2%;
        }


        .help-block {
            display: block;
            color: red;
            font-size: 15px;
            font-weight: 500;
        }

        .info-span{
            font-size: 18px;
            text-align: center;
            font-weight: 600;
            color: magenta;
        }

        small{
            color: red;
        }

        span.note{
            font-size: 11px;
            margin: 0;
            padding: 0;
        }

       .artist-avatar-error{
        text-transform: lowercase;
       }

       .subModalBtn{
       background-color: #DA1113;
       }

    </style>
@stop

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
                            <h5>Create Artist</h5>
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
                        <div class="row gutters form-wrapper">
                            <div class=" col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="artist-form">
                                                    <form class="form" role="form" autocomplete="off" action="{{url('admin/box-office/artist/submit')}}"  method="post" id="createArtistForm" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Name <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                 <input type="text" id="artistName" name="artist_name" class="form-control" value="{{old('name')}}" onfocus="removeError();" placeholder="Enter Artist Name">
                                                                  @if($errors->has('artist_name'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('artist_name')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="artist-name-error error help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Avatar <span class="req">*</span><br><span class="note">(Dimension 25x25 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span></label>
                                                            <div class="col-lg-9">
                                                                <label class="custom-file">
                                                                  <input  onfocus="removeError();" type="file" id="artistAvatar file2" name="artist_avatar" class="custom-file-input" value="{{old('artist_avatar')}}">
                                                                   @if($errors->has('artist_avatar'))
                                                    <span class="help-block error">
                                                        <strong>
                                                            {{$errors->first('artist_avatar')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                               
                                                                    <span class="custom-file-control avatar-filename" ></span>
                                                                     <span class="artist-avatar-error error help-block"></span>
                                                                </label>

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">current status <span class="req">*</span></label>
                                                            <div class="col-lg-9">
 <textarea name="artist_current_status" id="artistCurrentStatus" rows="5" class="form-control" placeholder="Type your cureent status" onfocus="removeError();" value="{{old('artist_current_status')}}"></textarea>
   @if($errors->has('artist_current_status'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('artist_current_status')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="artist-current-status-error error help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Early life <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                 <textarea name="artist_early_life" id="artistEarlyLife" placeholder="Type early life" rows="5" class="form-control" onfocus="removeError();" value="{{old('artist_early_life')}}"></textarea>
                                                   @if($errors->has('artist_early_life'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('artist_early_life')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="artist-early-life-error error help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Achievments <span class="req">*</span></label>
                                                            <div class="col-lg-9">

<textarea name="artist_achievements" id="artistAchievements" rows="5" class="form-control" placeholder="Type artist achievments" onfocus="removeError();" value="{{old('artist_achievements')}}"></textarea>
 @if($errors->has('artist_achievements'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('artist_achievements')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="artist-achievements-error error help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Hash Tags <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                 <input type="text" id="artistHashTags" name="artist_hash_tags" class="form-control" value="{{old('artist_hash_tags')}}" onfocus="removeError();" placeholder="Type artist hashtags">
                                                                  @if($errors->has('artist_hash_tags'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('artist_hash_tags')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="artist-hash-tags-error error help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                                            <div class="col-lg-9">
                                                                <button type="submit" class="btn btn-primary subModalBtn">Create</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    
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

@section('scripts')
    <script>

        $('#createArtistForm').on('submit', function (e) {
            // if ($('#artistHashTags').val() == '' || $('#artistName').val() == '' || $('#artistAvatar').val() == '' || CKEDITOR.instances['artistCurrentStatus'].getData() == '' || CKEDITOR.instances['artistEarlyLife'].getData() == '' || CKEDITOR.instances['artistAchievements'].getData() == '') {
            //     e.preventDefault();
            //     alertify.alert('Please fill up all required fields !');
            // }

           $('.error').html('');
            if ($('#artistName').val() == '') {
                e.preventDefault();
                $('.artist-name-error').html('<strong>Please enter the name.</strong>');
            }

            if ($('input[type="file"]').val() == '') {
                e.preventDefault();
                $('.artist-avatar-error').html('<strong>Please upload the avatar.</strong>');
            }

             if ($('#artistEarlyLife').val() == '') {
                e.preventDefault();
                $('.artist-early-life-error').html('<strong>Please enter the early life.</strong>');
            }

             if ($('#artistCurrentStatus').val() == '') {
                e.preventDefault();
                $('.artist-current-status-error').html('<strong>Please enter the current status.</strong>');
            }

             if ($('#artistAchievements').val() == '') {
                e.preventDefault();
                $('.artist-achievements-error').html('<strong>Please enter the achievments.</strong>');
            }

              if ($('#artistHashTags').val() == '') {
                e.preventDefault();
                $('.artist-hash-tags-error').html('<strong>Please enter the hashtags.</strong>');
            }

        });


        $('input[type="file"]').on('change', function () {

            var fileOrg = '';
            var widthOfImg = '';
            var heightOfImg = '';
            var file = $('input[type="file"]').val();
             $(".avatar-filename").text(file);
            if (file != '') {
                var fileSize = $('input[type="file"]')[0].files[0].size;
                if (fileSize > 2097152) {
                    $('.subModalBtn').prop('disabled', true);
                    alertify.alert('Max size 2 mb only !');
                     $(".avatar-filename").text('');
                } else {
                    var ext = $('input[type="file"]').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg']) == -1) {
                        $('.subModalBtn').prop('disabled', true);
                        alertify.alert('Invalid Image Format !');
                                             $(".avatar-filename").text('');

                    } else {
                        var fileInput = $(this)[0],
                            fileOrg = fileInput.files && fileInput.files[0];

                        if (fileOrg) {
                            var img = new Image();

                            img.src = window.URL.createObjectURL(fileOrg);

                            img.onload = function () {
                                widthOfImg = img.naturalWidth;
                                heightOfImg = img.naturalHeight;

                                if (widthOfImg != 25 && heightOfImg != 25) {
                                    alertify.alert('Invalid Image Dimension ! Image Size Must be 25*25.');
                                    $('.subModalBtn').prop('disabled', true);
                                                         $(".avatar-filename").text('');

                                } else {
                                    $('.subModalBtn').prop('disabled', false);
                                }
                            };
                        }
                    }
                }
            }
        });



 function removeError() {
            $('.error').html('');
        }

    </script>
@stop