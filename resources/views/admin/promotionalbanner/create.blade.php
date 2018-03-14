@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Create Promotional Banner</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/content-management/promotional-banner')}}"><i class="fa fa-meh-o"></i>Promotional Banner</a></li>
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
                        <span><i class="icol32-add"></i> Add</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form style="padding: 1% 3%;" action="{{url('admin/content-management/promotional-banner/submit')}}" class="form-horizontal" method="post" id="createForm" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="BannerName" class="col-sm-2 control-label">Name: <span class="req">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" id="banner_name" name="banner_name" class="form-control" value="{{ old('banner_name') }}">
                                </div>
                                @if($errors->has('banner_name'))
                                    <span class="help-block">
                                        <strong>
                                            {{$errors->first('banner_name')}}
                                        </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-sm-2 control-label">Image: <span class="req">*</span></label>
                                <div class="col-sm-4">
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                                @if($errors->has('image'))
                                    <span class="help-block">
                                        <strong>
                                            {{$errors->first('image')}}
                                        </strong>
                                    </span>
                                @endif
                                 (Type: jpeg,
                                jpg, png, bmp, gif, svg | Size: 2mb | Dimension: 200x200)
                            </div>

                            <div class="form-group row">
                                <label for="artistCurrentStatus" class="col-sm-2 control-label" >Description: </label>
                                <div class="col-sm-10">
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control ckeditor">{{old('banner_name')}}"</textarea>
                                    @if($errors->has('description'))
                                    <span class="help-block">
                                        <strong>
                                            {{$errors->first('description')}}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="artistEarlyLife" class="col-sm-2 control-label">Link:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="link" name="link" class="form-control" value="{{old('link')}}">
                                    @if($errors->has('link'))
                                    <span class="help-block">
                                        <strong>
                                            {{$errors->first('link')}}
                                        </strong>
                                    </span>
                                    @endif
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
        $('#createForm').on('submit', function (e) {
            if ( $('#banner_name').val() == '' || $('#image').val() == '' )
            {
                e.preventDefault();
                alertify.alert('Please fill up all required fields !');
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
                    $('.subModalBtn').prop('disabled', true);
                    alertify.alert('Max size 2 mb only !');
                } else {
                    var ext = $('input#image').val().split('.').pop().toLowerCase();
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