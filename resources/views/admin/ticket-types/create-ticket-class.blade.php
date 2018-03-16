@extends('admin.layout.master1')

@section('styles')
    <style>
        .create-ticket-div {
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

        .info-span {
            font-size: 18px;
            text-align: center;
            font-weight: 600;
            color: magenta;
        }

        small {
            color: red;
        }

        .addMoreSpan {
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            color: rebeccapurple;
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
                            <h5>Create Ticket Class</h5>
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
                            @if(\Illuminate\Support\Facades\Session::has('message') && \Illuminate\Support\Facades\Session::get('message') == 'ticket-class-not-found')
                                <div class="alert alert-danger">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">Please Enter Ticket Classes First !</p>
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <div class="artist-form">
                                        <form action="{{url('admin/box-office/ticket-types/submit-ticket-class')}}"
                                              class="form" role="form" autocomplete="off" id="create-form" method="post"
                                              enctype="multipart/form-data">
                                            {{csrf_field()}}

                                            <div class="cloneDiv">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label form-control-label">Class Name
                                                        <span class="req">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="class_name[]"
                                                               value="{{old('class_name')}}"
                                                               class="form-control class_name"
                                                               onfocus="removeError();"
                                                               placeholder="Enter Ticket Class Name">
                                                        @if($errors->has('class_name'))
                                                            <span class="help-block">
                                                            <strong>
                                                                {{$errors->first('class_name')}}
                                                            </strong>
                                                        </span>
                                                        @endif
                                                        <span class="class-name-error error help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label form-control-label">Class
                                                        Description <span class="req">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="class_description[]"
                                                               value="{{old('class_description')}}"
                                                               class="form-control class_description"
                                                               onfocus="removeError();"
                                                               placeholder="Enter Ticket Class Description">
                                                        @if($errors->has('class_description'))
                                                            <span class="help-block">
                                                            <strong>
                                                                {{$errors->first('class_description')}}
                                                            </strong>
                                                        </span>
                                                        @endif
                                                        <span class="class-description-error error help-block"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="appendClonedDiv"></div>

                                            <div class="form-group">
                                                <span class="addMoreSpan"><i class="fa fa-plus"></i> Add More</span>
                                            </div>

                                            <div class="form-group">
                                                <span class="empty-error error help-block"></span>
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
        $(document).find('.closeMessage').on('click', function () {
            $(this).parent('div').remove();
        });

        $(document).on('click', '.addMoreSpan', function () {
            var empty = 0;
            $(document).find('input.class_name').each(function () {
                if ($(this).val() == '') {
                    empty = 1;
                }
            });

            $(document).find('input.class_description').each(function () {
                if ($(this).val() == '') {
                    empty = 1;
                }
            });

            if (empty == 1) {
                alertify.alert('Please fill up the shown fields first.');
            } else {
                var cloned = $('.cloneDiv:first').clone();
                cloned.find('input').val('');
                $('.appendClonedDiv').append(cloned);
            }
        });

        $('#create-form').on('submit', function (e) {
            var empty = 0;
            $(document).find('input.class_name').each(function () {
                if ($(this).val() == '') {
                    empty = 1;
                }
            });

            $(document).find('input.class_description').each(function () {
                if ($(this).val() == '') {
                    empty = 1;
                }
            });

            if (empty == 1) {
                e.preventDefault();
                $('span.empty-error').html('<strong>You cannot leave the shown field empty !</strong>');
            }
        });


        function removeError() {
            $('.error').html('');
        }
    </script>
@stop