@extends('admin.layout.master1')

@section('styles')
    <style>
        .seatDiv {
            width: 80%;
            margin: 0 10%;
            border: 1px solid #ddd;
            padding: 5%;
            margin-top: 5%;
        }



        .input-field {
            width: 50% !important;
            text-align: left;
        }

        #seatImageSpan {
            display: block;
        }

        .help-block {
            display: block !important;
            color: red !important;
            font-size: 15px !important;
            font-weight: 500 !important;
        }

        .inactiveSeat {
            background: url("{{asset('screen/available-seat-image/'.$screen->available_seat)}}") no-repeat scroll 0 0 transparent;
            width: 25px;
            height: 25px;
            opacity: 0.3;
        }

        .inactiveSeatLegend {
            background: url("{{asset('screen/available-seat-image/'.$screen->available_seat)}}") no-repeat scroll 0 0 transparent;
            width: 25px;
            height: 25px;
            opacity: 0.3;
        }

        .seatLegend {
            background: url("{{asset('screen/available-seat-image/'.$screen->available_seat)}}") no-repeat scroll 0 0 transparent;
            width: 25px;
            height: 25px;
            opacity: 1;
        }
    </style>

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
                            <h5>Create Seat Structure</h5>
                            <h6 class="sub-heading">Welcome to Merotheatre Admin</h6>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="right-actions">
                            <span class="last-login">Last Login: 2 hours ago</span>
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
                                        <form action="" class="form-horizontal" id="create-form" method="post">
                                            {{csrf_field()}}

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Number Of Rows
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <input oninput="checkNumberFieldLength(this); cancelSeats();" type="text" name="num_rows"
                                                                                                                value="{{old('num_rows')}}" class="form-control" id="num_rows"
                                                                                                                onfocus="removeError();" placeholder="Enter Number of Seat Rows">
                                                    @if($errors->has('num_rows'))
                                                        <span class="help-block">
                                                            <strong>
                                                                {{$errors->first('num_rows')}}
                                                            </strong>
                                                        </span>
                                                    @endif
                                                    <span class="num-rows-error error help-block"></span>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Number Of Columns
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" oninput="checkNumberFieldLength(this); cancelSeats();" name="num_columns"
                                                           value="{{old('num_columns')}}" class="form-control"
                                                           id="num_columns"
                                                           onfocus="removeError();" placeholder="Enter Number of Seat Columns">
                                                    @if($errors->has('num_columns'))
                                                        <span class="help-block">
                                                            <strong>
                                                                {{$errors->first('num_columns')}}
                                                            </strong>
                                                        </span>
                                                    @endif
                                                    <span class="num-columns-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Seat Direction
                                                    <span class="req">*</span></label>

                                                <div class="col-lg-9">
                                                    <label class="radio-inline">
                                                        <input type="radio" onclick="cancelSeats(); removeError();" value="left to right"
                                                               name="seat_direction">&nbsp;&nbsp;&nbsp;Left To Right
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label class="radio-inline">
                                                        <input type="radio" onclick="cancelSeats(); removeError();;" value="right to left"
                                                               name="seat_direction">&nbsp;&nbsp;&nbsp;Right To Left
                                                    </label>
                                                    <div class="clearfix"></div>
                                                    @if($errors->has('seat_direction'))
                                                        <span class="help-block">
                                                            <strong>{{$errors->first('seat_direction')}}</strong>
                                                        </span>
                                                    @endif
                                                    <span class="seat-direction-error error help-block"></span>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Alphabet Direction
                                                    <span class="req">*</span></label>

                                                <div class="col-lg-9">
                                                    <label class="radio-inline">
                                                        <input type="radio" onclick="cancelSeats(); removeError();" value="top to bottom"
                                                               name="alphabet_direction">&nbsp;&nbsp;&nbsp;Top To Bottom
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label class="radio-inline">
                                                        <input type="radio" onclick="cancelSeats(); removeError();" value="bottom to top"
                                                               name="alphabet_direction">&nbsp;&nbsp;&nbsp;Bottom To Top
                                                    </label>
                                                    <div class="clearfix"></div>
                                                    @if($errors->has('alphabet_direction'))
                                                        <span class="help-block">
                                                            <strong>{{$errors->first('alphabet_direction')}}</strong>
                                                        </span>
                                                    @endif
                                                    <span class="alphabet-direction-error error help-block"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-9">
                                                    <button type="button" class="btn btn-primary previewBtn">Preview <i class="ajaxSpinner fa fa-spin fa-spinner" style="display: none;"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="clearfix"></div>
                                        <div class="seat-structure-div"></div>
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
        $(document).find('.previewBtn').on('click', function (e) {
            var error = 0;
            if ($('#num_columns').val() == '') {
                error = 1;
                $('.num-columns-error').html('<strong>This fiels is required !</strong>');
            }

            if ($('#num_rows').val() == '') {
                error = 1;
                $('.num-rows-error').html('<strong>This fiels is required !</strong>');
            }

            if (!$('input[name=seat_direction]:checked').val()) {
                error = 1;
                $('.seat-direction-error').html('<strong>This fiels is required !</strong>');
            }

            if (!$('input[name=alphabet_direction]:checked').val()) {
                error = 1;
                $('.alphabet-direction-error').html('<strong>This fiels is required !</strong>');
            }

            if (error == 0) {
                $('.ajaxSpinner').show();
                $(document).find('.previewBtn').prop('disabled', true);
                var ajaxData = {
                    numRows: $('#num_rows').val(),
                    numCols: $('#num_columns').val(),
                    seatDir: $('input[name=seat_direction]:checked').val(),
                    alphaDir: $('input[name=alphabet_direction]:checked').val(),
                    _token: "{{csrf_token()}}",
                    screenId: "{{$screen->id}}"
                };

                $.ajax({
                    url: baseurl + '/admin/seat-management/screens/{{$screen->slug}}/seat/ajax-call',
                    type: 'post',
                    data: ajaxData,
                    success: function (data) {
                        $('.ajaxSpinner').hide();
                        $(document).find('.previewBtn').prop('disabled', false);
                        $(document).find('.previewBtn').hide();
                        $(document).find('.seat-structure-div').html(data);
                    }, error: function (data) {
                        alertify.alert('Oops ! something went wrong. Please Try Again.');
                        $('.ajaxSpinner').hide();
                        $(document).find('.previewBtn').prop('disabled', false);
                        $(document).find('.seat-structure-div').html('');
                    }
                });
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
        $('input#num_rows').keypress(function (event) {
            return isNumber(event, this)
        });

        $('input#num_columns').keypress(function (event) {
            return isNumber(event, this)
        });

        function checkNumberFieldLength(elem) {
            if (elem.value.length > 2) {
                elem.value = elem.value.slice(0, 2);
            }
        }

        function removeError() {
            $('.error').html('');
        }

        function cancelSeats() {
            $(document).find('.previewBtn').show();
            $(document).find('.seat-structure-div').html('');
        }

       function seatNum(seatNo) {
            if($(document).find('td[data-seatnum='+seatNo+']').hasClass('seat'))
            {
                $(document).find('td[data-seatnum='+seatNo+']').removeClass('seat').addClass('inactiveSeat');
                $(document).find('form#seatStructureForm').append('<input type="hidden" name="inactiveSeat[]" value="'+seatNo+'" id="input'+seatNo+'">');
            }else{
                $(document).find('td[data-seatnum='+seatNo+']').removeClass('inactiveSeat').addClass('seat');
                $(document).find('input#input'+seatNo+'').remove();
            }
       }

       $(document).on('focus', 'input.category-name', function(){
            var id = $(this).data('id');
            if(id > 0)
            {
                alert('true');
                for(var i = id; i <= 0; i++)
                {
                    alert(i);
                    if($(document).find('input.category-name-'+i).val() == '')
                    {
                        $(document).find('input.category-name-'+id).blur();
                        $(document).find('span.category-name-error').html('<strong>You must fill up the given fields one by one sequentially !!!</strong>');
                    }
                }
            }
       });
    </script>
@stop