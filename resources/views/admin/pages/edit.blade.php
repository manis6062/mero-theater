@extends('admin.layout.master')

@section('main-body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Edit Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('admin/content-management/social-media')}}"><i class="fa fa-meh-o"></i> CEdit Page</a></li>
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
                        <span><i class="icol32-add"></i> Edit Page</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form style="padding: 1% 3%;" action="{{url('admin/content-management/manage-pages/update/'.$editdata->id)}}" class="form-horizontal" method="post" id="createForm" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="Name" class="col-sm-2 control-label">Title: <span class="req">*</span></label>
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
                                <label for="Name" class="col-sm-2 control-label">Contents: <span class="req">*</span></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="body" rows="10" >{{$editdata->body}}</textarea>
                                </div>
                                @if($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('body')}}</strong>
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
            if ( $('#title').val() == '' || $('#body').val() == '' ) 
            {
                e.preventDefault();
                alertify.alert('Please fill up all required fields !');
            }
        });

    </script>
@stop