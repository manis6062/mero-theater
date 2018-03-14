@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Create Contact Us</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/content-management/social-media')}}"><i class="fa fa-meh-o"></i> Contact Us</a></li>
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
                        <span><i class="icol32-add"></i> Add New Contact Us</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form style="padding: 1% 3%;" action="{{url('admin/content-management/contact-us/submit')}}" class="form-horizontal" method="post" id="createForm" enctype="multipart/form-data">
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
                                <label for="Email" class="col-sm-2 control-label" >Email: <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="email" name="email" class="form-control" value="{{old('email')}}">
                                </div>
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="Phone No." class="col-sm-2 control-label" >Phone No: <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" id="phone_no" name="phone_no" class="form-control" value="{{old('phone_no')}}">
                                </div>
                                @if($errors->has('phone_no'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('phone_no')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="Message" class="col-sm-2 control-label" >Message: </label>
                                <div class="col-sm-10">
                                    <input type="text" id="message" name="message" class="form-control" value="{{old('message')}}">
                                </div>
                                @if($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('message')}}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="Message" class="col-sm-2 control-label" >Status: <span class="req">*</span></label>
                                <div class="col-sm-2">
                                    <select name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">InActive</option>
                                    </select>
                                </div>
                                @if($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('status')}}</strong>
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
            if ( $('#name').val() == '' || $('#email').val() == '' || $('#phone_no').val() == '' ) 
            {
                e.preventDefault();
                alertify.alert('Please fill up all required fields !');
            }
        });

    </script>
@stop