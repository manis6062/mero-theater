@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Create Social Media</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/content-management/social-media')}}"><i class="fa fa-meh-o"></i> Social Media</a></li>
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
                        <span><i class="icol32-add"></i> Add New Social Media</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form style="padding: 1% 3%;" action="{{url('admin/content-management/social-media/submit')}}" class="form-horizontal" method="post" id="createForm" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="Name" class="col-sm-2 control-label">Name: <span class="req">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" id="Name" name="name" class="form-control" value="{{old('name')}}">
                                </div>
                                @if($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('name')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="Link" class="col-sm-2 control-label" >Links: <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="link" name="link" class="form-control" value="{{old('link')}}">
                                </div>
                                @if($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('link')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="Icon" class="col-sm-2 control-label">Icon: <span class="req">*</span></label>
                                <div class="col-sm-4">
                                    <input type="file" id="icon" name="icon" class="form-control">
                                </div>
                                 (Type: jpeg,
                                jpg, png, bmp, gif, svg | Size: 2mb | Dimension: 200x200)
                                @if($errors->has('icon'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('icon')}}</strong>
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
            if ( $('#name').val() == '' || $('#link').val() == '' || $('#icon').val() == '' ) 
            {
                e.preventDefault();
                alertify.alert('Please fill up all required fields !');
            }
        });


        $('#icon').on('change', function () {
            var fileOrg = '';
            var widthOfImg = '';
            var heightOfImg = '';
            var file = $('input#icon').val();
            if (file != '') {
                var fileSize = $('input#icon')[0].files[0].size;
                if (fileSize > 2097152) {
                    $('.subModalBtn').prop('disabled', true);
                    alertify.alert('Max size 2 mb only !');
                } else {
                    var ext = $('input#icon').val().split('.').pop().toLowerCase();
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

                                if (widthOfImg != 32 && heightOfImg != 32) {
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