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
                      <h3><i class="fa fa-lock fa-4x"></i></h3>
                      <h2 class="text-center">Forgot Password?</h2>
                      <p>You can reset your password here.</p>
                      <div class="panel-body">
                        <form id="reset-form" action="{{url('forgotpassword/getLink')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                  <input id="admin-email" name="email" onfocus="this.value=''" placeholder="email address" onfocus="removeError();" class="form-control"  type="email">
                                 
                              </div>
                               <span class="admin-email-error error help-block"></span>
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">Reset Password</button>
                        </div>

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
    $('#admin-email').on('focusout', function (e) {
        e.preventDefault();
        var adminEmail=$(this).val();
        var baseurl = "<?php echo URL::to('/') ?>";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.closeResponseMessageDiv').on('click', function () {
            $('.responseMessageDiv').hide();
        });
        if ($('#admin-email').val() != '') {
         $.ajax({
            url: baseurl + '/forgotpassword/checkemail?adminEmail=' + adminEmail,
            type: 'post',
            success: function (data) {
                if (data == 'true') {
                } else {
                 $('#admin-email').focus();
                 alertify.alert("Oops ! Email you entered in incorrect. Please enter a valid email address and try again.");
             }
         }, error: function (data) {
         }
     });
     }else{
        e.preventDefault();
       
     }
 });
  
   $('#reset-form').on('submit', function (e) {
      $('.error').html('');
        
        if($('#admin-email').val()==''){
            e.preventDefault();
         $('.admin-email-error').html('<strong>Please enter your email.</strong>');
        }
        
 });
    function removeError() {
            $('.error').html('');
        }

</script>
@yield('scripts')
</body>
</html>

