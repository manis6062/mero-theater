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
                            <h5>Edit Contact Us</h5>
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
            <form class="form" role="form" autocomplete="off" action="{{url('admin/content-management/contact-us/update/'.$editdata->id)}}"  method="post" id="createForm" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Name <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                 <input class="form-control" type="text"  name="name" id="name" value="{{$editdata->name}}" name="name" onfocus="removeError();" placeholder="Enter Name">
                                                                  @if($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('name')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="name-error error help-block"></span>
                                                            </div>
                                                        </div>

                                                               <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Email <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                <input type="text" id="email" name="email" class="form-control" value="{{$editdata->email}}" onfocus="removeError();" placeholder="Enter Email">
                                                                  @if($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('email')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="email-error error help-block"></span>
                                                            </div>
                                                        </div>


                                                             <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Phone <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                <input type="text" id="phone_no" name="phone_no" class="form-control" value="{{$editdata->phone_no}}" onfocus="removeError();" placeholder="Enter Phone Number">
                                                                  @if($errors->has('phone_no'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('phone_no')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="phone_no-error error help-block"></span>
                                                            </div>
                                                        </div>


                                                          <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Message</label>
                                                            <div class="col-lg-9">
 <textarea name="message"  id="message" rows="5" class="form-control" placeholder="Type Message" onfocus="removeError();" >{{$editdata->message}}</textarea>
   @if($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('message')}}</strong>
                                    </span>
                                @endif
                                                <span class="message-error error help-block"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Status <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                  <select name="status" class="custom-select">
                                        <option value="active" @if($editdata->status == 'active'){{'selected'}} @endif>Active</option>
                                        <option value="inactive" @if($editdata->status == 'inactive'){{'selected'}} @endif>InActive</option>
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
            if ($('#name').val() == '') {
                e.preventDefault();
                $('.name-error').html('<strong>Please enter the name.</strong>');
            }

            
                 if ($('#email').val() == '') {
                e.preventDefault();
                $('.email-error').html('<strong>Please enter the email.</strong>');
            }



        });



 function removeError() {
            $('.error').html('');
        }

    </script>
@stop
