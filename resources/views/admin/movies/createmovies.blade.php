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
                            <h5>Create Movie</h5>
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
                                                    <form class="form" role="form" autocomplete="off" action="{{url('admin/box-office/movies/submit')}}"  method="post" id="submitmovie" enctype="multipart/form-data">
                                                        {{csrf_field()}}

 <div class="form-group row">
                    <label for="movieTitle" class="col-lg-3 col-form-label form-control-label">Title <span class="req">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="movieTitle" name="movieTitle" class="form-control" value="{{old('movieTitle')}}" onfocus="removeError();" placeholder="Enter Movie Name">
                        @if($errors->has('movieTitle'))
                            <span class="help-block">
                                <strong>{{$errors->first('movieTitle')}}</strong>
                            </span>
                        @endif
                        <span class="movieTitle-error error help-block"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="movieTitle" class="col-lg-3 col-form-label form-control-label">Short Name <span class="req">*</span></label>
                    <div class="col-sm-9">
                         <input type="text" id="movieShortName" name="movieShortName" class="form-control" value="{{old('movieShortName')}}" onfocus="removeError();" placeholder="Enter Movie Short Name">
                        @if($errors->has('movieShortName'))
                            <span class="help-block">
                                <strong>{{$errors->first('movieShortName')}}</strong>
                            </span>
                        @endif
                         <span class="movieShortName-error error help-block"></span>
                    </div>
                </div>

       <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Synopsis</label>
                                                            <div class="col-lg-9">
 <textarea name="synopsis" id="synopsis" rows="5" class="form-control" placeholder="Type synopsis" onfocus="removeError();" value="{{old('synopsis')}}"></textarea>
   @if($errors->has('synopsis'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('synopsis')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="synopsis-error error help-block"></span>
                                                            </div>
                                                        </div>

                 <div class="form-group row">
                    <label for="Genre" class="col-lg-3 col-form-label form-control-label">Genre<span class="req">*</span></label>
                    <div class="col-sm-3">
                        <select name="genre" class="custom-select" onfocus="removeError();">
                            <option value="">Select Genre</option>
                            <option value="3D" @if (old('genre') == "3D") {{ 'selected' }} @endif>3D</option>
                            <option value="action" @if (old('genre') == "action") {{ 'selected' }} @endif>Action</option>
                            <option value="adventure" @if (old('genre') == "adventure") {{ 'selected' }} @endif>Adventure</option>
                            <option value="alternativecontent" @if (old('genre') == "alternativecontent") {{ 'selected' }} @endif>Alernative Content</option>
                            <option value="animated" @if (old('genre') == "animated") {{ 'selected' }} @endif>Animated</option>
                            <option value="asian"  @if (old('genre') == "asian") {{ 'selected' }} @endif>Asian</option>
                            <option value="ballet"  @if (old('genre') == "ballet") {{ 'selected' }} @endif>Ballet</option>
                            <option value="biography"  @if (old('genre') == "biography") {{ 'selected' }} @endif>Biography</option>
                            <option value="blackcomedy"  @if (old('genre') == "blackcomedy") {{ 'selected' }} @endif>Black Comedy</option>
                            <option value="children"  @if (old('genre') == "children") {{ 'selected' }} @endif>Children</option>
                            <option value="classic"  @if (old('genre') == "classic") {{ 'selected' }} @endif>Classic</option>
                            <option value="comedy"  @if (old('genre') == "comedy") {{ 'selected' }} @endif>Comedy</option>
                            <option value="concert"  @if (old('genre') == "concert") {{ 'selected' }} @endif>Concert</option>
                            <option value="crime"  @if (old('genre') == "crime") {{ 'selected' }} @endif>Crime</option>
                            <option value="dance"  @if (old('genre') == "dance") {{ 'selected' }} @endif>Dance</option>
                            <option value="docu-drama"  @if (old('genre') == "docu-drama") {{ 'selected' }} @endif>Docu-Drama</option>
                            <option value="documentary"  @if (old('genre') == "documentary") {{ 'selected' }} @endif>Documentary</option>
                            <option value="drama"  @if (old('genre') == "drama") {{ 'selected' }} @endif>Drama</option>
                            <option value="family"  @if (old('genre') == "family") {{ 'selected' }} @endif>Family</option>
                            <option value="fantasy"  @if (old('genre') == "fantasy") {{ 'selected' }} @endif>Fantasy</option>
                            <option value="festival"  @if (old('genre') == "festival") {{ 'selected' }} @endif>Festival</option>
                            <option value="Foreign"  @if (old('genre') == "Foreign") {{ 'selected' }} @endif>Foreign</option>
                            <option value="horror"  @if (old('genre') == "horror") {{ 'selected' }} @endif>Horror</option>
                            <option value="liveconcert"  @if (old('genre') == "liveconcert") {{ 'selected' }} @endif>Live Concert</option>
                            <option value="liveshow"  @if (old('genre') == "liveshow") {{ 'selected' }} @endif>Live Show</option>
                            <option value="livesportsbroadcast"  @if (old('genre') == "livesportsbroadcast") {{ 'selected' }} @endif>Live Sports Broadcast</option>
                            <option value="livetheatre"  @if (old('genre') == "livetheatre") {{ 'selected' }} @endif>Live Theatre</option>
                            <option value="marshalarts"  @if (old('genre') == "marshalarts") {{ 'selected' }} @endif>Marshal Arts</option>
                            <option value="Musicall" @if (old('genre') == "Musicall") {{ 'selected' }} @endif>Musical</option>
                            <option value="mystery" @if (old('genre') == "mystery") {{ 'selected' }} @endif>Mystery</option>
                            <option value="opera" @if (old('genre') == "opera") {{ 'selected' }} @endif>Opera</option>
                            <option value="periodrama" @if (old('genre') == "periodrama") {{ 'selected' }} @endif>Period Drama</option>
                            <option value="romance" @if (old('genre') == "romance") {{ 'selected' }} @endif>Romance</option>
                            <option value="sciencefiction" @if (old('genre') == "sciencefiction") {{ 'selected' }} @endif>Science Fiction</option>
                            <option value="shortfilm" @if (old('genre') == "shortfilm") {{ 'selected' }} @endif>Short Film</option>
                            <option value="sports" @if (old('genre') == "sports") {{ 'selected' }} @endif>Sports</option>
                            <option value="supernatural" @if (old('genre') == "supernatural") {{ 'selected' }} @endif>Supernatural</option>
                            <option value="suspense" @if (old('genre') == "suspense") {{ 'selected' }} @endif>Suspense</option>
                            <option value="teens" @if (old('genre') == "teens") {{ 'selected' }} @endif>Teen</option>
                            <option value="thriller" @if (old('genre') == "thriller") {{ 'selected' }} @endif>Thriller</option>
                            <option value="unknown" @if (old('genre') == "unknown") {{ 'selected' }} @endif>Unknown</option>
                            <option value="war" @if (old('genre') == "war") {{ 'selected' }} @endif>War</option>
                            <option value="western" @if (old('genre') == "western") {{ 'selected' }} @endif>Western</option>
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
                    <label for="distributor" class="col-lg-3 col-form-label form-control-label">Distributor<span class="req">*</span></label>
                    <div class="col-sm-3">
                        <select class="custom-select" name="distributor" onfocus="removeError();">
                            <option value="">Select Distributor</option>
                            <option value="gopikrishna" @if (old('distributor') == "gopikrishna") {{ 'selected' }} @endif>Gopi Krishna</option>
                            <option value="barahimovies"  @if (old('distributor') == "barahimovies") {{ 'selected' }} @endif>Barahi Movies</option>
                            <option value="blackhorse" @if (old('distributor') == "blackhorse") {{ 'selected' }} @endif >Black Horse Creation</option>
                            <option value="aamasaraswoti" @if (old('distributor') == "aamasaraswoti") {{ 'selected' }} @endif>Aama Saraswoti</option>
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
                    <label for="openingshow" class="col-lg-3 col-form-label form-control-label">Opening Date <span class="req">*</span></label>
                    <div class="col-sm-3">
                         <input type="text" id="openingdate" name="openingdate" class="form-control" value="{{old('openingdate')}}" onfocus="removeError();" placeholder="Choose Opening Date">
                        @if($errors->has('openingdate'))
                            <span class="help-block">
                                <strong>{{$errors->first('openingdate')}}</strong>
                            </span>
                        @endif
                        <span class="openingdate-error error help-block"></span>
                    </div>
                </div>

                      <div class="form-group row">
                    <label for="content" class="col-lg-3 col-form-label form-control-label">Content</label>
                    <div class="col-sm-9">
                         <input type="text" id="content" name="content" class="form-control" value="{{old('content')}}" >
                        @if($errors->has('content'))
                            <span class="help-block">
                                <strong>{{$errors->first('content')}}</strong>
                            </span>
                        @endif
                        <span class="content-error error help-block"></span>
                    </div>
                </div>

                      <div class="form-group row">
                    <label for="duration" class="col-lg-3 col-form-label form-control-label">Duration <span class="req">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" id="duration" name="duration" class="form-control" placeholder="Duration in minutes only" value="{{old('duration')}}" onfocus="removeError();">
                        @if($errors->has('duration'))
                            <span class="help-block">
                                <strong>{{$errors->first('duration')}}</strong>
                            </span>
                        @endif
                        <span class="duration-error error help-block"></span>
                    </div>
                </div>

                  <div class="form-group row">
                    <label for="isrestricted" class="col-lg-3 col-form-label form-control-label">Restricted <span class="req">*</span></label>
                    <div class="col-sm-9">
                       <input type="checkbox" id="isrestricted" name="isrestricted" value="restricted">
                        @if($errors->has('isrestricted'))
                            <span class="help-block">
                                <strong>{{$errors->first('isrestricted')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                  <div class="form-group row">
                    <label for="displaysequence" class="col-lg-3 col-form-label form-control-label">Display Sequence <span class="req">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" id="displaysequence" name="displaysequence" class="form-control" value="{{old('displaysequence')}}" onfocus="removeError();">
                        @if($errors->has('displaysequence'))
                            <span class="help-block">
                                <strong>{{$errors->first('displaysequence')}}</strong>
                            </span>
                        @endif
                        <span class="displaysequence-error error help-block"></span>
                    </div>
                </div>

                     <div class="form-group row">
                    <label for="filmformat" class="col-lg-3 col-form-label form-control-label">Film Format<span class="req">*</span></label>
                    <div class="col-sm-3">
                        <select class="custom-select" name="filmformat">
                            <option value="">Select Film Format</option>
                            <option value="2Ddigital" @if (old('filmformat') == "2Ddigital") {{ 'selected' }} @endif>2D Digital</option>
                            <option value="2Dfilm" @if (old('filmformat') == "2Dfilm") {{ 'selected' }} @endif>2D Film</option>
                            <option value="3Ddigital" @if (old('filmformat') == "3Ddigital") {{ 'selected' }} @endif>3D Digital</option>
                            <option value="3Dhfr" @if (old('filmformat') == "3Dhfr") {{ 'selected' }} @endif>3D HFR</option>
                            <option value="imax" @if (old('filmformat') == "imax") {{ 'selected' }} @endif>IMAX</option>
                            <option value="imax15/70" @if (old('filmformat') == "imax15/70") {{ 'selected' }} @endif>IMAX 15/70</option>
                            <option value="imax3D" @if (old('filmformat') == "imax3D") {{ 'selected' }} @endif>IMAX 3D</option>
                            <option value="notfilm" @if (old('filmformat') == "notfilm") {{ 'selected' }} @endif>Not a Film</option>
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
                    <label for="trailerurl" class="col-lg-3 col-form-label form-control-label">Trailer URL <span class="req">*</span></label>
                    <div class="col-sm-9">
                       <input type="text" id="trailerurl" name="trailerurl" class="form-control" value="{{old('trailerurl')}}">
                        @if($errors->has('trailerurl'))
                            <span class="help-block">
                                <strong>{{$errors->first('trailerurl')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                   <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Poster Image<br><span class="note">(Dimension 420x200 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span></label>
                                                            <div class="col-lg-9">
                                                                <label class="custom-file">
                                                                  <input  onfocus="removeError();" type="file" id="image" name="image" class="custom-file-input" value="{{old('image')}}">
                                                                   @if($errors->has('image'))
                                                    <span class="help-block error">
                                                        <strong>
                                                            {{$errors->first('image')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                               
                                                                    <span class="custom-file-control image-filename" ></span>
                                                                     <span class="image-error error help-block"></span>
                                                                </label>

                                                            </div>
                                                        </div>


                                                  
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Banner Image <span class="note">(Dimension 200x200 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span></label>
                                                            <div class="col-lg-9">
                                                                <label class="custom-file">
                                                                  <input  onfocus="removeError();" type="file" id="bannerimage" name="bannerimage" class="custom-file-input" value="{{old('bannerimage')}}">
                                                                   @if($errors->has('bannerimage'))
                                                    <span class="help-block error">
                                                        <strong>
                                                            {{$errors->first('bannerimage')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                               
                                                                    <span class="custom-file-control bannerimage-filename" ></span>
                                                                     <span class="bannerimage-error error help-block"></span>
                                                                </label>

                                                            </div>
                                                        </div>


                                                              <div class="form-group row">
                    <label for="status" class="col-lg-3 col-form-label form-control-label">Status<span class="req">*</span></label>
                    <div class="col-sm-3">
                       <select class="custom-select" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @if($errors->has('status'))
                            <span class="help-block">
                                <strong>{{$errors->first('status')}}</strong>
                            </span>
                        @endif
                        <span class="status-error error help-block"></span>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label" for="directartist">Movie Artists</label>
                    <div class="col-sm-10">
                        <input type="text" name="directartist" class="form-control" value="{{old('directartist')}}">
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
                        <td>Name</td>
                        <td>Role</td>
                    </tr>
                    <tbody class="newrow">
                        
                    </tbody>
                </table>
                <div class="artisterror"></div>
                <br>
                <button class="btn btn-default" id="addmorebtn">Add Artist</button>
                <br><br>
                                                 
                                             
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                                            <div class="col-lg-9">
                                                                <button type="submit" id="submitmovie" class="btn btn-danger subModalBtn subBtn">Create</button>
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

        if($(document).find('tbody.newrow').html() != '')
        {
            var empty = 0;
            $(document).find('select.artist-select').each(function(){
                if($(this).val() == '')
                {
                    empty = 1;
                }
            });

            $(document).find('select.artist-role-select').each(function(){
                if($(this).val() == '')
                {
                    empty = 1;
                }
            });

            if(empty == 1)
            {
                e.preventDefault();
                $('.artisterror').html("Movie Artists Required");
                // alert('do validate');
            }
        }
    });

    function removeError() {
            $('.error').html('');
        }


    $('#image').on('change', function () {

            var fileOrg = '';
            var widthOfImg = '';
            var heightOfImg = '';
            var file = $('#image').val();


             $(".image-filename").text(file);
            if (file != '') {
                var fileSize = $('#image')[0].files[0].size;
                if (fileSize > 2097152) {
                    $('.subModalBtn').prop('disabled', true);
                    alertify.alert('Max size 2 mb only !');
                     $(".image-filename").text('');
                } else {
                    var ext = $('#image').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg']) == -1) {
                        $('.subModalBtn').prop('disabled', true);
                        alertify.alert('Invalid Image Format !');
                                             $(".image-filename").text('');

                    } else {
                        var fileInput = $(this)[0],
                            fileOrg = fileInput.files && fileInput.files[0];

                        if (fileOrg) {
                            var img = new Image();

                            img.src = window.URL.createObjectURL(fileOrg);

                            img.onload = function () {
                                widthOfImg = img.naturalWidth;
                                heightOfImg = img.naturalHeight;

                                if (widthOfImg != 420 && heightOfImg != 200) {
                                    alertify.alert('Invalid Image Dimension ! Image Size Must be 420*200.');
                                    $('.subModalBtn').prop('disabled', true);
                                                         $(".image-filename").text('');

                                } else {
                                    $('.subModalBtn').prop('disabled', false);
                                }
                            };
                        }
                    }
                }
            }
        });

     $('#bannerimage').on('change', function () {

            var fileOrg = '';
            var widthOfImg = '';
            var heightOfImg = '';
            var file = $('#bannerimage').val();


             $(".bannerimage-filename").text(file);
            if (file != '') {
                var fileSize = $('#bannerimage')[0].files[0].size;
                if (fileSize > 2097152) {
                    $('.subModalBtn').prop('disabled', true);
                    alertify.alert('Max size 2 mb only !');
                     $(".bannerimage-filename").text('');
                } else {
                    var ext = $('#bannerimage').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg']) == -1) {
                        $('.subModalBtn').prop('disabled', true);
                        alertify.alert('Invalid Image Format !');
                                             $(".bannerimage-filename").text('');

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
                                    alertify.alert('Invalid Image Dimension ! Image Size Must be 200*200.');
                                    $('.subModalBtn').prop('disabled', true);
                                                         $(".bannerimage-filename").text('');

                                } else {
                                    $('.subModalBtn').prop('disabled', false);
                                }
                            };
                        }
                    }
                }
            }
        });

     
    $('#addmorebtn').on('click',function(e){
        e.preventDefault();
            $.ajax({
                url:baseurl+'/admin/box-office/movies/addmovieartists',
                type:'get',
                success:function(data)
                {
                    $('.newrow').append(data);
                    $(document).find('select.artist-select').on('focus', function(){
                        $('.artisterror').html('');
                    });

                    $(document).find('select.artist-role-select').on('focus', function(){
                       $('.artisterror').html('');
                    });
                }
            });
        });

    
</script>
    <style type="text/css">
        .artisterror{
            color:red;
        }
    </style>
@stop

