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

        #place {
            margin: 0 auto;
        }

        #place .seat {
            background: url("{{asset('screen/available-seat-image/'.$screen->available_seat)}}") no-repeat scroll 0 0 transparent;
            width: 25px;
            height: 25px;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 8px 0 rgba(0, 0, 0, 0.19) !important;
        }

        ul {
            margin: 0;
            padding: 0;
            display: block;
        }

        ul li {
            margin-right: 5px;
            margin-top: 5px;
            list-style: none;
            cursor: pointer;
            /*display: inline-block;*/
        }

        .seatDiv {
            text-align: center;
        }

        .alphabets {
            width: 25px;
            float: left;
            height: 25px;
            margin-top: 5px;
            padding: 0;
            text-align: center;
            text-transform: uppercase;
            border: 1px solid #c5c5c5;
        }

        .screenImg {
            display: block;
            margin-right: auto;
            margin-left: auto;
            margin-top: 10px;
        }

        .path {
            background: #000 !important;
            opacity: 0.5;
        }
    </style>

@section('main-body')
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
                <input type="button" class="btn btn-danger previewBtn" value="Preview">
            </div>
        </form>
    </div>
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
                var ajaxData = {
                    numRows: $('#num_rows').val(),
                    numcols: $('#num_columns').val(),
                    seatDir: $('input[name=seat_direction]:checked').val(),
                    alphaDir: $('input[name=alphabet_direction]:checked').val(),
                    _token: "{{csrf_token()}}"
                };

                $.ajax({
                   url: baseurl+'/admin/screens/{{$screen->slug}}/create/ajax-call',
                    type: 'post',
                    data: ajaxData,
                    success: function (data) {
                        console.log(data);
                    }, error: function(data)
                    {
                        console.log(data);
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

        }
    </script>
@stop