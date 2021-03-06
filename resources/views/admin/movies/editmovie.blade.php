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

        .info-span {
            font-size: 18px;
            text-align: center;
            font-weight: 600;
            color: magenta;
        }

        small {
            color: red;
        }

        span.note {
            font-size: 11px;
            margin: 0;
            padding: 0;
        }

        .artist-avatar-error {
            text-transform: lowercase;
        }

        .subModalBtn {
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
                            <h5>Edit Movie</h5>
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
                                        <form class="form" role="form" autocomplete="off"
                                              action="{{url('admin/box-office/movies/update/'.$editdata->id)}}"
                                              method="post" id="submitmovie" enctype="multipart/form-data">
                                            {{csrf_field()}}

                                            <div class="form-group row">
                                                <label for="movieTitle"
                                                       class="col-lg-3 col-form-label form-control-label">Title <span
                                                            class="req">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="movieTitle" name="movieTitle"
                                                           class="form-control"
                                                           value="{{ isset($editdata->movie_title)?$editdata->movie_title:old('movieTitle') }}"
                                                           onfocus="removeError();" placeholder="Enter Movie Name">
                                                    @if($errors->has('movieTitle'))
                                                        <span class="help-block">
                                <strong>{{$errors->first('movieTitle')}}</strong>
                            </span>
                                                    @endif
                                                    <span class="movieTitle-error error help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="movieTitle"
                                                       class="col-lg-3 col-form-label form-control-label">Short Name
                                                    <span class="req">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="movieShortName" name="movieShortName"
                                                           class="form-control"
                                                           value="{{ isset($editdata->movie_short_name)?$editdata->movie_short_name:old('movieShortName') }}"
                                                           onfocus="removeError();"
                                                           placeholder="Enter Movie Short Name">
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
                                                    <textarea name="synopsis" id="synopsis" rows="5"
                                                              class="form-control" placeholder="Type synopsis"
                                                              onfocus="removeError();"
                                                              value="">{{ isset($editdata->synopsis)?$editdata->synopsis:old('synopsis') }}</textarea>
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
                                                <label for="Genre" class="col-lg-3 col-form-label form-control-label">Genre<span
                                                            class="req">*</span></label>
                                                <div class="col-sm-3">
                                                    <select name="genre" class="custom-select" onfocus="removeError();">
                                                        <option value="">Select Genre</option>
                                                        <option value="3D" @if ($editdata->genre == "3D") {{ 'selected' }} @endif>
                                                            3D
                                                        </option>
                                                        <option value="action" @if ($editdata->genre == "action") {{ 'selected' }} @endif>
                                                            Action
                                                        </option>
                                                        <option value="adventure" @if ($editdata->genre == "adventure") {{ 'selected' }} @endif>
                                                            Adventure
                                                        </option>
                                                        <option value="alternativecontent" @if ($editdata->genre == "alternativecontent") {{ 'selected' }} @endif>
                                                            Alernative Content
                                                        </option>
                                                        <option value="animated" @if ($editdata->genre == "animated") {{ 'selected' }} @endif>
                                                            Animated
                                                        </option>
                                                        <option value="asian" @if ($editdata->genre == "asian") {{ 'selected' }} @endif>
                                                            Asian
                                                        </option>
                                                        <option value="ballet" @if ($editdata->genre == "ballet") {{ 'selected' }} @endif>
                                                            Ballet
                                                        </option>
                                                        <option value="biography" @if ($editdata->genre == "biography") {{ 'selected' }} @endif>
                                                            Biography
                                                        </option>
                                                        <option value="blackcomedy" @if ($editdata->genre == "blackcomedy") {{ 'selected' }} @endif>
                                                            Black Comedy
                                                        </option>
                                                        <option value="children" @if ($editdata->genre == "children") {{ 'selected' }} @endif>
                                                            Children
                                                        </option>
                                                        <option value="classic" @if ($editdata->genre == "classic") {{ 'selected' }} @endif>
                                                            Classic
                                                        </option>
                                                        <option value="comedy" @if ($editdata->genre == "comedy") {{ 'selected' }} @endif>
                                                            Comedy
                                                        </option>
                                                        <option value="concert" @if ($editdata->genre == "concert") {{ 'selected' }} @endif>
                                                            Concert
                                                        </option>
                                                        <option value="crime" @if ($editdata->genre == "crime") {{ 'selected' }} @endif>
                                                            Crime
                                                        </option>
                                                        <option value="dance" @if ($editdata->genre == "dance") {{ 'selected' }} @endif>
                                                            Dance
                                                        </option>
                                                        <option value="docu-drama" @if ($editdata->genre == "docu-drama") {{ 'selected' }} @endif>
                                                            Docu-Drama
                                                        </option>
                                                        <option value="documentary" @if ($editdata->genre == "documentary") {{ 'selected' }} @endif>
                                                            Documentary
                                                        </option>
                                                        <option value="drama" @if ($editdata->genre == "drama") {{ 'selected' }} @endif>
                                                            Drama
                                                        </option>
                                                        <option value="family" @if ($editdata->genre == "family") {{ 'selected' }} @endif>
                                                            Family
                                                        </option>
                                                        <option value="fantasy" @if ($editdata->genre == "fantasy") {{ 'selected' }} @endif>
                                                            Fantasy
                                                        </option>
                                                        <option value="festival" @if ($editdata->genre == "festival") {{ 'selected' }} @endif>
                                                            Festival
                                                        </option>
                                                        <option value="Foreign" @if ($editdata->genre == "Foreign") {{ 'selected' }} @endif>
                                                            Foreign
                                                        </option>
                                                        <option value="horror" @if ($editdata->genre == "horror") {{ 'selected' }} @endif>
                                                            Horror
                                                        </option>
                                                        <option value="liveconcert" @if ($editdata->genre == "liveconcert") {{ 'selected' }} @endif>
                                                            Live Concert
                                                        </option>
                                                        <option value="liveshow" @if ($editdata->genre == "liveshow") {{ 'selected' }} @endif>
                                                            Live Show
                                                        </option>
                                                        <option value="livesportsbroadcast" @if ($editdata->genre == "livesportsbroadcast") {{ 'selected' }} @endif>
                                                            Live Sports Broadcast
                                                        </option>
                                                        <option value="livetheatre" @if ($editdata->genre == "livetheatre") {{ 'selected' }} @endif>
                                                            Live Theatre
                                                        </option>
                                                        <option value="marshalarts" @if ($editdata->genre == "marshalarts") {{ 'selected' }} @endif>
                                                            Marshal Arts
                                                        </option>
                                                        <option value="Musicall" @if ($editdata->genre == "Musicall") {{ 'selected' }} @endif>
                                                            Musical
                                                        </option>
                                                        <option value="mystery" @if ($editdata->genre == "mystery") {{ 'selected' }} @endif>
                                                            Mystery
                                                        </option>
                                                        <option value="opera" @if ($editdata->genre == "opera") {{ 'selected' }} @endif>
                                                            Opera
                                                        </option>
                                                        <option value="periodrama" @if ($editdata->genre == "periodrama") {{ 'selected' }} @endif>
                                                            Period Drama
                                                        </option>
                                                        <option value="romance" @if ($editdata->genre == "romance") {{ 'selected' }} @endif>
                                                            Romance
                                                        </option>
                                                        <option value="sciencefiction" @if ($editdata->genre == "sciencefiction") {{ 'selected' }} @endif>
                                                            Science Fiction
                                                        </option>
                                                        <option value="shortfilm" @if ($editdata->genre == "shortfilm") {{ 'selected' }} @endif>
                                                            Short Film
                                                        </option>
                                                        <option value="sports" @if ($editdata->genre == "sports") {{ 'selected' }} @endif>
                                                            Sports
                                                        </option>
                                                        <option value="supernatural" @if ($editdata->genre == "supernatural") {{ 'selected' }} @endif>
                                                            Supernatural
                                                        </option>
                                                        <option value="suspense" @if ($editdata->genre == "suspense") {{ 'selected' }} @endif>
                                                            Suspense
                                                        </option>
                                                        <option value="teens" @if ($editdata->genre == "teens") {{ 'selected' }} @endif>
                                                            Teen
                                                        </option>
                                                        <option value="thriller" @if ($editdata->genre == "thriller") {{ 'selected' }} @endif>
                                                            Thriller
                                                        </option>
                                                        <option value="unknown" @if ($editdata->genre == "unknown") {{ 'selected' }} @endif>
                                                            Unknown
                                                        </option>
                                                        <option value="war" @if ($editdata->genre == "war") {{ 'selected' }} @endif>
                                                            War
                                                        </option>
                                                        <option value="western" @if ($editdata->genre == "western") {{ 'selected' }} @endif>
                                                            Western
                                                        </option>
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
                                                <label for="distributor"
                                                       class="col-lg-3 col-form-label form-control-label">Distributor<span
                                                            class="req">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="custom-select" name="distributor"
                                                            onfocus="removeError();">
                                                        <option value="">Select Distributor</option>
                                                        <option value="gopikrishna" @if ($editdata->distributor == "gopikrishna") {{ 'selected' }} @endif>
                                                            Gopi Krishna
                                                        </option>
                                                        <option value="barahimovies" @if ($editdata->distributor == "barahimovies") {{ 'selected' }} @endif>
                                                            Barahi Movies
                                                        </option>
                                                        <option value="blackhorse" @if ($editdata->distributor == "blackhorse") {{ 'selected' }} @endif >
                                                            Black Horse Creation
                                                        </option>
                                                        <option value="aamasaraswoti" @if ($editdata->distributor == "aamasaraswoti") {{ 'selected' }} @endif>
                                                            Aama Saraswoti
                                                        </option>
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
                                                <label for="openingshow"
                                                       class="col-lg-3 col-form-label form-control-label">Opening Date
                                                    <span class="req">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" id="openingdate" name="openingdate"
                                                           class="form-control"
                                                           value="{{ isset($editdata->openingdate)?$editdata->openingdate:old('openingdate') }}"
                                                           onfocus="removeError();" placeholder="Choose Opening Date">
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
                                                    <input type="text" id="content" name="movie_content" class="form-control"
                                                           value="{{ isset($editdata->content)?$editdata->content:old('content') }}">
                                                    @if($errors->has('movie_content'))
                                                        <span class="help-block">
                                                            <strong>{{$errors->first('movie_content')}}</strong>
                                                        </span>
                                                    @endif
                                                    <span class="content-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="duration"
                                                       class="col-lg-3 col-form-label form-control-label">Duration <span
                                                            class="req">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" id="duration" name="duration"
                                                           class="form-control" placeholder="Duration in minutes only"
                                                           value="{{ isset($editdata->duration)?$editdata->duration:old('duration') }}"
                                                           onfocus="removeError();">
                                                    @if($errors->has('duration'))
                                                        <span class="help-block">
                                <strong>{{$errors->first('duration')}}</strong>
                            </span>
                                                    @endif
                                                    <span class="duration-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="isrestricted"
                                                       class="col-lg-3 col-form-label form-control-label">Restricted
                                                    <span class="req">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="checkbox" id="isrestricted" name="isrestricted"
                                                           value="restricted" {{ isset($editdata->isrestricted)?'checked':''}}>
                                                    @if($errors->has('isrestricted'))
                                                        <span class="help-block">
                                <strong>{{$errors->first('isrestricted')}}</strong>
                            </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="displaysequence"
                                                       class="col-lg-3 col-form-label form-control-label">Display
                                                    Sequence <span class="req">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" id="displaysequence" name="displaysequence"
                                                           class="form-control"
                                                           value="{{ isset($editdata->displaysequence)?$editdata->displaysequence:old('displaysequence') }}"
                                                           onfocus="removeError();">
                                                    @if($errors->has('displaysequence'))
                                                        <span class="help-block">
                                <strong>{{$errors->first('displaysequence')}}</strong>
                            </span>
                                                    @endif
                                                    <span class="displaysequence-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="filmformat"
                                                       class="col-lg-3 col-form-label form-control-label">Film
                                                    Format<span class="req">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="custom-select" name="filmformat">
                                                        <option value="">Select Film Format</option>
                                                        <option value="2Ddigital" @if ($editdata->displaysequence == "2Ddigital") {{ 'selected' }} @endif>
                                                            2D Digital
                                                        </option>
                                                        <option value="2Dfilm" @if ($editdata->displaysequence == "2Dfilm") {{ 'selected' }} @endif>
                                                            2D Film
                                                        </option>
                                                        <option value="3Ddigital" @if ($editdata->displaysequence == "3Ddigital") {{ 'selected' }} @endif>
                                                            3D Digital
                                                        </option>
                                                        <option value="3Dhfr" @if ($editdata->displaysequence == "3Dhfr") {{ 'selected' }} @endif>
                                                            3D HFR
                                                        </option>
                                                        <option value="imax" @if ($editdata->displaysequence == "imax") {{ 'selected' }} @endif>
                                                            IMAX
                                                        </option>
                                                        <option value="imax15/70" @if ($editdata->displaysequence == "imax15/70") {{ 'selected' }} @endif>
                                                            IMAX 15/70
                                                        </option>
                                                        <option value="imax3D" @if ($editdata->displaysequence == "imax3D") {{ 'selected' }} @endif>
                                                            IMAX 3D
                                                        </option>
                                                        <option value="notfilm" @if ($editdata->displaysequence == "notfilm") {{ 'selected' }} @endif>
                                                            Not a Film
                                                        </option>
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
                                                <label for="trailerurl"
                                                       class="col-lg-3 col-form-label form-control-label">Trailer URL
                                                    <span class="req">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="trailerurl" name="trailerurl"
                                                           class="form-control"
                                                           value="{{ isset($editdata->trailerurl)?$editdata->trailerurl:old('trailerurl') }}">
                                                    @if($errors->has('trailerurl'))
                                                        <span class="help-block">
                                <strong>{{$errors->first('trailerurl')}}</strong>
                            </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="filmformat"
                                                       class="col-lg-3 col-form-label form-control-label"> Rating<span
                                                            class="req">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="custom-select" name="rating">
                                                        <option value="">Select Rating</option>
                                                        <option value="PG" @if ($editdata->rating == "PG") {{ 'selected' }} @endif>
                                                            PG
                                                        </option>
                                                        <option value="UA" @if ($editdata->rating == "UA") {{ 'selected' }} @endif>
                                                            UA
                                                        </option>
                                                        <option value="U" @if ($editdata->rating == "U") {{ 'selected' }} @endif>
                                                            U
                                                        </option>
                                                        <option value="A" @if ($editdata->rating == "A") {{ 'selected' }} @endif>
                                                            A
                                                        </option>
                                                    </select>
                                                    @if($errors->has('rating'))
                                                        <span class="help-block">
                                <strong>{{$errors->first('rating')}}</strong>
                            </span>
                                                    @endif
                                                    <span class="rating-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="filmformat"
                                                       class="col-lg-3 col-form-label form-control-label"> Language<span
                                                            class="req">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="custom-select" name="language">
                                                        <option value="">Select Language</option>
                                                        <option value="nepali" @if ($editdata->language == "nepali") {{ 'selected' }} @endif>
                                                            Nepali
                                                        </option>
                                                        <option value="english" @if ($editdata->language == "english") {{ 'selected' }} @endif>
                                                            English
                                                        </option>
                                                        <option value="hindi" @if ($editdata->language == "hindi") {{ 'selected' }} @endif>
                                                            Hindi
                                                        </option>
                                                    </select>
                                                    @if($errors->has('language'))
                                                        <span class="help-block">
                                                            <strong>{{$errors->first('language')}}</strong>
                                                        </span>
                                                    @endif
                                                    <span class="language-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nationality" class="col-lg-3 col-form-label form-control-label"> Nationality<span class="req">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="custom-select" name="nationality" id="nationality">
                                                        <option value="nepali" @if ($editdata->nationality == "nepali") {{ 'selected' }} @endif>Nepali</option>
                                                        <option value="foreign" @if ($editdata->nationality == "foreign") {{ 'selected' }} @endif>Foreign</option>
                                                    </select>
                                                    @if($errors->has('nationality'))
                                                        <span class="help-block">
                                                            <strong>{{$errors->first('nationality')}}</strong>
                                                        </span>
                                                    @endif
                                                    <span class="nationality-error error help-block"></span>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Poster
                                                    Image <span class="req">*</span><br><span class="note">(Dimension 420x200 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span></label>
                                                <div class="col-lg-9">
                                                    @if(isset($editdata->image))
                                                        <img src="{{ asset('movies/posterimage/'.$editdata->image) }}"
                                                             alt="Poster Image" class="img img-responsive">
                                                    @endif
                                                    <br><br>
                                                    <label class="custom-file">
                                                        <input onfocus="removeError();" type="file" id="image"
                                                               name="image" class="custom-file-input"
                                                               value="{{old('image')}}">
                                                        @if($errors->has('image'))
                                                            <span class="help-block error">
                                                        <strong>
                                                            {{$errors->first('image')}}
                                                        </strong>
                                                    </span>
                                                        @endif

                                                        <span class="custom-file-control image-filename"></span>
                                                        <span class="image-error error help-block"></span>
                                                    </label>

                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Banner Image <span class="req">*</span>
                                                    <span class="note">(Dimension 1280x490 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span></label>
                                                <div class="col-lg-9">
                                                    @if(isset($editdata->image))
                                                        <img src="{{ asset('movies/bannerimage/'.$editdata->banner_image) }}"
                                                             alt="Banner Image" class="img img-responsive">
                                                    @endif
                                                    <br><br>
                                                    <label class="custom-file">
                                                        <input onfocus="removeError();" type="file" id="bannerimage"
                                                               name="bannerimage" class="custom-file-input"
                                                               value="{{old('bannerimage')}}">
                                                        @if($errors->has('bannerimage'))
                                                            <span class="help-block error">
                                                        <strong>
                                                            {{$errors->first('bannerimage')}}
                                                        </strong>
                                                    </span>
                                                        @endif

                                                        <span class="custom-file-control bannerimage-filename"></span>
                                                        <span class="bannerimage-error error help-block"></span>
                                                    </label>

                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="status" class="col-lg-3 col-form-label form-control-label">Status<span
                                                            class="req">*</span></label>
                                                <div class="col-sm-3">
                                                    <select class="custom-select" name="status">
                                                        <option value="active" @if ($editdata->status == "active") {{ 'selected' }} @endif>
                                                            Active
                                                        </option>
                                                        <option value="inactive" @if ($editdata->status == "inactive") {{ 'selected' }} @endif>
                                                            Inactive
                                                        </option>
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
                                                <label class="col-lg-3 col-form-label form-control-label"
                                                       for="directartist">Movie Artists</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="directartist" class="form-control"
                                                           value="{{isset($editdata->direct_artist)?$editdata->direct_artist:old('directartist')}}">
                                                </div>
                                            </div>
                                            <hr>

                                            <section class="content-header">
                                                <h1>
                                                    People
                                                </h1>
                                                <p>Add or remove actors, directors, producers and writers for this film
                                                    below</p>
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
                                                                    <option value="actress" {{$artistRole == "actress"  ? 'selected' : ''}}>
                                                                        Actress
                                                                    </option>
                                                                    <option value="actor" {{$artistRole == 'actor'  ? 'selected' : ''}} >
                                                                        Actor
                                                                    </option>
                                                                    <option value="producer" {{$artistRole == "producer"  ? 'selected' : ''}}>
                                                                        Producer
                                                                    </option>
                                                                    <option value="director" {{$artistRole == "director"  ? 'selected' : ''}}>
                                                                        Director
                                                                    </option>
                                                                    <option value="writer" {{$artistRole == "writer"  ? 'selected' : ''}}>
                                                                        Writer
                                                                    </option>

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


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-9">
                                                    <button type="submit" id="submitmovie"
                                                            class="btn btn-danger subModalBtn subBtn">Update
                                                    </button>
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
            format: 'yyyy-mm-dd',
            startDate: today,
        });
        $('#submitmovie').on('submit', function (e) {
            $('.error').html('');
            if ($('span.image-error').html() != '') {
                e.preventDefault();
            }

            if ($('span.bannerimage-error').html() != '') {
                e.preventDefault();
            }

            if ($('#movieTitle').val() == '') {
                e.preventDefault();
                $('.movieTitle-error').html('<strong>Please enter the Movie Title.</strong>');
            }

            if ($('#movieShortName').val() == '') {
                e.preventDefault();
                $('.movieShortName-error').html('<strong>Please enter the Movie Short Name.</strong>');
            }

            if ($('#synopsis').val() == '') {
                e.preventDefault();
                $('.synopsis-error').html('<strong>Please enter the Movie Synopsis.</strong>');
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
            } else {
                var value = $('#duration').val();
                var regex = new RegExp(/^\+?[0-9]+$/);
                if (!value.match(regex)) {
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

            if ($('select[name=rating]').val() == '') {
                e.preventDefault();
                $('.rating-error').html('<strong>Please enter the Movie Rating.</strong>');
            }

            if ($('select[name=language]').val() == '') {
                e.preventDefault();
                $('.language-error').html('<strong>Please enter the Movie Language.</strong>');
            }

            if ($('select[name=nationality]').val() == '') {
                e.preventDefault();
                $('.nationality-error').html('<strong>Please enter the Movie Nationality.</strong>');
            }
            if ($('#trailerurl').val() == '') {
                e.preventDefault();
                $('.trailerurl-error').html('<strong>Please enter the Movie Trailer Url.</strong>');
            }

            if ($(document).find('tbody.newrow').html() != '') {
                var empty = 0;
                $(document).find('select.artist-select').each(function () {
                    if ($(this).val() == '') {
                        empty = 1;
                    }
                });

                $(document).find('select.artist-role-select').each(function () {
                    if ($(this).val() == '') {
                        empty = 1;
                    }
                });

                if (empty == 1) {
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
                                    $('span.image-error').html('Image dimension did not match the required dimension.');
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

                                if (widthOfImg != 1280 && heightOfImg != 490) {
                                    $('span.bannerimage-error').html('Image dimension did not match the required dimension.');
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
        $(window).on('load', function () {
            var genreData = "{{$editdata->genre}}";
            $(document).find('select[name=genre]').val(genreData);

            var distributordata = "{{$editdata->distributor}}";
            $(document).find('select[name=distributor]').val(distributordata);

            var filmformatdata = "{{$editdata->filmformat}}";
            $(document).find('select[name=filmformat]').val(filmformatdata);

            var statusdata = "{{$editdata->status}}";
            $(document).find('select[name=status]').val(statusdata);

        });

        $('#addmorebtn').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: baseurl + '/admin/box-office/movies/addmovieartists',
                type: 'get',
                success: function (data) {
                    $('.newrow').append(data);
                    $(document).find('select.artist-select').on('focus', function () {
                        $('.artisterror').html('');
                    });

                    $(document).find('select.artist-role-select').on('focus', function () {
                        $('.artisterror').html('');
                    });
                }
            });
        });


        $('.close').on('click', function () {
            $(this).parent().parent().remove();
        });

    </script>

    <style type="text/css">
        .artisterror {
            color: red;
        }
    </style>
@stop

