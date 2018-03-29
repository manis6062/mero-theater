@extends('admin.layout.master1')

@section('styles')
<style>
.changepassword-form {
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
                                     @if(\Session::has('message'))
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">{{\Session::get('message')}}</p>
                                </div>
                            @endif
                                    <form action="{{url('admin/change_password/changepassword/confirmed_password')}}" class="form-horizontal" id="changepassword-form" method="post"
                                    enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Old Password
                                            <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="password" name="old_password" id="old-password" value="" class="old-password form-control" id="old-password" onfocus="this.value=''"
                                                placeholder="Enter your old password">
                                                @if($errors->has('old_password'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->first('old_password')}}
                                                    </strong>
                                                </span>
                                                @endif
                                                <span class="old-passwword-error error help-block"></span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="admin_id" id="admin-id" value="{{$id}}">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">New Password
                                                <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="password" name="password"  id="new-password" value="" class="npassword form-control"
                                                     placeholder="New Password">
                                                    @if($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('password')}}
                                                        </strong>
                                                    </span>
                                                    @endif
                                                    <span class="new-password-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Confirm Password
                                                <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="password" name="password_confirmation" id="confirm-password" value="" class="cpassword form-control" 
                                                    placeholder="Confirm Password">
                                                    <span id='message'></span>
                                                    @if($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('password_confirmation')}}
                                                        </strong>
                                                    </span>
                                                    @endif
                                                    <span class="confirm-password-error error help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-9">
                                                    <button type="submit" class="btn btn-primary">Change</button> 
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
    $('#new-password').on('focusout',function(e){
        if ($('#new-password').val() != '') {
            if($('#new-password').val().length<8){
                 e.preventDefault();
                  $('#new-password').focus();
             $('.new-password-error').html('<strong>Password should be at least 8 character long.</strong>');
            }
        }
    });
    $('#changepassword-form').on('submit', function (e) {
        $('.error').html('');
        if ($('#old-password').val() == '') {
            e.preventDefault();
             $('.old-passwword-error').html('<strong>Please enter the  your old password.</strong>');
        }

        if ($('#new-password').val() == '') {
            e.preventDefault();
             $('.new-password-error').html('<strong>Please enter the  your new password.</strong>');
        }

        if ($('#confirm-password').val() == '') {
            e.preventDefault();
            $('.confirm-password-error').html('<strong>Please confirm your password.</strong>');

        }
         if ($('#new-password').val() != '' && $('#confirm-password').val() != '' ) {
            if($('#new-password').val()!=$('#confirm-password').val()){
                 e.preventDefault();
                  $('#confirm-password').focus();
             $('.confirm-password-error').html('<strong>Password and Confirm password didnt matched.</strong>');
            }
        }
    });

        $('.old-password').on('focusout', function (e) {
        e.preventDefault();
        var opassword=$(this).val();
        var aid = document.getElementById("admin-id").value;
         if ($('#old-password').val() != '') {
             $.ajax({
                    url: baseurl + '/admin/change_password/changepassword/oldpassword?aid=' + aid+'&op='+opassword,
                    type: 'get',
                    success: function (data) {
                        if (data == 'true') {
                            
                        } else {
                             $('#old-password').focus();
                            alertify.alert("Oops ! Your old password you entered is incorrect. Please try again.");

                        }
                    }, error: function (data) {

                    }
                });
        }
               
            
    });

    
    function removeError() {
        $('.error').html('');
    }
</script>
@stop