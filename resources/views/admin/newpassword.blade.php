<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('admins/theme/img/favicon.png')}}" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MeroTheatre Dashboard Forgot Password</title>
    @include('admin.include.styles')
    <style>
    .ajs-header{
        display: none !important;
    }
    .form-gap {
        padding-top: 250px;
    }
</style>
@yield('styles')
</head>
<body>
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" >
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-unlock fa-4x"></i></h3>
                      <h2 class="text-center">Get your new password</h2>
                      <div class="panel-body">
                        <form action="{{url('forgot-password/new-password')}}" class="form-horizontal" id="new-password-form" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">password
                                <span class="req">*</span></label>
                                <div class="col-lg-9">
                                    <input type="password" id="password" name="password" value="" class="form-control" id="password"
                                    onfocus="removeError();" placeholder="Enter  new password">
                                    @if($errors->has('password'))
                                    <span class="help-block">
                                        <strong>
                                            {{$errors->first('password')}}
                                        </strong>
                                    </span>
                                    @endif
                                    <span class="password-error error help-block"></span>
                                </div>
                            </div>
                             <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Confirm Password
                                <span class="req">*</span></label>
                                 <div class="col-lg-9">
                                    <input type="password" name="confirm_password" id="confirm-password" value="" class="form-control" id="password"
                                    onfocus="removeError();" placeholder="Confirm your password password">
                                    @if($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <strong>
                                            {{$errors->first('confirm_password')}}
                                        </strong>
                                    </span>
                                    @endif
                                    <span class="confirm-password-error error help-block"></span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <button type="submit" class="btn btn-primary">Save</button> 
                                </div>
                            </div>

                            <input type="hidden" name="urltoken" value="{{$passwordToken}}">
                            <input type="hidden" class="hide" name="token" id="token" value=""> 
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@include('admin.include.scripts')
<script>
 $('#new-password-form').on('submit', function (e) {
  $('.error').html('');
  if($('#password').val()==''){
    e.preventDefault();
    $('.password-error').html('<strong>Please enter your password.</strong>');
}
 if($('#confirm-password').val()==''){
    e.preventDefault();
    $('.confirm-password-error').html('<strong>Please confirm your password.</strong>');
}
 if ($('#password').val() != '' && $('#confirm-password').val() != '' ) {
            if($('#password').val()!=$('#confirm-password').val()){
                 e.preventDefault();
                  $('#confirm-password').focus();
             $('.confirm-password-error').html('<strong>Password and Confirm password didnt matched.</strong>');
            }
        }

});
 function removeError() {
    $('.error').html('');
}
    $('#password').on('focusout',function(e){
        if ($('#password').val() != '') {
            if($('#password').val().length<8){
                 e.preventDefault();
                  $('#password').focus();
             $('.password-error').html('<strong>Password should be at least 8 character long.</strong>');
            }
        }
    });
</script>
@yield('scripts')
</body>
</html>

