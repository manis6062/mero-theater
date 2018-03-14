@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Edit News</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/content-management/manage-news/news')}}"><i class="fa fa-meh-o"></i> News</a></li>
            <li class="active">Edit</li>
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
                        <span><i class="icol32-add"></i> Edit News</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form style="padding: 1% 3%;" action="{{url('admin/content-management/manage-news/news/update/'.$editdata->id)}}" class="form-horizontal" method="post" id="createForm" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="Name" class="col-sm-2 control-label">News Title: <span class="req">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" id="title" name="title" class="form-control" value="{{$editdata->title}}">
                                </div>
                                @if($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('title')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="Name" class="col-sm-2 control-label">Category: <span class="req">*</span></label>
                                <div class="col-sm-2">
                                    <select name="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @if($categories)
                                           @foreach($categories as $cat)

                                                <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('category')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="Description" class="col-sm-2 control-label" >News Content:<span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="10" name="description" >{{$editdata->description}}</textarea>
                                </div>
                                @if($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="Meta Title" class="col-sm-2 control-label">Meta Title: <span class="req">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{$editdata->meta_title}}">
                                </div>
                                @if($errors->has('meta_title'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('meta_title')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="metadescription" class="col-sm-2 control-label" >Meta Description:<span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="10" name="meta_description" >{{$editdata->meta_description}}</textarea>
                                </div>
                                @if($errors->has('meta_description'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('meta_description')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="metadescription" class="col-sm-2 control-label" >Existing Image:<span class="req">*</span> </label>
                                <div class="col-sm-10">
                                    <img src="{{asset('news/'.$editdata->featured_image)}}" class="img img-responsive">
                                    <label class="control-label">Change Image</label>
                                    <input type="file" name="featured_image" id="featured_image">
                                </div>
                                (Type: jpeg,
                                jpg, png, bmp, gif, svg | Size: 2mb | Dimension: 200x200)

                                @if($errors->has('featured_image'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('featured_image')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="Caption" class="col-sm-2 control-label" >Image Caption:<span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="caption" value="{{$editdata->caption}}" class="form-control" id="caption">
                                </div>
                                @if($errors->has('caption'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('caption')}}</strong>
                                    </span>
                                @endif
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
            if ( $('#title').val() == '' || $('#category').val() == '' || $('#description').val() == '' || $('#meta_title').val() == '' || $('#meta_description').val() == '' || $('#caption').val() == '') 
            {
                e.preventDefault();
                alertify.alert('Please fill up all required fields !');
            }
        });

        $('#featured_image').on('change', function () {
            var fileOrg = '';
            var widthOfImg = '';
            var heightOfImg = '';
            var file = $('input#featured_image').val();
            if (file != '') {
                var fileSize = $('input#featured_image')[0].files[0].size;
                if (fileSize > 2097152) {
                    $('.subBtn').prop('disabled', true);
                    $('.image-error').html('<strong style="color: red;">Max size 2 mb only !</strong>');
                } else {
                    var ext = $('input#featured_image').val().split('.').pop().toLowerCase();
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

    </script>
@stop