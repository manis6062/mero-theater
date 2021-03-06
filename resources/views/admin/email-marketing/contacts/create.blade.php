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
                        <h5>Create New Contact</h5>
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
                                    <form class="form-horizontal" role="form" method="POST" id="create-form" action="{{ route('emailcontact.store') }}">
                                    {{csrf_field()}}
                                  

                                     @if(\Session::has('emailErrorData'))
                                    @php $validationData = \Session::get('emailErrorData');
                                    @endphp
                                    @if(count($validationData) > 0)
                                    @foreach($validationData as $vd)
                                    <span style="color: red">
                                        <strong>Error!</strong> Email {{$vd}} is already taken.
                                    </span>
                                    @endforeach
                                    @endif
                                    @endif

                                     @if(\Session::has('empty'))
                                    @php $invalidEmail= \Session::get('empty')
                                    @endphp
                                    <span style="color: red">
                                        <strong>error!</strong> Some of the fields in your excel file are empty.
                                    </span>
                                    @endif

                                    

                                    @if(\Session::has('invalidEmailData'))
                                    @php $invalidEmail= \Session::get('invalidEmailData')
                                    @endphp
                                    <span style="color: red">
                                        <strong>Message!</strong> The excel file contain invalid emails
                                    </span>
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">First Name<span class="req">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control" id="first-name"
                                            onfocus="removeError();" placeholder="Enter first name">
                                            @if($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>
                                                    {{$errors->first('first_name')}}
                                                </strong>
                                            </span>
                                            @endif

                                            <span class="first-name-error error help-block">   </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Last Name<span class="req">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control" id="last-name"
                                            onfocus="removeError();" placeholder="Enter last name">
                                            @if($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>
                                                    {{$errors->first('last_name')}}
                                                </strong>
                                            </span>
                                            @endif
                                            <span class="last-name-error error help-block">   </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email<span class="req">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="email" name="email" value="{{old('email')}}" class="form-control" id="contact-email"
                                            onfocus="removeError();" placeholder="Enter email">
                                            @if($errors->has('email'))
                                            <span class="help-block">
                                                <strong>
                                                    {{$errors->first('email')}}
                                                </strong>
                                            </span>
                                            @endif
                                            <span class="contact-email-error error help-block">   </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Group<span class="req">*</span></label>
                                        <div class="col-lg-9">
                                         <select name="group" id="contact-group" class="form-control" onfocus="removeError();">
                                            <option value="">Choose Group</option>
                                            @if ($groups)
                                            @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if($errors->has('group'))
                                        <span class="help-block">
                                            <strong>
                                                {{$errors->first('group')}}
                                            </strong>
                                        </span>
                                        @endif
                                        <span class="contact-group-error error help-block">   </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn btn-primary">Create</button> 
                                    </div>
                                </div>
                            </form>
                            <form action="{{url('admin/email-marketing/emilcontact/importExcel')}}" class="form-horizontal" id="import-form" method="post"  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Contact File List<span class="req">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="contacts-file" type="file" class="form-control" name="contacts_file" value="">
                                        <span class="note">(Max Size 2mb | Format: xlxc, xls)</span></br>
                                        @if($errors->has('contacts_file'))
                                        <span class="help-block">
                                            <strong>
                                                {{$errors->first('contacts_file')}}
                                            </strong>
                                        </span>
                                        @endif
                                        <label for="">Download :
                                            <a href="{{asset('\download\contact.xlsx')}}" attribute="downloads" target="_blank">
                                            Sample
                                        </a>
                                    </label>
                                    <span class="contact-list-error error help-block"> </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Group<span class="req">*</span></label>
                                <div class="col-lg-9">
                                 <select name="group" id="group-contact-list" class="form-control">
                                    <option value="">Choose Group</option>
                                    @if ($groups)
                                    @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if($errors->has('group'))
                                <span class="help-block">
                                    <strong>
                                        {{$errors->first('group')}}
                                    </strong>
                                </span>
                                @endif
                                <span class="group-contact-list-error error help-block">   </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-primary">Import</button> 
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- END: .main-content -->
    </div>
</div>
</div>
</div>
</div>
<!-- END: .app-main -->
@stop
@section('scripts')
<script>
   $('#create-form').on('submit', function (e) {
    $('.error').html('');

    if ($('#first-name').val() == '') {
        e.preventDefault();
        $('.first-name-error').html('<strong>Please enter the  first name.</strong>');
    }
    if ($('#last-name').val() == '') {
        e.preventDefault();
        $('.last-name-error').html('<strong>Please enter the  second name.</strong>');
    }
    if ($('#contact-email').val() == '') {
        e.preventDefault();
        $('.contact-email-error').html('<strong>Please enter the email.</strong>');
    }
    if ($('#contact-group').val() == '') {
        e.preventDefault();
        $('.contact-group-error').html('<strong>Please select the group.</strong>');
    }
});
   $('#import-form').on('submit', function (e) {
    $('.error').html('');
    if ($('#contacts-file').val() == '') {
        e.preventDefault();
        $('.contact-list-error').html('<strong>Please Upload the contact list.</strong>');
    }else{
            var ext = $('input#contacts-file').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['xlsx','xls']) == -1) {
                e.preventDefault();
                $('.excel-file-error').html('<strong>Invalid File Format !</strong>');
            } else {
                var fileSize = $('input#contacts-file')[0].files[0].size;
                if (fileSize > 204800) {
                    e.preventDefault();
                    $('.excel-file-error').html('<strong>File Size exceed max allowed size !</strong>');
                }
            }
        }
    if ($('#group-contact-list').val() == '') {
        e.preventDefault();
        $('.group-contact-list-error').html('<strong>Please select the group.</strong>');
    }
});
   function removeError() {
    $('.error').html('');
}
</script>
@stop