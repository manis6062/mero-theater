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
                            <h5>Create Coupon Code</h5>
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
            <form class="form" role="form" autocomplete="off" action="{{url('admin/coupon/update/'.$editdata->id)}}"  method="post" id="createForm" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Coupon code <span class="req">*</span></label>
                                                            <div class="col-lg-6">
                                                                 <input class="form-control" type="text"  name="code" id="code" value="{{$editdata->code}}" name="code" onfocus="removeError();" placeholder="Enter Coupon Code">
                                                                  @if($errors->has('code'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('code')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="code-error error help-block"></span>
                                                            </div>
                                                        </div>

                                                            <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Discount Type<span class="req">*</span>


                                                            </label>
                                                            <div class="col-lg-9">
                                                                <div class="form-check">
                                                                   <input class="form-check-input" type="radio" value="percentage" name="discount_type"> 
                                                                   <label class="form-check-label" for="gridCheck">
                                                                        Percentage
                                                                    </label>
                                                                    <input class="form-check-input" type="radio" value="fixed" name="discount_type" checked="checked">
                                                                    <label class="form-check-label" for="gridCheck" >
                                                                        Fixed Amount
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Discount Rate <span class="req">*</span></label>
                                                            <div class="col-lg-6">
                                                                 <input class="form-control" type="text"  name="discount_rate" id="code" value="{{$editdata->discount_rate}}" name="discount_rate" onfocus="removeError();" placeholder="Enter Discount Rate">
                                                                  @if($errors->has('discount_rate'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('discount_rate')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="code-error error help-block"></span>

                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Available Numbers</label>
                                                            <div class="col-lg-6">
                                                            <input class="form-control" type="text"  name="count" id="count" value="{{$editdata->count}}" name="count" onfocus="removeError();" placeholder="Enter Count Limit">
                                                                  @if($errors->has('count'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{$errors->first('count')}}
                                                        </strong>
                                                    </span>
                                                @endif
                                                <span class="count-error error help-block"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Expires</label>
                                                            <div class="col-lg-6">
                                                                <div class="input-group date">
                                                                  <input type="text" id="expire" name="expire" class="form-control" value="{{date('Y-m-d', strtotime($editdata->expire))}}" onfocus="removeError();" placeholder="Choose Expire Date"> <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        @if($errors->has('expire'))
                            <span class="help-block">
                                <strong>{{$errors->first('expire')}}</strong>
                            </span>
                        @endif
                        <span class="openingdate-error error help-block"></span>
                                                                 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label form-control-label">Active <span class="req">*</span></label>
                                                            <div class="col-lg-9">
                                                                <div class="form-check">
                                                                   <input class="form-check-input" type="radio" value="yes" name="status" checked="checked"> 
                                                                   <label class="form-check-label" for="gridCheck">
                                                                        Yes
                                                                    </label>
                                                                    <input class="form-check-input" type="radio" value="no" name="status" >
                                                                    <label class="form-check-label" for="gridCheck">
                                                                        No
                                                                    </label>
                                                                </div>
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

         var today = new Date();
    $("#expire").datepicker({
        format:'yyyy-mm-dd',
        startDate:today,
    });
     
             $('#createForm').on('submit', function (e) {

           $('.error').html('');
            if ($('#code').val() == '') {
                e.preventDefault();
                $('.code-error').html('<strong>Please enter the coupon code.</strong>');
            }

            
                 if ($('#discount_rate').val() == '') {
                e.preventDefault();
                $('.discount_rate-error').html('<strong>Please enter the discount rate.</strong>');
            }


                 if ($('#discount_type').val() == '') {
                e.preventDefault();
                $('.discount_type-error').html('<strong>Please enter the discount type.</strong>');
            }

                if ($('#status').val() == '') {
                e.preventDefault();
                $('.caption-error').html('<strong>Please select the status</strong>');
            }

        });


 function removeError() {
            $('.error').html('');
        }

    </script>
@stop

