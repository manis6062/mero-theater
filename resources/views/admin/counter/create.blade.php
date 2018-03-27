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

        #screen-name {
            margin: 10px 0 0 0;
        }

        #seatImageSpan {
            margin: 10px 0 0 0;
            display: block;
        }

        .subBtn {
            margin: 10px 0;
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
                            <h5>Create New User</h5>
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
                                        <form action="{{url('admin/counter/counteruser/submit')}}" class="form-horizontal" id="create-form" method="post"
                                              enctype="multipart/form-data">
                                             {{csrf_field()}}
                                             <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Counter Number<span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="counter_number" value="{{old('counter_number')}}" class="form-control" id="counter-number"
                                                           onfocus="removeError();" placeholder="Enter Counter Number">

                                                @if($errors->has('counter_number'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('counter number')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                    <span class="house-seats-error error help-block">   </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">First Name
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                <input type="text" name="fname" value="{{old('fname')}}" class="form-control" id="name"
                                                       onfocus="removeError();" placeholder="Enter First Name">
                                                @if($errors->has('fname'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('fname')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="screen-name-error error help-block"></span>
                                                </div>
                                            </div>
                                              <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Last Name
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                <input type="text" name="lname" value="{{old('lname')}}" class="form-control" id="name"
                                                       onfocus="removeError();" placeholder="Enter Last Name">
                                                @if($errors->has('lname'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('lname')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="screen-name-error error help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Designation
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <select name="designation" class="custom-select">
                                                        <option value="" class="selected">Select country</option>
                                                        <option value="Tickek Seller">Tickek Seller</option>
                                                        <option value="Report Viewer">Report Viewer</option>
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Username
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                <input type="text" name="username" value="{{old('username')}}" class="form-control" id="name"
                                                       onfocus="removeError();" placeholder="Enter username">
                                                @if($errors->has('username'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('username')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="screen-name-error error help-block"></span>
                                                </div>
                                            </div>
                                             <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Password
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                <input type="password" name="password" value="{{old('password')}}" class="form-control" id="name"
                                                       onfocus="removeError();" placeholder="Enter Password">
                                                @if($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('password')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="screen-name-error error help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Email
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email"
                                                       onfocus="removeError();" placeholder="Enter Email">
                                                @if($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('email')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="screen-number-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Mobile</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" id="house-seats"
                                                           onfocus="removeError();" placeholder="Enter Phone Number">

                                                @if($errors->has('mobile'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('mobile')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                    <span class="house-seats-error error help-block">   </span>
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
        $('#create-form').on('submit', function (e) {
            $('.error').html('');
            if ($('#name').val() == '') {
                e.preventDefault();
                $('.screen-name-error').html('<strong>Please enter the  name.</strong>');
            }

            if ($('#email').val() == '') {
                e.preventDefault();
                $('.screen-number-error').html('<strong>Please enter your email.</strong>');
            }

            if ($('#available_seat').val() == '') {
                e.preventDefault();
                $('.available-seat-error').html('<strong>Please enter the seat image.</strong>');
            } else {
                var ext = $('input#available_seat').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'svg']) == -1) {
                    e.preventDefault();
                    $('.available-seat-error').html('<strong>Invalid Image Format !</strong>');
                } else {
                    var fileSize = $('input#available_seat')[0].files[0].size;
                    if (fileSize > 2097152) {
                        e.preventDefault();
                        $('.available-seat-error').html('<strong>File Size exceed max allowed size !</strong>');
                    }
                }
            }


            if ($('#selected_seat').val() == '') {
                e.preventDefault();
                $('.selected-seat-error').html('<strong>Please enter the seat image.</strong>');
            } else {
                var ext = $('input#selected_seat').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'svg']) == -1) {
                    e.preventDefault();
                    $('.selected-seat-error').html('<strong>Invalid Image Format !</strong>');
                } else {
                    var fileSize = $('input#selected_seat')[0].files[0].size;
                    if (fileSize > 2097152) {
                        e.preventDefault();
                        $('.selected-seat-error').html('<strong>File Size exceed max allowed size !</strong>');
                    }
                }
            }


            if ($('#reserved_seat').val() == '') {
                e.preventDefault();
                $('.reserved-seat-error').html('<strong>Please enter the seat image.</strong>');
            } else {
                var ext = $('input#reserved_seat').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'svg']) == -1) {
                    e.preventDefault();
                    $('.reserved-seat-error').html('<strong>Invalid Image Format !</strong>');
                } else {
                    var fileSize = $('input#reserved_seat')[0].files[0].size;
                    if (fileSize > 2097152) {
                        e.preventDefault();
                        $('.reserved-seat-error').html('<strong>File Size exceed max allowed size !</strong>');
                    }
                }
            }

            if ($('#name_list').val()) {
              var ext = $('input#name_list').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpeg', 'jpg', 'png', 'bmp', 'svg']) == -1) {
                    e.preventDefault();
                    $('.sold-seat-error').html('<strong>Invalid File Format !</strong>');
                } else {
                    var fileSize = $('input#name_list')[0].files[0].size;
                    if (fileSize > 2097152) {
                        e.preventDefault();
                        $('.name_list-error').html('<strong>File Size exceed max allowed size !</strong>');
                    }
                }  
            } 
        });

        function isNumber(evt, element) {

            var charCode = (evt.which) ? evt.which : event.keyCode

            if (
                (charCode < 48 || charCode > 57) &&
                (charCode != 8) &&
                (charCode != 110))
                return false;

            return true;
        }
        
        $('input#counter-number').keypress(function (event) {
            return isNumber(event, this)
        });
        
        $('input#house-seats').keypress(function (event) {
            return isNumber(event, this)
        });

        $('input#wheel-chair-seats').keypress(function (event) {
            return isNumber(event, this)
        });

        function removeError() {
            $('.error').html('');
        }
    </script>
@stop