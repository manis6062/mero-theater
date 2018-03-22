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

        .info-msg {
            font-size: 15px;
            text-align: center;
            font-weight: 500;
            color: darkblue;
        }

        small {
            color: red;
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
                            <h5>Create Ticket Type</h5>
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
                                        <form action="{{url('admin/box-office/ticket-types/submit')}}" class="form" role="form" autocomplete="off"  id="create-form"
                                              method="post" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Description <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <textarea name="description" id="description" onfocus="removeError('description');" placeholder="Enter Ticket Description" class="form-control" type="text" rows="5">{{old('description')}}</textarea>
                                                    @if($errors->has('description'))
                                                        <span class="help-block error">
                                                            <strong>
                                                                {{$errors->first('description')}}
                                                            </strong>
                                                        </span>
                                                    @endif
                                                    <span class="description-error error help-block"></span>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Label <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="label" value="{{old('label')}}" class="form-control" id="label"
                                                           onfocus="removeError('label');" placeholder="Enter Ticket Label">
                                                    @if($errors->has('label'))
                                                        <span class="help-block error">
                                                            <strong>
                                                                {{$errors->first('label')}}
                                                            </strong>
                                                        </span>
                                                    @endif
                                                    <span class="label-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Select Ticket Class <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <select name="ticket_class_id" id="ticket_class_id" class="custom-select" onfocus="removeError('ticket-class');">
                                                        <option value="">-- Select Ticket Class --</option>
                                                        @if(isset($ticketClasses) && $ticketClasses->count() > 0)
                                                            @foreach($ticketClasses as $tc)
                                                                <option value="{{$tc->id}}">{{$tc->class_name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @if($errors->has('ticket_class_id'))
                                                        <span class="help-block error">
                                                            <strong>
                                                                {{$errors->first('ticket_class_id')}}
                                                            </strong>
                                                        </span>
                                                    @endif
                                                    <span class="ticket-class-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Default Price <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="default_price" value="{{old('default_price')}}"
                                                           class="form-control" id="default_price"
                                                           onfocus="removeError('default-price');" placeholder="Enter Default Price">
                                                    @if($errors->has('default_price'))
                                                        <span class="help-block error">
                                                            <strong>
                                                                {{$errors->first('default_price')}}
                                                            </strong>
                                                        </span>
                                                    @endif
                                                    <span class="default-price-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Display Sequence <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="display_sequence" value="{{old('display_sequence')}}"
                                                           class="form-control" id="display_sequence"
                                                           onfocus="removeError('display-sequence');" placeholder="Enter Display Sequence">
                                                    @if($errors->has('display_sequence'))
                                                        <span class="help-block error">
                                                            <strong>
                                                                {{$errors->first('display_sequence')}}
                                                            </strong>
                                                        </span>
                                                    @endif
                                                    @if(isset($sequenceNumbers) && $sequenceNumbers->count() > 0)
                                                        @php $sequenceNumbers = $sequenceNumbers->toArray(); @endphp
                                                        @foreach($sequenceNumbers as $sq)
                                                            <input type="hidden" class="usedSqNum" value="{{$sq}}">
                                                        @endforeach
                                                        <span class="info-msg"><i class="fa fa-info"></i> Display sequence {{implode(',',$sequenceNumbers)}} is already used !</span>
                                                    @endif
                                                    <span class="display-sequence-error-exists help-block"></span>
                                                    <span class="display-sequence-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Voucher Identifier</label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="voucher_identifier" value="{{old('voucher_identifier')}}"
                                                           class="form-control" id="voucher_identifier"
                                                           onfocus="removeError('voucher-identifier');" placeholder="Enter Voucher Identifier">
                                                    @if($errors->has('voucher_identifier'))
                                                        <span class="help-block error">
                                                            <strong>
                                                                {{$errors->first('voucher_identifier')}}
                                                            </strong>
                                                        </span>
                                                    @endif
                                                    <span class="voucher-identifier-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Sales Via</label>
                                                <div class="col-lg-9">
                                                    <select name="sales_via" class="custom-select" onfocus="removeError('sales-via');">
                                                        <option value="">-- Choose Sales Via --</option>
                                                        <option value="web">WEB</option>
                                                        <option value="pos">POS</option>
                                                        <option value="kiosk">KIOSK</option>
                                                    </select>
                                                    @if($errors->has('sales_via'))
                                                        <span class="help-block error">
                                                            <strong>
                                                                {{$errors->first('sales_via')}}
                                                            </strong>
                                                        </span>
                                                    @endif
                                                    <span class="sales-via-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Ticket Type</label>
                                                <div class="col-lg-9">
                                                    <select name="ticket_type" class="custom-select" onfocus="removeError('ticket-type');">
                                                        <option value="">-- Choose Ticket Type --</option>
                                                        <option value="standard">Standard</option>
                                                        <option value="complimentary">Complimentary</option>
                                                    </select>
                                                    @if($errors->has('ticket_type'))
                                                        <span class="help-block error">
                                                            <strong>
                                                                {{$errors->first('ticket_type')}}
                                                            </strong>
                                                        </span>
                                                    @endif
                                                    <span class="ticket-type-error error help-block"></span>
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
            $('.display-sequence-error-exists').html('');
            if ($('#screen_id').val() == '') {
                e.preventDefault();
                $('.screen-id-error').html('<strong>Please select the screen.</strong>');
            }

            if ($('#description').val() == '') {
                e.preventDefault();
                $('.description-error').html('<strong>Please enter the description.</strong>');
            }

            if ($('#label').val() == '') {
                e.preventDefault();
                $('.label-error').html('<strong>Please enter the label.</strong>');
            }


            if ($('#ticket_class_id').val() == '') {
                e.preventDefault();
                $('.ticket-class-error').html('<strong>Please choose the ticket class.</strong>');
            }


            if ($('#default_price').val() == '') {
                e.preventDefault();
                $('.default-price-error').html('<strong>Please enter the default price.</strong>');
            }

            if ($('#display_sequence').val() == '') {
                e.preventDefault();
                $('.display-sequence-error').html('<strong>Please enter the display sequence.</strong>');
            }

            if($(document).find('input.usedSqNum').length > 0)
            {
                var arr = [];
                $(document).find('input.usedSqNum').each(function(){
                    arr.push($(this).val());
                });

                if ($.inArray($('#display_sequence').val(), arr) != -1) {
                    e.preventDefault();
                    $('.display-sequence-error').html('<strong>Inputted Display Sequence is Already Used !</strong>');
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
        $('input#display_sequence').keypress(function (event) {
            return isNumber(event, this)
        });

        $(document).on('keypress', '#default_price', function (event) {
            if ((event.which == 46 && $(this).val().indexOf('.') == -1)) {
                return true;
            } else if (event.which == 48) {
                return true;
            } else if (event.which == 49) {
                return true;
            } else if (event.which == 50) {
                return true;
            } else if (event.which == 51) {
                return true;
            } else if (event.which == 52) {
                return true;
            } else if (event.which == 53) {
                return true;
            } else if (event.which == 54) {
                return true;
            } else if (event.which == 55) {
                return true;
            } else if (event.which == 56) {
                return true;
            } else if (event.which == 57) {
                return true;
            } else if (event.which == 08) {
                return true;
            } else {
                return false;
            }
        });

        function removeError(text) {
            $('.'+text+'-error').html('');
        }

        $(document).find('#ticket_class_id').on('change', function () {
            $(document).find('input[name=ticket_class]').remove();
            if ($(this).val() != '') {
                var tc = $('#ticket_class_id option:selected').text();
                $(document).find('#create-form').append('<input type="hidden" name="ticket_class" value="' + tc + '">');
            } else {
                $(document).find('input[name=ticket_class]').remove();
            }
        });

        $('#display_sequence').on('focusout', function (e) {
            if($(document).find('input.usedSqNum').length > 0)
            {
                var arr = [];
                $(document).find('input.usedSqNum').each(function(){
                    arr.push($(this).val());
                });

                if ($.inArray($('#display_sequence').val(), arr) != -1) {
                    $('.display-sequence-error-exists').html('<strong>Inputted Display Sequence is Already Used !</strong>');
                }
            }
        });

        $('#display_sequence').on('focus', function (e) {
            $('.display-sequence-error-exists').html('');
        });

    </script>
@stop