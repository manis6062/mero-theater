@extends('admin.layout.master1')

@section('styles')
    <style>
        .seatDiv {
            border: 1px solid #ddd;
            padding: 3%;
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
            border: 1px solid #ddd;
            margin-top: 20px !important;
            padding: 3%;
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
                            <h5>Edit Seat Structure</h5>
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
                                                    <input oninput="checkNumberFieldLength(this); cancelSeats();"
                                                           type="text" name="num_rows"
                                                           value="{{$screenSeatData->num_rows}}" class="form-control"
                                                           id="num_rows"
                                                           onfocus="removeError();"
                                                           placeholder="Enter Number of Seat Rows">
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
                                                <label class="col-lg-3 col-form-label form-control-label">Number Of
                                                    Columns
                                                    <span class="req">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text"
                                                           oninput="checkNumberFieldLength(this); cancelSeats();"
                                                           name="num_columns"
                                                           value="{{$screenSeatData->num_columns}}" class="form-control"
                                                           id="num_columns"
                                                           onfocus="removeError();"
                                                           placeholder="Enter Number of Seat Columns">
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
                                                        <input type="radio" onclick="cancelSeats(); removeError();"
                                                               value="left to right"
                                                               name="seat_direction" {{$screenSeatData->seat_direction == 'left to right' ? 'checked' : ''}}>&nbsp;&nbsp;&nbsp;Left
                                                        To Right
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label class="radio-inline">
                                                        <input type="radio" onclick="cancelSeats(); removeError();;"
                                                               value="right to left"
                                                               name="seat_direction" {{$screenSeatData->seat_direction == 'right to left' ? 'checked' : ''}}>&nbsp;&nbsp;&nbsp;Right
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
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Alphabet Direction
                                                    <span class="req">*</span></label>

                                                <div class="col-lg-9">
                                                    <label class="radio-inline">
                                                        <input type="radio" onclick="cancelSeats(); removeError();"
                                                               value="top to bottom"
                                                               name="alphabet_direction" {{$screenSeatData->alphabet_direction == 'top to bottom' ? 'checked' : ''}}>&nbsp;&nbsp;&nbsp;Top
                                                        To Bottom
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label class="radio-inline">
                                                        <input type="radio" onclick="cancelSeats(); removeError();"
                                                               value="bottom to top"
                                                               name="alphabet_direction" {{$screenSeatData->alphabet_direction == 'bottom to top' ? 'checked' : ''}}>&nbsp;&nbsp;&nbsp;Bottom
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
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-9">
                                                    <button style="display: none;" type="button" class="btn btn-primary previewBtn">Preview <i class="ajaxSpinner fa fa-spin fa-spinner" style="display: none;"></i></button>
                                                </div>
                                            </div>
                                        </form>

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
                                                        <div class="table-responsive seat-structure-main-div"
                                                             id="place">
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
                                                                                   type="text" name="alphabets[]"
                                                                                   class="alphabets">
                                                                        </td>

                                                                        @for ($j = 1; $j <= $noOfColumns; $j++)
                                                                            @php $titleCount += 1; @endphp
                                                                            <td id="" class="seat"
                                                                                onclick="seatNum('{{$i.'-'.$j}}');"
                                                                                data-seatnum="{{$i.'-'.$j}}"></td>
                                                                            @if ($j == $noOfColumns)
                                                                                <td>
                                                                                    <input readonly
                                                                                           style="float: right;"
                                                                                           value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                                                           type="text"
                                                                                           class="alphabets">
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
                                                                                   style="" oninput="" type="text"
                                                                                   class="alphabets">
                                                                        </td>

                                                                        @for ($j = $noOfColumns; $j >= 1; $j--)
                                                                            <td class="seat"
                                                                                onclick="seatNum('{{$i.'-'.$j}}');"
                                                                                data-seatnum="{{$i.'-'.$j}}"></td>
                                                                            @php $titleCount -= 1; @endphp
                                                                            @if ($j == 1)
                                                                                <td>
                                                                                    <input readonly
                                                                                           value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                                                           style="float: right;"
                                                                                           type="text"
                                                                                           class="alphabets">
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
                                                        <div class="table-responsive seat-structure-main-div"
                                                             id="place">
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
                                                                                   type="text" name="alphabets[]"
                                                                                   class="alphabets">
                                                                        </td>
                                                                        @for ($j = 1; $j <= $noOfColumns; $j++)
                                                                            @if(!in_array($i.'-'.$j, $pathArr))
                                                                                @php $titleCount += 1; @endphp
                                                                            @endif
                                                                            <td id=""
                                                                                class="{{!in_array($i.'-'.$j, $pathArr) ? 'seat' : 'inactiveSeat'}}"
                                                                                onclick="seatNum('{{$i.'-'.$j}}');"
                                                                                data-seatnum="{{$i.'-'.$j}}"></td>
                                                                            @if ($j == $noOfColumns)
                                                                                <td>
                                                                                    <input readonly
                                                                                           style="float: right;"
                                                                                           value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                                                           type="text"
                                                                                           class="alphabets">
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
                                                                                   style="" oninput="" type="text"
                                                                                   class="alphabets">
                                                                        </td>

                                                                        @for ($j = $noOfColumns; $j >= 1; $j--)
                                                                            <td class="{{!in_array($i.'-'.$j, $pathArr) ? 'seat' : 'inactiveSeat'}}"
                                                                                onclick="seatNum('{{$i.'-'.$j}}');"
                                                                                data-seatnum="{{$i.'-'.$j}}"></td>
                                                                            @if(!in_array($i.'-'.$j, $pathArr))
                                                                                @php $titleCount -= 1; @endphp
                                                                            @endif

                                                                            @if ($j == 1)
                                                                                <td>
                                                                                    <input readonly
                                                                                           value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                                                           style="float: right;"
                                                                                           type="text"
                                                                                           class="alphabets">
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
                                                <form action="{{url('admin/seat-management/screens/'.$screen->slug.'/seat/update')}}"
                                                      method="post"
                                                      id="seatStructureForm">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="numOfRows" value="{{$noOfRows}}">
                                                    <input type="hidden" name="numOfColumns" value="{{$noOfColumns}}">
                                                    <input type="hidden" name="seatDirection"
                                                           value="{{$seatDirection}}">
                                                    <input type="hidden" name="alphabetDirection"
                                                           value="{{$alphaDirection}}">
                                                    <input type="hidden" name="screenSeatDataId"
                                                           value="{{$screenSeatData->id}}">
                                                    @if($screenSeatData['path'] != '0')
                                                        @foreach(json_decode($screenSeatData['path'], true) as $pth)
                                                            <input name="inactiveSeat[]" value="{{$pth}}"
                                                                   id="input{{$pth}}" type="hidden">
                                                        @endforeach
                                                    @endif

                                                    <div class="form-group">
                                                        <select onfocus="rErr('seat-categories');"
                                                                name="seat_categories" id="seat-categories"
                                                                class="custom-select" style="width: 40%; margin-top: 10px;">
                                                            <option value="">-- Select Number Of Seat Categories --
                                                            </option>
                                                            @for($i = 1; $i <= 10; $i++)
                                                                <option value="{{$i}}" {{$i == $screenSeatData->num_of_seat_categories ? 'selected' : ''}}>{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                        <span class="seat-categories-error help-block"></span>
                                                    </div>

                                                    <div class="category-div"></div>
                                                    <button type="submit" class="btn btn-primary ajaxSubmitButton">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                $(document).find('form#seatStructureForm').removeAttr('action').attr('action', baseurl + '/admin/seat-management/screens/{{$screen->slug}}/seat/update');
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


                $(document).find('#seatStructureForm').on('submit', function (e) {
                    var emp = 0;
                    var chk = 0;
                    if ($(document).find('select#seat-categories').val() == '') {
                        e.preventDefault();
                        $(document).find('.seat-categories-error').html('<strong>Please choose a value !</strong>');
                    }

                    $(document).find('input.category-name').each(function () {
                        if ($(this).val() == '') {
                            emp = 1;
                        }
                    });


                    $(document).find('select.category-from-row').each(function () {
                        if ($(this).val() == '') {
                            emp = 1;
                        }
                    });


                    $(document).find('select.category-to-row').each(function () {
                        if ($(this).val() == '') {
                            emp = 1;
                        }
                    });

                    if (emp == 1) {
                        e.preventDefault();
                        $(document).find('.category-name-error').html('<strong>Please fill all required values !</strong>');
                    }

                    if (emp == 0) {
                        var count = $(document).find('select#seat-categories').val();
                        var firstCategoryNameVal = $(document).find('input.category-name-1').val();
                        var firstFromRowVal = $(document).find('select.category-from-row-1').val();
                        var firstToRowVal = $(document).find('select.category-to-row-1').val();
                        for (var a = 2; a <= count; a++) {
                            var otherCategoryNameVal = $(document).find('input.category-name-' + a).val();
                            var otherFromRowVal = $(document).find('select.category-from-row-' + a).val();
                            var otherToRowVal = $(document).find('select.category-to-row-' + a).val();
                            if (firstCategoryNameVal == otherCategoryNameVal) {
                                chk = 1;
                            }

                            if (firstFromRowVal == otherFromRowVal) {
                                chk = 1;
                            }

                            if (firstFromRowVal == otherToRowVal) {
                                chk = 1;
                            }

                            if (firstToRowVal == otherFromRowVal) {
                                chk = 1;
                            }


                            if (firstToRowVal == otherToRowVal) {
                                chk = 1;
                            }
                        }

                        if (chk == 1) {
                            e.preventDefault();
                            $(document).find('.category-name-error').html('<strong>Errorous Values Found !</strong>');
                        }
                    }
                });

                $(document).find('select#seat-categories').on('change', function () {
                    var val = $(this).val();
                    if (val != '') {
                        var alphabets = [];
                        $(document).find('input.alphabets').each(function () {
                            alphabets.push($(this).val());
                        });

                        alphabets = jQuery.unique(alphabets);
                        var html = '';
                        html += '<table class="table table-responsive table-bordered">';
                        html += '<thead>';
                        html += '<tr>';
                        html += '<th>Category Name</th>';
                        html += '<th>From Row</th>';
                        html += '<th>To Row</th>';
                        html += '<tr>';
                        html += '</thead>';
                        html += '<tbody>';
                        for (var i = 0; i < val; i++) {
                            html += '<tr>';
                            html += '<td>';
                            html += '<input type="text" class="form-control category-name category-name-' + i + '" name="category_name[]" placeholder="Enter Category Name">';
                            html += '</td>';
                            html += '<td>';
                            html += '<select name="category_from_row[]" class="custom-select category-from-row category-from-row-' + i + '">';
                            html += '<option value="">-- Select From Row --</option>';
                            for (var k = 0; k < alphabets.length; k++) {
                                html += '<option value="' + alphabets[k] + '">' + alphabets[k] + '</option>';
                            }
                            html += '</select>';
                            html += '</td>';
                            html += '<td>';
                            html += '<select name="category_to_row[]" class="custom-select category-to-row category-to-row-' + i + '">';
                            html += '<option value="">-- Select To Row --</option>';
                            for (var k = 0; k < alphabets.length; k++) {
                                html += '<option value="' + alphabets[k] + '">' + alphabets[k] + '</option>';
                            }
                            html += '</select>';
                            html += '</td>';
                            html += '</tr>';
                        }
                        html += '<tr>';
                        html += '<td colspan="3" class="text-center"><span class="category-name-error help-block"></span></td>';
                        html += '<tr>';
                        html += '</tbody>';
                        html += '</table>';
                        $(document).find('div.category-div').html(html);
                    } else {
                        $(document).find('div.category-div').html('');
                    }
                });


                $(window).on('load', function () {
                            @if(isset($screenSeatData->num_of_seat_categories))
                    var val = "{{$screenSeatData->num_of_seat_categories}}";
                    var html = "";
                    if (val != '') {
                        var alphabets = [];
                        $(document).find('input.alphabets').each(function () {
                            alphabets.push($(this).val());
                        });

                        alphabets = jQuery.unique(alphabets);
                        var html = '';
                        html += '<table class="table table-responsive table-bordered">';
                        html += '<thead>';
                        html += '<tr>';
                        html += '<th>Category Name</th>';
                        html += '<th>From Row</th>';
                        html += '<th>To Row</th>';
                        html += '<tr>';
                        html += '</thead>';
                        html += '<tbody>';
                        var cnt = 0;
                        @foreach($screenCategoriesData as $dat)
                            cnt++;
                        var fr = "{{$dat->category_from_row}}";
                        var tr = "{{$dat->category_to_row}}";
                        html += '<tr>';
                        html += '<td>';
                        html += '<input value="{{$dat->category_name}}" type="text" class="form-control category-name category-name-' + cnt + '" name="category_name[]" placeholder="Enter Category Name">';
                        html += '</td>';
                        html += '<td>';
                        html += '<select name="category_from_row[]" class="custom-select category-from-row category-from-row-' + cnt + '">';
                        html += '<option value="">-- Select From Row --</option>';
                        for (var k = 0; k < alphabets.length; k++) {
                            if (alphabets[k] == fr) {
                                var attr = 'selected';
                            } else {
                                var attr = '';
                            }
                            html += '<option value="' + alphabets[k] + '" ' + attr + '>' + alphabets[k] + '</option>';
                        }
                        html += '</select>';
                        html += '</td>';
                        html += '<td>';
                        html += '<select name="category_to_row[]" class="custom-select category-to-row category-to-row-' + cnt + '">';
                        html += '<option value="">-- Select To Row --</option>';
                        for (var k = 0; k < alphabets.length; k++) {
                            if (alphabets[k] == tr) {
                                var attr = 'selected';
                            } else {
                                var attr = '';
                            }
                            html += '<option value="' + alphabets[k] + '" ' + attr + '>' + alphabets[k] + '</option>';
                        }
                        html += '</select>';
                        html += '</td>';
                        html += '</tr>';
                        @endforeach
                            html += '<tr>';
                        html += '<td colspan="3" class="text-center"><span class="category-name-error help-block"></span></td>';
                        html += '<tr>';
                        html += '</tbody>';
                        html += '</table>';
                        $(document).find('div.category-div').html(html);
                    }
                    @endif
                });


                function rErr(text) {
                    $('.' + text + '-error').html('');
                }
            </script>
@stop