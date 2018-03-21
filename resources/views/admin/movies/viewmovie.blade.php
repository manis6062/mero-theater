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
                            <h5>View Movie</h5>
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
                      <div class="form-group row">
                    <label for="movieTitle" class="col-sm-2 text-right">Title: </label>
                    <div class="col-sm-4">
                        {!! isset($editdata->movie_title)?$editdata->movie_title:''  !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="movieShortName" class="col-sm-2 text-right">Short Name:</label>
                    <div class="col-sm-4">
                       {!! isset($editdata->movie_short_name)?$editdata->movie_short_name:'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Synopsis" class="col-sm-2 text-right">Synopsis:</label>
                    <div class="col-sm-10">
                        {!! isset($editdata->synopsis)?$editdata->synopsis:'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Genre" class="col-sm-2 text-right">Genre:</label>
                    <div class="col-sm-2">
                       {!! isset($editdata->genre)?$editdata->genre:'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="distributor" class="col-sm-2 text-right">Distributor:</label>
                    <div class="col-sm-2">
                       {!! isset($editdata->distributor)?$editdata->distributor:'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="openingdate" class="col-sm-2 text-right">Opening Date:</label>
                    <div class="col-sm-4">
                        {!! isset($editdata->openingdate)?$editdata->openingdate:'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-sm-2 text-right">Content:</label>
                    <div class="col-sm-4">
                        {!! isset($editdata->content)?$editdata->content:'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="duration" class="col-sm-2 text-right">Duration:</label>
                    <div class="col-sm-4">
                        {!! isset($editdata->duration)?$editdata->duration:'' !!}
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
                    <label for="displaysequence" class="col-sm-2 text-right">Display Sequence:</label>
                    <div class="col-sm-4">
                        {!! isset($editdata->displaysequence)?$editdata->displaysequence:'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="filmformat" class="col-sm-2 text-right">Film Format:</label>
                    <div class="col-sm-2">
                        {!! isset($editdata->filmformat)?$editdata->filmformat:'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="trailerurl" class="col-sm-2 text-right">Trailer URL:</label>
                    <div class="col-sm-4">
                       {!! isset($editdata->trailerurl)?$editdata->trailerurl:'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-sm-2 text-right">Poster Image:</label>
                    <div class="col-sm-4">       
                        @if(isset($editdata->image))
                            <img src="{{ asset('movies/posterimage/'.$editdata->image) }}" alt="Poster Image" class="img img-responsive">
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bannerimage" class="col-sm-2 text-right">Banner Image:</label>
                    <div class="col-sm-4">
                        @if(isset($editdata->image))
                            <img src="{{ asset('movies/bannerimage/'.$editdata->banner_image) }}" alt="Banner Image" class="img img-responsive">
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Status" class="col-sm-2 text-right">Status:</label>
                    <div class="col-sm-2">
                       {!! isset($editdata->status)?$editdata->status:'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 control-label text-right" for="directartist">Movie Artists</label>
                    <div class="col-sm-10">
                        {!! isset($editdata->directartist)?$editdata->directartist:'' !!}
                    </div>
                </div>
                <hr>

                @if(isset($artistsFromDb))

                <section class="content-header">
                    <h1>
                        Movie Artists
                    </h1>
                </section>

                <table class="table table-bordered table-responsive table-striped">
                    <tr class="success">
                        <td>Name</td>
                        <td>Role</td>
                    </tr>
                    @foreach($artistsFromDb as $afdb)
                     @php $artistId = $afdb['artist_id']; @endphp
                     @php $artistRole = $afdb['artist_role']; @endphp
                    <tr>
                        <td>@foreach($artists as $ar){{ $ar->id == $artistId ? $ar->artists_name : ''}} @endforeach</td>
                        <td>{{$artistRole}}</td>
                    </tr>
                    @endforeach
                </table>

                @endif
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
