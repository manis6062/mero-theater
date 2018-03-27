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

        .info-span {
            font-size: 18px;
            text-align: center;
            font-weight: 600;
            color: magenta;
        }

        small {
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
                            <h5>Edit Counter User</h5>
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
                                        <form action="{{url('admin/counter/counteruser/'.$editdata->id.'/update')}}"
                                              class="form-horizontal" id="create-form" method="post"
                                              enctype="multipart/form-editdata">
                                            {{csrf_field()}}
                                           <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Counter Number<span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="counter_number" value="{{$editdata->counter_number}}" class="form-control" id="display-counter"
                                                           onfocus="removeError('display-counter');" placeholder="Enter Counter Number">
                                                @if($errors->has('counter-number'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('counter-number')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                @if(isset($counterNumbers) && count($counterNumbers) > 0)
                                                        @foreach($counterNumbers as $cn)
                                                            <input type="hidden" class="usedCounterNum" value="{{$cn}}">
                                                        @endforeach
                                                <span class="info-msg"><i class="fa fa-info"></i> Counter number {{implode(',',$counterNumbers)}} is already used !</span>
                                                    @endif
                                                    <span class="counter-number-error-exists help-block">   </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">First Name
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                <input type="text" name="fname" value="{{$editdata->first_name}}" class="form-control" id="name"
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
                                                <input type="text" name="lname" value="{{$editdata->last_name}}" class="form-control" id="name"
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
                                                        <option value="" class="selected">Select designation</option>
                                                        <option {{$editdata->designation == 'Tickek Seller' ? 'selected' : ''}} value="Tickek Seller">Tickek Seller</option>
                                                        <option {{$editdata->designation == 'Report Viewer' ? 'selected' : ''}} value="Report Viewer">Report Viewer</option>
                                                    </select>
                                                </div>
                                            </div>
                                           <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Username
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                <input type="text" name="username" value="{{$editdata->username}}" class="form-control" id="display-username" 
                                                       onfocus="removeError(display-username);" placeholder="Enter username">
                                                 @if($errors->has('username'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->username}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                @if(isset($usernames) && count($usernames) > 0)
                                                        @foreach($usernames as $un)
                                                            <input type="hidden" class="usedUsername" value="{{$un}}">
                                                        @endforeach
                                              
                                                    @endif
                                                    <span class="username-error-exists help-block">   </span>
                                            </div>
                                        </div>
                                             <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Password (Optional)
                                                   </label>
                                                <div class="col-lg-9">
                                                <input type="password" name="password" value="" class="form-control" id="name"
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
                                                <input type="email" name="email" value="{{$editdata->email}}" class="form-control" id="email"
                                                       onfocus="removeError();" placeholder="Enter Email">
                                                @if($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->email}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                @if(isset($emails) && count($emails) > 0)
                                                        @foreach($emails as $em)
                                                            <input type="hidden" class="usedEmail" value="{{$em}}">
                                                        @endforeach
                                              
                                                    @endif
                                                    <span class="email-error-exists help-block">   </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Mobile</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="mobile" value="{{$editdata->mobile}}" class="form-control" id="house-seats"
                                                           onfocus="removeError();" placeholder="Enter Phone Number">
                                                           @if($errors->has('mobile'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->mobile}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                @if(isset($mobiles) && count($mobiles) > 0)
                                                        @foreach($mobiles as $mo)
                                                            <input type="hidden" class="usedMobile" value="{{$mo}}">
                                                        @endforeach
                                                    @endif
                                                    <span class="moblie-error-exists help-block">   </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-9">
                                                    <button type="submit" class="btn btn-primary">Update</button> 
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

           $('input[name=counter_number]').on('focusout', function () {

            if($(document).find('input.usedCounterNum').length > 0)
            {
                var arr = [];
                $(document).find('input.usedCounterNum').each(function(){
                    arr.push($(this).val());
                });

                
                if ($.inArray($('input[name=counter_number]').val(), arr) != -1 && $('input[name=counter_number]').val() != "{{$editdata->counter_number}}") {
                    $('.counter-number-error-exists').html('<strong>Inputted Counter Number is Already Used !</strong>');
                    $('button[type=submit]').prop('disabled', true);
                }else{
                    $('.counter-number-error-exists').html('');
                    $('button[type=submit]').prop('disabled', false);
                }
            }
        });
        $('input[name=username]').on('focusout', function () {
            if($(document).find('input.usedUsername').length > 0)
            {
                 // alert(arr);
                var arr = [];
                $(document).find('input.usedUsername').each(function(){
                    arr.push($(this).val());
                });

                
                if ($.inArray($('input[name=username]').val(), arr) != -1 && $('input[name=username]').val() != "{{$editdata->username}}") {
                    $('.username-error-exists').html('<strong>Inputted Username is Already Used !</strong>');
                    $('button[type=submit]').prop('disabled', true);
                }else{
                    $('.username-error-exists').html('');
                    $('button[type=submit]').prop('disabled', false);
                }
            }
        });
         $('input[name=email]').on('focusout', function () {

            if($(document).find('input.usedEmail').length > 0)
            {
                 //alert(arr);
                var arr = [];
                $(document).find('input.usedEmail').each(function(){
                    arr.push($(this).val());
                });
                if ($.inArray($('input[name=email]').val(), arr) != -1 && $('input[name=email]').val() != "{{$editdata->email}}") {
                    $('.email-error-exists').html('<strong>Inputted Email is Already Used !</strong>');
                    $('button[type=submit]').prop('disabled', true);
                }else{
                    $('.counter-number-error-exists').html('');
                    $('button[type=submit]').prop('disabled', false);
                }
            }
        }); 
         $('input[name=mobile]').on('focusout', function () {
            if($(document).find('input.usedMobile').length > 0)
            {
                var arr = [];
                $(document).find('input.usedMobile').each(function(){
                    arr.push($(this).val());
                });

                // alert(arr);
                if ($.inArray($('input[name=mobile]').val(), arr) != -1 && $('input[name=mobile]').val() != "{{$editdata->mobile}}") {
                    $('.moblie-error-exists').html('<strong>Inputted mobile number is Already Used !</strong>');
                    $('button[type=submit]').prop('disabled', true);
                }else{
                    $('.counter-number-error-exists').html('');
                    $('button[type=submit]').prop('disabled', false);
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

 