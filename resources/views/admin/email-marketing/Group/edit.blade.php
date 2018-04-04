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
                        <h5>Create New Group</h5>
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
                                    {{ Form::model($item, array('route' => array('emailgroup.update', $item->id), 'method' => 'PUT')) }}
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Group Name<span class="req">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="name" value="{{$item->name}}" class="form-control" id="group-name"
                                            onfocus="removeError();" placeholder="Enter group name">
                                            @if($errors->has('name'))
                                            <span class="help-block">
                                                <strong>
                                                    {{$errors->first('name')}}
                                                </strong>
                                            </span>
                                            @endif
                                            <span class="group-name-error error help-block">   </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <button type="submit" class="btn btn-primary">Update</button> 
                                        </div>
                                    </div>
                                {{ Form::close() }}
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

                    if ($('#group-name').val() == '') {
                        e.preventDefault();
                        $('.group-name-error').html('<strong>Please enter the  group name.</strong>');
                    }
                });
                   function removeError() {
                    $('.error').html('');
                }
            </script>
            @stop