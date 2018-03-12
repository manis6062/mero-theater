@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Movies
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li>Edit Movie</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <hr>
            <form method="post" action="{{url('admin/box-office/movies/update/'.$editdata->id)}}" enctype="multipart/form-data" id="submitmovie">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="movieTitle" class="col-sm-2 text-right"><span class="req">*</span>Title: </label>
                    <div class="col-sm-4">
                        <input type="text" id="movieTitle" name="movieTitle" class="form-control" value="{{ isset($editdata->movie_title)?$editdata->movie_title:old('movieTitle') }}">
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
                        <input type="text" id="movieShortName" name="movieShortName" class="form-control" value="{{ isset($editdata->movie_short_name)?$editdata->movie_short_name:old('movieTitle') }}">
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
                        <textarea class="form-control ckeditor" rows="6" name="synopsis">{{ isset($editdata->synopsis)?$editdata->synopsis:old('synopsis') }}</textarea>
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
                    <label for="openingdate" class="col-sm-2 text-right"><span class="req">*</span>Opening Date:</label>
                    <div class="col-sm-4">
                        <input type="text" id="openingdate" name="openingdate" class="form-control"  value="{{ isset($editdata->openingdate)?$editdata->openingdate:old('openingdate') }}">
                        @if($errors->has('openingdate'))
                            <span class="help-block">
                                <strong>{{$errors->first('openingdate')}}</strong>
                            </span>
                        @endif
                        <span class="openingdate-error error help-block"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-sm-2 text-right">Content:</label>
                    <div class="col-sm-4">
                        <input type="text" id="content" name="content" class="form-control"  value="{{ isset($editdata->content)?$editdata->content:old('content') }}">
                        <span id="seatImageSpan">
                        @if($errors->has('content'))
                            <span class="help-block">
                                <strong>{{$errors->first('content')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="duration" class="col-sm-2 text-right"><span class="req">*</span>Duration:</label>
                    <div class="col-sm-4">
                        <input type="text" id="duration" name="duration" class="form-control" placeholder="Duration in minutes only"  value="{{ isset($editdata->duration)?$editdata->duration:old('duration') }}">
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
                        <input type="checkbox" id="isrestricted" name="isrestricted" value="restricted" {{ isset($editdata->isrestricted)?'checked':''}}>
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
                        <input type="text" id="displaysequence" name="displaysequence" class="form-control" value="{{ isset($editdata->displaysequence)?$editdata->displaysequence:old('displaysequence') }}">
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
                        <input type="text" id="trailerurl" name="trailerurl" class="form-control" value="{{ isset($editdata->trailerurl)?$editdata->trailerurl:old('trailerurl') }}">
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
                        @if(isset($editdata->image))
                            <img src="{{ asset('movies/posterimage/'.$editdata->image) }}" alt="Poster Image" class="img img-responsive">
                        @endif
                        <label for="poster">Change Poster Image:</label>
                        <input type="file" class="form-control " name="image" id="image">
                        (Dimension 25x25 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)
                    </div>
                    <span class="image-error error help-block"></span>
                </div>

                <div class="form-group row">
                    <label for="bannerimage" class="col-sm-2 text-right">Banner Image:</label>
                    <div class="col-sm-4">
                        @if(isset($editdata->image))
                            <img src="{{ asset('movies/bannerimage/'.$editdata->banner_image) }}" alt="Banner Image" class="img img-responsive">
                        @endif
                        <label for="banner">Change Poster Image:</label>
                        <input type="file" class="form-control " name="bannerimage" id="bannerimage" style="padding: 0; margin: 0;">
                        (Dimension 25x25 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)
                    </div>
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

                <div class="form-group row">
                    <label class="col-sm-2 control-label text-right" for="directartist">Movie Artists</label>
                    <div class="col-sm-10">
                        <input type="text" name="directartist" class="form-control" value="{{isset($editdata->direct_artist)?$editdata->direct_artist:old('directartist')}}">
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
                    @if(isset($artistsFromDb))
                    @foreach($artistsFromDb as $afdb)
                    <tr>
                        <td>
                            @php $artistId = $afdb['artist_id']; @endphp
                            <!-- @php $artistRole = $afdb['artist_role']; @endphp -->
                            <select name="artist[]">
                                @foreach($artists as $ar)
                                <option value="{{$ar->id}}" {{$ar->id == $artistId ? 'selected' : ''}}>{{$ar->artists_name}}</option>
                                @endforeach
                            </select>
                    
                        </td>
                        <td>

                            @php $artistRole = $afdb['artist_role']; @endphp
                            <select name="artistrole[]">
                                <option value="actress"  {{$artistRole == "actress"  ? 'selected' : ''}}>Actress</option>
                                <option value="actor" {{$artistRole == 'actor'  ? 'selected' : ''}} >Actor</option>
                                <option value="producer" {{$artistRole == "producer"  ? 'selected' : ''}}>Producer</option>
                                <option value="director" {{$artistRole == "director"  ? 'selected' : ''}}>Director</option>
                                <option value="writer" {{$artistRole == "writer"  ? 'selected' : ''}}>Writer</option>

                            </select>
                            <button type="button" class="close" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    <tbody class="newrow">
                        
                    </tbody>
                </table>
                <div class="artisterror"></div>
                <br>
                <button class="btn btn-default" id="addmorebtn">Add Artist</button>
                <br><br>
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

        $('#image').on('change', function () {
            var fileOrg = '';
            var widthOfImg = '';
            var heightOfImg = '';
            var file = $('input#image').val();
            if (file != '') {
                var fileSize = $('input#image')[0].files[0].size;
                if (fileSize > 2097152) {
                    $('.subBtn').prop('disabled', true);
                    $('.image-error').html('<strong style="color: red;">Max size 2 mb only !</strong>');
                } else {
                    var ext = $('input#image').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg']) == -1) {
                        $('.subBtn').prop('disabled', true);
                        $('.image-error').html('<strong style="color: red;">Invalid Image Format !</strong>');
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
                                    $('.image-error').html('<strong style="color: red;">Invalid Image Dimension !</strong>');
                                    $('.subBtn').prop('disabled', true);
                                } else {
                                    $('.image-error').html('');
                                    $('.subBtn').prop('disabled', false);
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
            var file = $('input#bannerimage').val();
            if (file != '') {
                var fileSize = $('input#bannerimage')[0].files[0].size;
                if (fileSize > 2097152) {
                    $('.subBtn').prop('disabled', true);
                    $('.bannerimage-error').html('<strong style="color: red;">Max size 2 mb only !</strong>');
                } else {
                    var ext = $('input#bannerimage').val().split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg']) == -1) {
                        $('.subBtn').prop('disabled', true);
                        $('.bannerimage-error').html('<strong style="color: red;">Invalid Image Format !</strong>');
                    } else {
                        var fileInput = $(this)[0],
                            fileOrg = fileInput.files && fileInput.files[0];

                        if (fileOrg) {
                            var img = new Image();

                            img.src = window.URL.createObjectURL(fileOrg);

                            img.onload = function () {
                                widthOfImg = img.naturalWidth;
                                heightOfImg = img.naturalHeight;

                                if (widthOfImg != 1280 && heightOfImg != 490) {
                                    $('.bannerimage-error').html('<strong style="color: red;">Invalid Image Dimension !</strong>');
                                    $('.subBtn').prop('disabled', true);
                                } else {
                                    $('.bannerimage-error').html('');
                                    $('.subBtn').prop('disabled', false);
                                }
                            };
                        }

                    }
                }
            }
        });

        $(window).on('load', function(){
            var genreData = "{{$editdata->genre}}";
            $(document).find('select[name=genre]').val(genreData);

            var distributordata = "{{$editdata->distributor}}";
            $(document).find('select[name=distributor]').val(distributordata);
            
            var filmformatdata = "{{$editdata->filmformat}}";
            $(document).find('select[name=filmformat]').val(filmformatdata);

            var statusdata = "{{$editdata->status}}";
            $(document).find('select[name=status]').val(statusdata);

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
      

    $('.close').on('click',function(){
        $(this).parent().parent().remove();
    });
    </script>
    <style type="text/css">
        .artisterror{
            color:red;
        }
    </style>
@stop
