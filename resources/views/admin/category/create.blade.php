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
                            <h5>Create Category</h5>
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
            <form class="form" role="form" autocomplete="off" action="{{url('admin/content-management/manage-news/manage-category/submit')}}"  method="post" id="createForm" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Category Name <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" id="category_name" value="{{old('category_name')}}" name="category_name" onfocus="removeError();" placeholder="Enter Category Name">
                                                 @if($errors->has('category_name'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('category_name')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="category_name-error error help-block"></span>
                                            </div>
                                        </div>

                                          <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Description<span class="req">*</span></label>
                                                            <div class="col-lg-9">
 <textarea name="description" value="{{old('description')}}" id="description" rows="5" class="form-control" placeholder="Type Description" onfocus="removeError();" ></textarea>
   @if($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('description')}}</strong>
                                    </span>
                                @endif
                                                <span class="description-error error help-block"></span>
                                                            </div>
                                                        </div>

                                       

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label"></label>
                                            <div class="col-lg-9">
                                                <button type="submit" class="btn btn-primary">Create</button>
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
            if ($('#category_name').val() == '') {
                e.preventDefault();
                $('.category_name-error').html('<strong>Please enter the name.</strong>');
            }

             if ($('#description').val() == '') {
                e.preventDefault();
                $('.description-error').html('<strong>Please enter the description.</strong>');
            }

        });

 function removeError() {
            $('.error').html('');
        }

    </script>
@stop
