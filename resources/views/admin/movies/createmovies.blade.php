@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Movies
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li>Create Movie</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <hr>
            <form method="post" action="{{url('admin/movies/submit')}}" enctype="multipart/form-data" id="submitmovie">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="movieTitle" class="col-sm-2 text-right"><span class="req">*</span>Title: </label>
                    <div class="col-sm-4">
                        <input type="text" id="movieTitle" name="movieTitle" class="form-control" value="{{old('movieTitle')}}">
                        @if($errors->has('movieTitle'))
                            <span class="help-block">
                                <strong>{{$errors->first('movieTitle')}}</strong>
                            </span>
                        @endif
                        <span class="movieTitle-error error help-block"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="movieShortName" class="col-sm-2 text-right"><span class="req">*</span>Short Name:</label>
                    <div class="col-sm-4">
                        <input type="text" id="movieShortName" name="movieShortName" class="form-control" value="{{old('movieShortName')}}">
                        @if($errors->has('movieShortName'))
                            <span class="help-block">
                                <strong>{{$errors->first('movieShortName')}}</strong>
                            </span>
                        @endif
                         <span class="movieShortName-error error help-block"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Synopsis" class="col-sm-2 text-right">Synopsis:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control ckeditor" rows="6" name="synopsis">{{old('synopsis')}}</textarea>
                        @if($errors->has('synopsis'))
                            <span class="help-block">
                                <strong>{{$errors->first('synopsis')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Genre" class="col-sm-2 text-right"><span class="req">*</span>Genre:</label>
                    <div class="col-sm-2">
                        <select name="genre" class="form-control">
                            <option value="">Select Genre</option>
                            <option value="3D">3D</option>
                            <option value="action">Action</option>
                            <option value="adventure">Adventure</option>
                            <option value="alternativecontent">Alernative Content</option>
                            <option value="animated">Animated</option>
                            <option value="asian">Asian</option>
                            <option value="ballet">Ballet</option>
                            <option value="biography">Biography</option>
                            <option value="blackcomedy">Black Comedy</option>
                            <option value="children">Children</option>
                            <option value="classic">Classic</option>
                        </select>
                         @if($errors->has('genre'))
                            <span class="help-block">
                                <strong>{{$errors->first('genre')}}</strong>
                            </span>
                        @endif
                        <span class="genre-error error help-block"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="distributor" class="col-sm-2 text-right"><span class="req">*</span>Distributor:</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="distributor">
                            <option value="">Select Distributor</option>
                            <option value="gopikrishna">Gopi Krishna</option>
                            <option value="barahimovies">Barahi Movies</option>
                            <option value="blackhorse">Black Horse Creation</option>
                            <option value="aamasaraswoti">Aama Saraswoti</option>
                        </select>
                        @if($errors->has('distributor'))
                            <span class="help-block">
                                <strong>{{$errors->first('distributor')}}</strong>
                            </span>
                        @endif
                        <span class="distributor-error error help-block"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="openingshow" class="col-sm-2 text-right"><span class="req">*</span>Opening Date:</label>
                    <div class="col-sm-4">
                        <input type="text" id="openingdate" name="openingdate" class="form-control" value="{{old('openingdate')}}">
                        @if($errors->has('openingdate'))
                            <span class="help-block">
                                <strong>{{$errors->first('openingdate')}}</strong>
                            </span>
                        @endif
                        <span class="openingdate-error error help-block"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="distributor" class="col-sm-2 text-right">Content:</label>
                    <div class="col-sm-4">
                        <input type="text" id="content" name="content" class="form-control" value="{{old('content')}}">
                        <span id="seatImageSpan">
                        @if($errors->has('content'))
                            <span class="help-block">
                                <strong>{{$errors->first('content')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="distributor" class="col-sm-2 text-right"><span class="req">*</span>Duration:</label>
                    <div class="col-sm-4">
                        <input type="text" id="duration" name="duration" class="form-control" placeholder="Duration in minutes only" value="{{old('duration')}}">
                        @if($errors->has('duration'))
                            <span class="help-block">
                                <strong>{{$errors->first('duration')}}</strong>
                            </span>
                        @endif
                        <span class="duration-error error help-block"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="distributor" class="col-sm-2 text-right">Restricted:</label>
                    <div class="col-sm-1">
                        <input type="checkbox" id="isrestricted" name="isrestricted" value="restricted">
                        @if($errors->has('isrestricted'))
                            <span class="help-block">
                                <strong>{{$errors->first('isrestricted')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="displaysequence" class="col-sm-2 text-right"><span class="req">*</span>Display Sequence:</label>
                    <div class="col-sm-4">
                        <input type="text" id="displaysequence" name="displaysequence" class="form-control" value="{{old('displaysequence')}}">
                        @if($errors->has('displaysequence'))
                            <span class="help-block">
                                <strong>{{$errors->first('displaysequence')}}</strong>
                            </span>
                        @endif
                        <span class="displaysequence-error error help-block"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="filmformat" class="col-sm-2 text-right"><span class="req">*</span>Film Format:</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="filmformat">
                            <option value="">Select Film Format</option>
                            <option value="2Ddigital">2D Digital</option>
                            <option value="2Dfilm">2D Film</option>
                            <option value="3Ddigital">3D Digital</option>
                            <option value="3Dhfr">3D HFR</option>
                            <option value="imax">IMAX</option>
                            <option value="imax15/70">IMAX 15/70</option>
                            <option value="imax3D">IMAX 3D</option>
                            <option value="notfilm">Not a Film</option>
                        </select>
                        @if($errors->has('filmformat'))
                            <span class="help-block">
                                <strong>{{$errors->first('filmformat')}}</strong>
                            </span>
                        @endif
                        <span class="filmformat-error error help-block"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="trailerurl" class="col-sm-2 text-right">Trailer URL:</label>
                    <div class="col-sm-4">
                        <input type="text" id="trailerurl" name="trailerurl" class="form-control" value="{{old('trailerurl')}}">
                        @if($errors->has('trailerurl'))
                            <span class="help-block">
                                <strong>{{$errors->first('trailerurl')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-sm-2 text-right">Poster Image:</label>
                    <div class="col-sm-4">
                        <input type="file" id="image" name="image" class="form-control" value="{{old('image')}}">
                        @if($errors->has('image'))
                            <span class="help-block">
                                <strong>{{$errors->first('image')}}</strong>
                            </span>
                        @endif
                    </div>
                    (Dimension 25x25 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span>
                    <span class="image-error error help-block"></span>
                </div>

                <div class="form-group row">
                    <label for="bannerimage" class="col-sm-2 text-right">Banner Image:</label>
                    <div class="col-sm-4">
                        <input type="file" id="bannerimage" name="bannerimage" class="form-control" value="{{old('bannerimage')}}">
                        @if($errors->has('bannerimage'))
                            <span class="help-block">
                                <strong>{{$errors->first('bannerimage')}}</strong>
                            </span>
                        @endif
                    </div>
                    (Dimension 25x25 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span>
                    <span class="bannerimage-error error help-block"></span>
                </div>

                <div class="form-group row">
                    <label for="Status" class="col-sm-2 text-right">Status:</label>
                    <div class="col-sm-2">
                        <select class="form-control" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <hr>

                <section class="content-header">
                    <h1>
                        People
                    </h1>
                    <p>Add or remove actors, directors, producers and writers for this film below</p>
                </section>

                <table class="table table-bordered table-responsive table-striped">
                    <tr class="success">
                        <td>SN</td>
                        <td>Name</td>
                        <td>Role</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <!-- <button class="btn btn-primary" id="addmorebtn">Add</button> -->

                <button type="submit" class="btn btn-danger subBtn">Submit</button>
            </form>
        </div>
    </section>
@stop

@section('scripts')
<script>
    var today = new Date();
    $("#openingdate").datepicker({
        format:'yyyy-mm-dd',
        startDate:today,
    });
        $('#submitmovie').on('submit', function (e) {
            $('.error').html('');
            if ($('#movieTitle').val() == '') {
                e.preventDefault();
                $('.movieTitle-error').html('<strong>Please enter the Movie Title.</strong>');
            }

            if ($('#movieShortName').val() == '') {
                e.preventDefault();
                $('.movieShortName-error').html('<strong>Please enter the Movie Short Name.</strong>');
            }

            if ($('#genre').val() == '') {
                e.preventDefault();
                $('.genre-error').html('<strong>Please enter the Movie Genre.</strong>');
            }

            if ($('#distributor').val() == '') {
                e.preventDefault();
                $('.distributor-error').html('<strong>Please enter the Movie Distributor.</strong>');
            }

            if ($('#openingdate').val() == '') {
                e.preventDefault();
                $('.openingdate-error').html('<strong>Please enter the Movie Opening Date.</strong>');
            }

            if ($('#duration').val() == '') {
                e.preventDefault();
                $('.duration-error').html('<strong>Please enter the Movie Duration Time.</strong>');
            }else{
                var value = $('#duration').val();
                var regex = new RegExp(/^\+?[0-9]+$/);
                if(!value.match(regex)) 
                {
                    $('.duration-error').html('<strong>Please enter the Numbers only.</strong>');
                }
            }

            if ($('#displaysequence').val() == '') {
                e.preventDefault();
                $('.displaysequence-error').html('<strong>Please enter the Movie Display Sequence.</strong>');
            }

            if ($('#filmformat').val() == '') {
                e.preventDefault();
                $('.duration-error').html('<strong>Please enter the Movie Format.</strong>');
            }

            if ($('#image').val() == '') {
                e.preventDefault();
                $('.image-error').html('<strong>Please enter the Poster Image.</strong>');
            } else {
                var ext = $('input#image').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'svg']) == -1) {
                    e.preventDefault();
                    $('.image-error').html('<strong>Invalid Image Format !</strong>');
                }
                else {
                    var fileSize = $('input#image')[0].files[0].size;
                    if (fileSize > 2097152) {
                        e.preventDefault();
                        $('.image-error').html('<strong>File Size exceed max allowed size !</strong>');
                    }else{
                        var fileOrg = '';
                        var widthOfImg = '';
                        var heightOfImg = '';
                        var fileInput = $(this)[0],
                        fileOrg = fileInput.files && fileInput.files[0];

                        if (fileOrg) {
                            var img = new Image();

                            img.src = window.URL.createObjectURL(fileOrg);

                            img.onload = function () {
                                widthOfImg = img.naturalWidth;
                                heightOfImg = img.naturalHeight;

                                if (widthOfImg != 420 && heightOfImg != 200) {
                                    e.preventDefault();
                                    $('.image-error').html('<strong style="color: red;">Invalid Image Dimension !</strong>');
                                }
                            };
                        }
                    }
                }
            }

            if ($('#bannerimage').val() == '') {
                e.preventDefault();
                $('.bannerimage-error').html('<strong>Please enter the Banner Image.</strong>');
            } else {
                var ext = $('input#bannerimage').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'svg']) == -1) {
                    e.preventDefault();
                    $('.bannerimage-error').html('<strong>Invalid Image Format !</strong>');
                } else {
                    var fileSize = $('input#bannerimage')[0].files[0].size;
                    if (fileSize > 2097152) {
                        e.preventDefault();
                        $('.bannerimage-error').html('<strong>File Size exceed max allowed size !</strong>');
                    }else{
                        var fileOrg = '';
                        var widthOfImg = '';
                        var heightOfImg = '';
                        var fileInput = $(this)[0],
                        fileOrg = fileInput.files && fileInput.files[0];

                        if (fileOrg) {
                            var img = new Image();

                            img.src = window.URL.createObjectURL(fileOrg);

                            img.onload = function () {
                                widthOfImg = img.naturalWidth;
                                heightOfImg = img.naturalHeight;

                                if (widthOfImg != 420 && heightOfImg != 200) {
                                    e.preventDefault();
                                    $('.image-error').html('<strong style="color: red;">Invalid Image Dimension !</strong>');
                                }
                            };
                        }
                    }
                }
            }
        });
    </script>
@stop

