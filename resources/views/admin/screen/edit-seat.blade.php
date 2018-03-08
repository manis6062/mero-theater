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

        .inactiveSeatLegend {
            background: url("{{asset('screen/available-seat-image/'.$screen->available_seat)}}") no-repeat scroll 0 0 transparent;
            width: 25px;
            height: 25px;
            opacity: 0.3;
        }

        #place {
            margin: 0 auto;
        }

        div.content {
            border: 1px solid #ddd;
            margin: 0 10%;
            margin-top: 20px;
        }

        #place .seat {
            background: url("{{asset('screen/available-seat-image/'.$screen->available_seat)}}") no-repeat scroll 0 0 transparent;
            width: 25px;
            height: 25px;
        }

        .seatLegend {
            background: url("{{asset('screen/available-seat-image/'.$screen->available_seat)}}") no-repeat scroll 0 0 transparent;
            width: 25px;
            height: 25px;
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

        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            padding: 5px;
        }

        .legend {
            display: flex;
            margin-bottom: 10px;
        }

        .active-legend {
            width: 130px;
        }

        .inactive-legend {
            width: 130px;
        }

        .seatLegend {
            float: left;
        }

        .inactiveSeatLegend {
            float: left;
        }

        .editPlace {
            width: 80%;
            border: 1px solid #ddd;
            margin-top: 20px !important;
            margin-left: 10%;
            margin-right: 10%;
            padding: 1%;
        }

        .span-info {
            font-size: 15px;
            color: #1155CC;
            font-weight: 600;
            text-transform: uppercase;
            text-decoration: underline;
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
                               value="{{$screenSeatData->num_rows}}" class="form-control" id="num_rows"
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
                               value="{{$screenSeatData->num_columns}}" class="form-control"
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
                                   name="seat_direction" {{$screenSeatData->seat_direction == 'left to right' ? 'checked' : ''}}>Left
                            To Right
                        </label>
                        <label class="radio-inline">
                            <input type="radio" onclick="cancelSeats(); removeError();;" value="right to left"
                                   name="seat_direction" {{$screenSeatData->seat_direction == 'right to left' ? 'checked' : ''}}>Right
                            To Left
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
                                   name="alphabet_direction" {{$screenSeatData->alphabet_direction == 'top to bottom' ? 'checked' : ''}}>Top
                            To Bottom
                        </label>
                        <label class="radio-inline">
                            <input type="radio" onclick="cancelSeats(); removeError();" value="bottom to top"
                                   name="alphabet_direction" {{$screenSeatData->alphabet_direction == 'bottom to top' ? 'checked' : ''}}>Bottom
                            To Top
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
                        <input style="display: none;" type="button" class="btn btn-danger previewBtn" value="Preview">
                        <i class="ajaxSpinner fa fa-spin fa-spinner" style="display: none;"></i>
                    </div>
                </form>
            </div>

            <div class="clearfix"></div>
            <div class="seat-structure-div">
                <div class="editPlace">
                    @php
                        $noOfRows = $screenSeatData->num_rows;
                        $noOfColumns = $screenSeatData->num_columns;
                        $seatDirection = $screenSeatData['seat_direction'];
                        $alphaDirection = $screenSeatData['alphabet_direction'];
                        $alphas = range('A', 'Z');
                        $alpCount = $noOfRows-1;
                    @endphp
                    @if($screenSeatData['path'] == '0')
                        @if ($seatDirection == 'left to right')
                            <div class="table-responsive seat-structure-main-div" id="place">
                                <div class="legend">
                                    <div class="active-legend">
                                        <div class="seatLegend"></div>
                                        <div>&nbsp;&nbsp;&nbsp;Active Seats</div>
                                    </div>

                                    <div class="inactive-legend">
                                        <div class="inactiveSeatLegend"></div>
                                        <div>&nbsp;&nbsp;&nbsp;Inactive Seats</div>
                                    </div>
                                </div>
                                <table class="table">
                                    <tbody>
                                    @for ($i = 1; $i <= $noOfRows; $i++)
                                        @php $titleCount = 0; @endphp
                                        <tr>
                                            <td>
                                                <input readonly
                                                       value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                       type="text" name="alphabets[]" class="alphabets">
                                            </td>

                                            @for ($j = 1; $j <= $noOfColumns; $j++)
                                                @php $titleCount += 1; @endphp
                                                <td id="" class="seat" onclick="seatNum('{{$i.'-'.$j}}');" data-seatnum="{{$i.'-'.$j}}"></td>
                                                @if ($j == $noOfColumns)
                                                    <td>
                                                        <input readonly style="float: right;"
                                                               value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                               type="text" class="alphabets">
                                                    </td>
                                                @endif
                                            @endfor
                                        </tr>
                                        @php $alpCount --; @endphp
                                    @endfor
                                    </tbody>
                                </table>
                                <img src="{{asset('screen/screen-image/screen.png')}}"
                                     class="img img-responsive screenImg">
                            </div>
                        @else
                            <div class="table-responsive" id="place">
                                <div class="legend">
                                    <div class="active-legend">
                                        <div class="seatLegend"></div>
                                        <div>&nbsp;&nbsp;&nbsp;Active Seats</div>
                                    </div>

                                    <div class="inactive-legend">
                                        <div class="inactiveSeatLegend"></div>
                                        <div>&nbsp;&nbsp;&nbsp;Inactive Seats</div>
                                    </div>
                                </div>
                                <table class="table">
                                    <tbody>
                                    @for ($i = 1; $i <= $noOfRows; $i++)
                                        @php $titleCount = $noOfRows; @endphp
                                        <tr>
                                            <td>
                                                <input readonly
                                                       value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                       style="" oninput="" type="text" class="alphabets">
                                            </td>

                                            @for ($j = $noOfColumns; $j >= 1; $j--)
                                                <td class="seat" onclick="seatNum('{{$i.'-'.$j}}');" data-seatnum="{{$i.'-'.$j}}"></td>
                                                @php $titleCount -= 1; @endphp
                                                @if ($j == 1)
                                                    <td>
                                                        <input readonly
                                                               value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                               style="float: right;" type="text" class="alphabets">
                                                    </td>
                                                @endif
                                            @endfor
                                        </tr>
                                        @php $alpCount --; @endphp
                                    @endfor
                                    </tbody>
                                </table>
                                <img src="{{asset('screen/screen-image/screen.png')}}"
                                     class="img img-responsive screenImg">
                            </div>
                        @endif
                    @else
                        @php $pathArr = json_decode($screenSeatData['path'], true); @endphp

                        @if ($seatDirection == 'left to right')
                            <div class="table-responsive seat-structure-main-div" id="place">
                                <div class="legend">
                                    <div class="active-legend">
                                        <div class="seatLegend"></div>
                                        <div>&nbsp;&nbsp;&nbsp;Active Seats</div>
                                    </div>

                                    <div class="inactive-legend">
                                        <div class="inactiveSeatLegend"></div>
                                        <div>&nbsp;&nbsp;&nbsp;Inactive Seats</div>
                                    </div>
                                </div>
                                <table class="table">
                                    <tbody>
                                    @for ($i = 1; $i <= $noOfRows; $i++)
                                        @php $titleCount = 0; @endphp
                                        <tr>
                                            <td>
                                                <input readonly
                                                       value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                       type="text" name="alphabets[]" class="alphabets">
                                            </td>
                                            @for ($j = 1; $j <= $noOfColumns; $j++)
                                                @if(!in_array($i.'-'.$j, $pathArr))
                                                    @php $titleCount += 1; @endphp
                                                @endif
                                                <td id="" class="{{!in_array($i.'-'.$j, $pathArr) ? 'seat' : 'inactiveSeat'}}" onclick="seatNum('{{$i.'-'.$j}}');" data-seatnum="{{$i.'-'.$j}}"></td>
                                                @if ($j == $noOfColumns)
                                                    <td>
                                                        <input readonly style="float: right;"
                                                               value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                               type="text" class="alphabets">
                                                    </td>
                                                @endif
                                            @endfor
                                        </tr>
                                        @php $alpCount --; @endphp
                                    @endfor
                                    </tbody>
                                </table>
                                <img src="{{asset('screen/screen-image/screen.png')}}"
                                     class="img img-responsive screenImg">
                            </div>
                        @else
                            <div class="table-responsive" id="place">
                                <div class="legend">
                                    <div class="active-legend">
                                        <div class="seatLegend"></div>
                                        <div>&nbsp;&nbsp;&nbsp;Active Seats</div>
                                    </div>

                                    <div class="inactive-legend">
                                        <div class="inactiveSeatLegend"></div>
                                        <div>&nbsp;&nbsp;&nbsp;Inactive Seats</div>
                                    </div>
                                </div>
                                <table class="table">
                                    <tbody>
                                    @for ($i = 1; $i <= $noOfRows; $i++)
                                        @php $titleCount = 0; @endphp
                                        @for ($j = $noOfColumns; $j >= 1; $j--)
                                            @if(!in_array($i.'-'.$j, $pathArr))
                                                @php $titleCount += 1; @endphp
                                            @endif
                                        @endfor

                                        <tr>
                                            <td>
                                                <input readonly
                                                       value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                       style="" oninput="" type="text" class="alphabets">
                                            </td>

                                            @for ($j = $noOfColumns; $j >= 1; $j--)
                                                <td class="{{!in_array($i.'-'.$j, $pathArr) ? 'seat' : 'inactiveSeat'}}" onclick="seatNum('{{$i.'-'.$j}}');" data-seatnum="{{$i.'-'.$j}}"></td>
                                                @if(!in_array($i.'-'.$j, $pathArr))
                                                    @php $titleCount -= 1; @endphp
                                                @endif

                                                @if ($j == 1)
                                                    <td>
                                                        <input readonly
                                                               value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                               style="float: right;" type="text" class="alphabets">
                                                    </td>
                                                @endif
                                            @endfor
                                        </tr>
                                        @php $alpCount --; @endphp
                                    @endfor
                                    </tbody>
                                </table>
                                <img src="{{asset('screen/screen-image/screen.png')}}"
                                     class="img img-responsive screenImg">
                            </div>
                        @endif
                    @endif
                    <span class="span-info">Click on the seats to toggle active/inactive seats.</span>
                    <form action="{{url('admin/seat-management/screens/'.$screen->slug.'/seat/update')}}" method="post"
                          id="seatStructureForm">
                        {{csrf_field()}}
                        <input type="hidden" name="numOfRows" value="{{$noOfRows}}">
                        <input type="hidden" name="numOfColumns" value="{{$noOfColumns}}">
                        <input type="hidden" name="seatDirection" value="{{$seatDirection}}">
                        <input type="hidden" name="alphabetDirection" value="{{$alphaDirection}}">
                        <input type="hidden" name="screenSeatDataId" value="{{$screenSeatData->id}}">
                        @if($screenSeatData['path'] != '0')
                            @foreach(json_decode($screenSeatData['path'], true) as $pth)
                                <input name="inactiveSeat[]" value="{{$pth}}" id="input{{$pth}}" type="hidden">
                            @endforeach
                        @endif
                        <input type="submit" value="Update" class="btn btn-lg btn-success">
                    </form>
                </div>
            </div>
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
                        $(document).find('form#seatStructureForm').removeAttr('action').attr('action', baseurl+'/admin/seat-management/screens/{{$screen->slug}}/seat/update');
                        $(document).find('form#seatStructureForm').append('<input type="hidden" name="screenSeatDataId" value="{{$screenSeatData->id}}">');
                        $(document).find('input.ajaxSubmitButton').val('Update');
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
            if ($(document).find('td[data-seatnum=' + seatNo + ']').hasClass('seat')) {
                $(document).find('td[data-seatnum=' + seatNo + ']').removeClass('seat').addClass('inactiveSeat');
                $(document).find('form#seatStructureForm').append('<input type="hidden" name="inactiveSeat[]" value="' + seatNo + '" id="input' + seatNo + '">');
            } else {
                $(document).find('td[data-seatnum=' + seatNo + ']').removeClass('inactiveSeat').addClass('seat');
                $(document).find('input#input' + seatNo + '').remove();
            }
        }
    </script>
@stop