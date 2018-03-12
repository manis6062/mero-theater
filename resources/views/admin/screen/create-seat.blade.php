@extends('admin.layout.master')

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
    </style>

@section('main-body')
    <section class="content">
        <div class="row">
            <div class="seatDiv">
                <form action="" class="form-horizontal" id="create-form" method="post">
                    {{csrf_field()}}

                    <div class="form-group input-field">
                        <span id="seatImageSpan">Number of Columns</span>
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

                    <div class="clearfix"></div>

                    <div class="form-group input-field">
                        <span id="seatImageSpan">Number of Columns</span>
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

                    <div class="clearfix"></div>

                    <div class="form-group input-field">
                        <span id="seatImageSpan">Seat Direction</span>
                        <label class="radio-inline">
                            <input type="radio" onclick="cancelSeats(); removeError();" value="left to right"
                                   name="seat_direction">Left To Right
                        </label>
                        <label class="radio-inline">
                            <input type="radio" onclick="cancelSeats(); removeError();;" value="right to left"
                                   name="seat_direction">Right To Left
                        </label>
                        <div class="clearfix"></div>
                        @if($errors->has('seat_direction'))
                            <span class="help-block">
                        <strong>{{$errors->first('seat_direction')}}</strong>
                    </span>
                        @endif
                        <span class="seat-direction-error error help-block"></span>
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group input-field">
                        <span id="seatImageSpan">Alphabet Direction</span>
                        <label class="radio-inline">
                            <input type="radio" onclick="cancelSeats(); removeError();" value="top to bottom"
                                   name="alphabet_direction">Top To Bottom
                        </label>
                        <label class="radio-inline">
                            <input type="radio" onclick="cancelSeats(); removeError();" value="bottom to top"
                                   name="alphabet_direction">Bottom To Top
                        </label>
                        <div class="clearfix"></div>
                        @if($errors->has('alphabet_direction'))
                            <span class="help-block">
                        <strong>{{$errors->first('alphabet_direction')}}</strong>
                    </span>
                        @endif
                        <span class="alphabet-direction-error error help-block"></span>
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group input-field">
                        <input type="button" class="btn btn-danger previewBtn" value="Preview"> <i class="ajaxSpinner fa fa-spin fa-spinner" style="display: none;"></i>
                    </div>
                </form>
            </div>

            <div class="clearfix"></div>
            <div class="seat-structure-div"></div>
        </div>
    </section>
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
    </script>
@stop