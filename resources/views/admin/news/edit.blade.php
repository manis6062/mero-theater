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
                            <h5>Create News</h5>
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
            <form class="form" role="form" autocomplete="off" action="{{url('admin/content-management/manage-news/news/submit')}}"  method="post" id="createForm" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">News Title <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                <input type="text" id="title" name="title" class="form-control" value="{{$editdata->title}}" onfocus="removeError();" placeholder="Enter Title">
                                                                  @if($errors->has('title'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('title')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="title-error error help-block"></span>
                                                            </div>
                                                        </div>
                                                 
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Category <span class="req">*</span></label>
                                                            <div class="col-lg-9">
  <select name="category" class="custom-select">
                                        <option value="">Select Category</option>
                                        @if($categories)
                                           @foreach($categories as $cat)
                                                <option value="{{$cat->id}}"  @if ($editdata->category == $cat->id) {{ 'selected' }} @endif>{{$cat->category_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
   @if($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('category')}}</strong>
                                    </span>
                                @endif
                                                <span class="category-error error help-block"></span>
                                                            </div>
                                                        </div>


                                                             <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">News Content<span class="req">*</span></label>
                                                            <div class="col-lg-9">
 <textarea name="description" id="description" rows="5" class="form-control" placeholder="Type News Contents" onfocus="removeError();" >{{$editdata->description}}</textarea>
   @if($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('description')}}</strong>
                                    </span>
                                @endif
                                                <span class="description-error error help-block"></span>
                                                            </div>
                                                        </div>


                                                               <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Meta Title <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{$editdata->meta_title}}" onfocus="removeError();" placeholder="Enter Meta Title">
                                                                  @if($errors->has('meta_title'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('meta_title')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="meta_title-error error help-block"></span>
                                                            </div>
                                                        </div>

                                                           <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Meta Description<span class="req">*</span></label>
                                                            <div class="col-lg-9">
 <textarea name="meta_description" id="meta_description" rows="5" class="form-control" placeholder="Type Meta Description" onfocus="removeError();" >{{$editdata->meta_description}}</textarea>
   @if($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('meta_description')}}</strong>
                                    </span>
                                @endif
                                                <span class="meta_description-error error help-block"></span>
                                                            </div>
                                                        </div>


                                                           <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Featured Image<br><span class="note">(Dimension 200x200 | Max Size 2mb | Format jpeg, jpg, png, bmp, svg)</span></label>

                                                            <div class="col-lg-9">
                                                                 <img src="{{asset('news/'.$editdata->featured_image)}}" class="img img-responsive">
                                                                 <br><br>
                                                                <label class="custom-file">
                                                                  <input  onfocus="removeError();" type="file" id="featured_image file2" name="featured_image" class="custom-file-input" value="{{old('featured_image')}}">
                                                                   @if($errors->has('featured_image'))
                                                    <span class="help-block error">
                                                        <strong>
                                                            {{$errors->first('featured_image')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                               
                                                                    <span class="custom-file-control featured_image-filename" ></span>
                                                                     <span class="featured_image-error error help-block"></span>
                                                                </label>

                                                            </div>
                                                        </div>


                                                            <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Caption <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                <input type="text" id="caption" name="caption" class="form-control" value="{{$editdata->caption}}" onfocus="removeError();" placeholder="Enter Caption">
                                                                  @if($errors->has('caption'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('caption')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="caption-error error help-block"></span>
                                                            </div>
                                                        </div>

                                        



                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Status <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                  <select name="status" class="custom-select">
                                        <option value="active"  @if ($editdata->category == 'active') {{ 'selected' }} @endif>Active</option>
                                        <option value="inactive" @if ($editdata->category == 'inactive') {{ 'selected' }} @endif>InActive</option>
                                    </select>
                                                                  @if($errors->has('status'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('status')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="status-error error help-block"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                                            <div class="col-lg-9">
                                                                <button type="submit" class="btn btn-primary subModalBtn">Update</button>
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
     
             $('#createForm').on('submit', function (e) {

           $('.error').html('');
            if ($('#title').val() == '') {
                e.preventDefault();
                $('.title-error').html('<strong>Please enter the title.</strong>');
            }

             if ($('#category').val() == '') {
                e.preventDefault();
                $('.category-error').html('<strong>Please select the category.</strong>');
            }

                 if ($('#description').val() == '') {
                e.preventDefault();
                $('.description-error').html('<strong>Please enter the contents.</strong>');
            }

                 if ($('#meta_title').val() == '') {
                e.preventDefault();
                $('.meta_title-error').html('<strong>Please enter the meta title.</strong>');
            }

                 if ($('#meta_description').val() == '') {
                e.preventDefault();
                $('.meta_description-error').html('<strong>Please enter the meta description.</strong>');
            }


               if ($('#caption').val() == '') {
                e.preventDefault();
                $('.caption-error').html('<strong>Please enter the caption.</strong>');
            }

                if ($('#status').val() == '') {
                e.preventDefault();
                $('.caption-error').html('<strong>Please select the status</strong>');
            }

        });

             $('input[type="file"]').on('change', function () {
            var fileOrg = '';
            var widthOfImg = '';
            var heightOfImg = '';
            var file = $('input[type="file"]').val();
             $(".featured_image-filename").text(file);
            if (file != '') {
                var fileSize = $('input[type="file"]')[0].files[0].size;
                if (fileSize > 2097152) {
                    $('.subModalBtn').prop('disabled', true);
                    alertify.alert('Max size 2 mb only !');
                     $(".featured_image-filename").text('');
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

                                if (widthOfImg != 200 && heightOfImg != 200) {
                                    alertify.alert('Invalid Image Dimension ! Image Size Must be 200*200.');
                                    $('.subModalBtn').prop('disabled', true);
                                                         $(".featured_image-filename").text('');

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

