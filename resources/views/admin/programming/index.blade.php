@extends('admin.layout.master1')

@section('styles')
    <link rel="stylesheet" href="{{asset('admins/plugins/vis/vis.min.css')}}">
    <style>
        .timepicker.increment-allowed {
            /*padding: 1px 36px 0;*/
            /*width: 26%;*/
            display: -webkit-flex;
            display: flex;
        }

        .timepicker {
            position: relative;
            height: 26px;
        }

        .timepicker.increment-allowed .prev {
            display: block;
        }

        .timepicker span {
            /*position: absolute;*/
            /*display: block;*/
            /*top: 0;*/
            /*left: 0;*/
            height: 27px;
            width: 36px;
            background: url({{asset('admins/theme/sprite/sprite.png')}}) -179px -38px;
            cursor: pointer;
        }

        .timepicker input {
            margin: 0;
            width: 100% !important;
        }

        .timepicker span.clear {
            display: none;
        }

        .timepicker.increment-allowed .next {
            display: block;
        }

        .timepicker span.next {
            display: none;
            right: 0;
            left: auto;
            background-position: -216px -38px;
        }

        .container-label {
            display: inline-block;
            position: relative;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .container-label input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            padding: 5px 8px;
            background: #E3D6A6;
            color: #9b7502;
            margin-right: 10px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            text-shadow: 1px 1px 1px #fff;
            box-shadow: 1px 1px;
        }

        .container-label input:checked ~ .checkmark {
            color: #629221 !important;
            background: #CCFF00 !important;
            text-shadow: 1px 1px 1px #fff !important;
        }

        .show-time-input-div {
            display: -webkit-flex;
            display: flex;
            -webkit-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .stDiv {

            position: relative;
        }

        .closeInput {
            margin-right: 0;

            position: absolute;

            right: 1px;

            top: 4px;

            padding: 1px;

            background: #fff;
        }

        .closeInput1 {
            margin-right: 0;

            position: absolute;

            right: 1px;

            top: 4px;

            padding: 1px;

            background: #fff;

            color: #fff;
        }

        .show-time-input::-webkit-clear-button { /* Removes blue cross */
            -webkit-appearance: none;
            -moz-appearance: none;
            margin: 0;

        }

        div.addAShowDiv {
            padding: 5%;
            display: none;
        }

        div.artist-form {
            padding: 3%;
            border: 1px solid #000;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .close-add-show-div {
            float: right;

            margin: 10px;

            background: #000;

            padding: 5px 12px;

            color: #fff;

            cursor: pointer;
        }

        .calendar-head {
            background: #f1f2ec;
            min-height: 55px;
            position: relative;
        }

        .pickDate {
            width: 20%;
            margin: 0 auto;
            vertical-align: middle;
            position: absolute;
            left: 40%;
            top: 20%;
        }

        .pickDate span {
            color: #000;
            font-weight: 500;
        }

        .pickDate input {
            text-align: center;
            border-radius: 7px 0 0 7px;
        }

        .pickDateAddon {
            border-radius: 0 7px 7px 0;
        }

        .help-block {
            color: red;
            font-size: 15px;
            font-weight: 500;
            display: block;
        }

        .datepicker-days td.active {
            cursor: not-allowed !important;
        }

        /*.stDiv{*/
        /*width: 100%;*/
        /*float: left;*/
        /*}*/
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
                            <h5>Programming</h5>
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
            <div class="row gutters">
                <div class=" col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header artist-header">
                            <a href="javascript:void(0)" class="add-new-show"> Add New Show</a>
                        </div>
                        <div class="card-body">
                            <div class="calendar-head">
                                <div class="input-group date pickDate">
                                    <input onkeydown="return false;" type="text" class="form-control datepicker"
                                           value="{{date('Y-m-d')}}">
                                    <div class="input-group-addon pickDateAddon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="movies-calendar"></div>

                            <div class="addAShowDiv">
                                <div class="close-add-show-div">
                                    <i class="fa fa-close"></i>
                                </div>
                                <div class="artist-form">
                                    <div class="clearfix"></div>
                                    <form action="{{url('admin/programming/submit')}}" class="form-horizontal" method="post">
                                        {{csrf_field()}}
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Film
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <select name="film" id="film" class="custom-select"
                                                        onclick="removeError('film')">
                                                    <option value="">-- Choose Film --</option>
                                                    @if(isset($films) && $films->count() > 0)
                                                        @foreach($films as $film)
                                                            <option value="{{$film->id}}">{{$film->movie_title}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="error help-block film-error"></span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Screen
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                @if(isset($screens) && $screens->count() > 0)
                                                    @php $fg = 0; @endphp
                                                    @foreach($screens as $s)
                                                        @if($s->screenSeats != null)
                                                            @php $fg++; @endphp
                                                            <label class="container-label checkbox-inline">
                                                                <input type="checkbox" value="{{$s->id}}"
                                                                       class="screenIdCheckbox select-screen-id"
                                                                       name="screen_id[]"
                                                                       onclick="removeError('screen-id');">
                                                                <span class="checkmark">{{$s->name}}</span>
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                    @if($fg > 1)
                                                        <label class="container-label checkbox-inline">
                                                            <input type="checkbox" value="all"
                                                                   class="screenIdCheckbox select-screen-id"
                                                                   name="screen_id[]"
                                                                   onclick="removeError('screen-id');">
                                                            <span class="checkmark">All</span>
                                                        </label>
                                                    @endif
                                                    <span class="pw" style="display: none;"> Please Wait ...<i
                                                                class="fa fa-spin fa-spinner"></i></span>
                                                @else
                                                    <span>You donot have any screens for scheduling show !!!</span>
                                                @endif
                                                <span class="screen-id-error error help-block"></span>
                                            </div>
                                        </div>


                                        <div class="form-group row price-card-div">
                                            <label class="col-lg-3 col-form-label form-control-label">Price Card
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <select name="price_card" id="price-card-select"
                                                        class="custom-select">
                                                    <option value="">-- Choose Price Card --</option>
                                                </select>
                                                <span class="price-card-error error help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row no-price-card-div">
                                            <label class="col-lg-3 col-form-label form-control-label">Price Card
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <span class="help-block error no-price-card-div"><strong>No any price cards matched for selected screens.</strong></span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Day (s)
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="fri" class="dayCheckBox select-days"
                                                           name="days[]" onclick="removeError('days');">
                                                    <span class="checkmark">Fri</span>
                                                </label>
                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="sat" class="dayCheckBox select-days"
                                                           name="days[]" onclick="removeError('days');">
                                                    <span class="checkmark">Sat</span>
                                                </label>
                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="sun" class="dayCheckBox select-days"
                                                           name="days[]" onclick="removeError('days');">
                                                    <span class="checkmark">Sun</span>
                                                </label>
                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="mon" class="dayCheckBox select-days"
                                                           name="days[]" onclick="removeError('days');">
                                                    <span class="checkmark">Mon</span>
                                                </label>
                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="tue" class="dayCheckBox select-days"
                                                           name="days[]" onclick="removeError('days');">
                                                    <span class="checkmark">Tue</span>
                                                </label>
                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="wed" class="dayCheckBox select-days"
                                                           name="days[]" onclick="removeError('days');">
                                                    <span class="checkmark">Wed</span>
                                                </label>
                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="thu" class="dayCheckBox select-days"
                                                           name="days[]" onclick="removeError('days');">
                                                    <span class="checkmark">Thu</span>
                                                </label>

                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="every-day"
                                                           class="dayCheckBox select-days"
                                                           name="days[]" onclick="removeError('days');">
                                                    <span class="checkmark">Every Day</span>
                                                </label>

                                                <span class="days-error error help-block"></span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Show Times
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <div class="timepicker increment-allowed scrolling">
                                                    <span class="prev"></span>
                                                    <div class="show-time-input-div">
                                                        <div class="stDiv">
                                                            <input class="show-time-input" name="show_time[]"
                                                                   type="time" id="time">
                                                            <i class="fa fa-times closeInput1"
                                                               style="margin-right: 5px;"></i>
                                                        </div>
                                                    </div>
                                                    <span class="clear"></span>
                                                    <span class="next"></span>
                                                </div>
                                                <span class="show-time-error error help-block"></span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Sales Via
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="web"
                                                           name="sales_via[]" onclick="removeError('sales-via');"
                                                           class="select-sales-via">
                                                    <span class="checkmark">WEB</span>
                                                </label>
                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="pos"
                                                           name="sales_via[]" onclick="removeError('sales-via');"
                                                           class="select-sales-via">
                                                    <span class="checkmark">POS</span>
                                                </label>
                                                <label class="container-label checkbox-inline">
                                                    <input type="checkbox" value="kiosk"
                                                           name="sales_via[]" onclick="removeError('sales-via');"
                                                           class="select-sales-via">
                                                    <span class="checkmark">KIOSK</span>
                                                </label>
                                                <span class="sales-via-error error help-block"></span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Clean Up Time (In
                                                Minute)
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="clean_up_time" class="form-control"
                                                       style="width: 25%;" onfocus="removeError('clean-up')">
                                                <span class="clean-up-error error help-block"></span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Seating
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <label class="container-label radio-inline">
                                                    <input type="radio" value="open"
                                                           name="seating" onclick="removeError('seating');">
                                                    <span class="checkmark">OPEN</span>
                                                </label>
                                                <label class="container-label radio-inline">
                                                    <input type="radio" value="allocated"
                                                           name="seating" onclick="removeError('seating');">
                                                    <span class="checkmark">Allocated</span>
                                                </label>
                                                <label class="container-label radio-inline">
                                                    <input type="radio" value="select"
                                                           name="seating" onclick="removeError('seating');">
                                                    <span class="checkmark">SELECT</span>
                                                </label>
                                                <span class="seating-error error help-block"></span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Comps
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <label class="container-label radio-inline">
                                                    <input type="radio" value="allowed"
                                                           name="comps" onclick="removeError('comps');">
                                                    <span class="checkmark">ALLOWED</span>
                                                </label>
                                                <label class="container-label radio-inline">
                                                    <input type="radio" value="not allowed"
                                                           name="comps" onclick="removeError('comps');">
                                                    <span class="checkmark">Not Allowed</span>
                                                </label>
                                                <span class="comps-error error help-block"></span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Status
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <label class="container-label radio-inline">
                                                    <input type="radio" value="planned"
                                                           name="status" onclick="removeError('status');">
                                                    <span class="checkmark">planned</span>
                                                </label>
                                                <label class="container-label radio-inline">
                                                    <input type="radio" value="open"
                                                           name="status" onclick="removeError('status');">
                                                    <span class="checkmark">open</span>
                                                </label>
                                                <label class="container-label radio-inline">
                                                    <input type="radio" value="closed"
                                                           name="status" onclick="removeError('status');">
                                                    <span class="checkmark">closed</span>
                                                </label>
                                                <span class="status-error error help-block"></span>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label form-control-label">Show Type
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <label class="container-label radio-inline">
                                                    <input type="radio" value="public" checked
                                                           name="show_type" onclick="removeError('show-type');">
                                                    <span class="checkmark">public</span>
                                                </label>
                                                <label class="container-label radio-inline">
                                                    <input type="radio" value="private"
                                                           name="show_type" onclick="removeError('show-type');">
                                                    <span class="checkmark">private</span>
                                                </label>
                                                <span class="show-type-error error help-block"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-lg-3"></label>
                                            <div class="col-lg-9">
                                                <button type="submit" class="btn btn-primary">Save</button>
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
    </div>
@stop

@section('scripts')
    <script src="{{asset('admins/plugins/vis/vis.min.js')}}"></script>
    {{--form script--}}
    <script>
        $('div.price-card-div').hide();
        $('div.no-price-card-div').hide();


        var showTimeId = 0;
        $('.next').on('click', function () {
            var empty = 0;
            $('input.show-time-input').each(function () {
                if ($(this).val() == '') {
                    empty = 1;
                }
            });

            if (empty == 0) {
                if ($('#film').val() != '') {
                    var lastInputVal = $(document).find('input.show-time-input:last').val();
                    var lastInputValArr = lastInputVal.split(':');
                    var minute = (parseInt(lastInputValArr[1]) + parseInt(00));
                    var newMinute = minute % 60;
                    var newHour = ((parseInt(parseInt(lastInputValArr[0]) + parseInt(3))) + (parseInt(Math.floor(minute / 60))));
                    if (newHour.toString().length == 1) {
                        newHour = 0 + newHour.toString();
                    }
                    if (newMinute.toString().length == 1) {
                        newMinute = 0 + newMinute.toString();
                    }
                    var newTime = newHour + ':' + newMinute;

                    if (newHour <= 24) {
                        showTimeId++;
                        $('div.show-time-input-div').append('<div class="stDiv stDivAppended"><input name="show_time[]" class="show-time-input" id="time' + showTimeId + '" type="time" value="' + newTime + '"><i class="fa fa-times closeInput" style="margin-right: 5px;"></i></div>');
                    }
                }
            }
        });

        $('.prev').on('click', function () {
            var empty = 0;
            $('input.show-time-input').each(function () {
                if ($(this).val() == '') {
                    empty = 1;
                }
            });

            if (empty == 0) {
                if ($('#film').val() != '') {
                    var lastInputVal = $(document).find('input.show-time-input:first').val();
                    var lastInputValArr = lastInputVal.split(':');
                    var minute = (parseInt(lastInputValArr[1]) - parseInt(00));
                    var newMinute = minute % 60;
                    var newHour = ((parseInt(parseInt(lastInputValArr[0]) - parseInt(3))) + (parseInt(Math.floor(minute / 60))));
                    if (newHour.toString().length == 1) {
                        newHour = 0 + newHour.toString();
                    }
                    if (newMinute.toString().length == 1) {
                        newMinute = 0 + newMinute.toString();
                    }
                    var newTime = newHour + ':' + newMinute;
                    if (newHour >= 00) {
                        showTimeId++;
                        $('div.show-time-input-div').prepend('<div class="stDiv stDivAppended"><input name="show_time[]" class="show-time-input" id="time' + showTimeId + '" type="time" value="' + newTime + '"><i class="fa fa-times closeInput" style="margin-right: 5px;"></i></div>');
                    }
                }
            }
        });

        $(document).on('click', '.closeInput', function () {
            $(this).prev('input').remove();
            $(this).remove();
            showTimeId--;
        });

        $(document).on('change', 'input.select-screen-id', function () {
            $('span.pw').show();
            $('div.price-card-div').hide();
            var screenIds = [];
            if ($(this).val() == 'all') {
                $(document).find('input.screenIdCheckbox').each(function () {
                    $(this).prop('checked', true);
                    if ($(this).val() != 'all') {
                        screenIds.push($(this).val());
                    }
                });
            } else {
                $(document).find('input.screenIdCheckbox[value=all]').prop('checked', false);
                $(document).find('input.screenIdCheckbox:checked').each(function () {
                    screenIds.push($(this).val());
                });
            }

            if (screenIds.length > 0) {
                var sendParam = JSON.stringify(screenIds);
                $.ajax({
                    url: baseurl + '/admin/programming/add-show/get-pricecard?screenIds=' + sendParam,
                    type: 'get',
                    success: function (data) {
                        console.log(data);
                        if (data != '') {
                            var html = '';
                            html += '<option value="">-- Choose Price Card --</option>';
                            for (var i = 0; i < data.length; i++) {
                                html += '<option value="' + data[i] + '">' + data[i] + '</option>';
                            }
                            $(document).find('select#price-card-select').html(html);
                            $('div.price-card-div').show();
                            $('div.no-price-card-div').hide();
                        } else {
                            $('div.no-price-card-div').show();
                            $('div.price-card-div').hide();
                        }
                        $('span.pw').hide();
                    }, error: function (data) {
                        alertify.alert('Oops ! something went wrong. Please Try Again.');
                        $(document).find('input.screenIdCheckbox').each(function () {
                            $(this).prop('checked', false);
                        });
                        $('div.price-card-div').hide();
                        $('div.no-price-card-div').hide();
                        $('span.pw').hide();
                    }
                });
            } else {
                $('span.pw').hide();
            }
        });

        $(document).on('change', 'input.dayCheckBox', function () {
            if ($(this).val() == 'every-day') {
                $(document).find('input.dayCheckBox').each(function () {
                    $(this).prop('checked', true);
                });
            } else {
                $(document).find('input.dayCheckBox[value=every-day]').prop('checked', false);
            }
        });

        function removeError(text) {
            $('.' + text + '-error').html('');
        }

        $('#price-card-select').on('click', function () {
            removeError('price-card');
        });

        $(document).find('.show-time-input').on('click', function () {
            removeError('show-time');
        });


        $(document).on('submit', 'form', function (e) {
            if ($('#film').val() == '') {
                e.preventDefault();
                $('span.film-error').html('<strong>Please choose a film !</strong>');
            }

            if (!$('input.select-screen-id:checked').val()) {
                e.preventDefault();
                $('span.screen-id-error').html('<strong>Please choose a screen !</strong>');
            }

            if (!$('input[name=seating]:checked').val()) {
                e.preventDefault();
                $('span.seating-error').html('<strong>Please choose a value !</strong>');
            }

            if (!$('input[name=comps]:checked').val()) {
                e.preventDefault();
                $('span.comps-error').html('<strong>Please choose a value !</strong>');
            }
            if (!$('input[name=status]:checked').val()) {
                e.preventDefault();
                $('span.status-error').html('<strong>Please choose a value !</strong>');
            }
            if (!$('input[name=show_type]:checked').val()) {
                e.preventDefault();
                $('span.show-type-error').html('<strong>Please choose a value !</strong>');
            }

            if ($('div.price-card-div').is(':visible')) {
                if ($('#price-card-select').val() == '') {
                    e.preventDefault();
                    $('span.price-card-error').html('<strong>Please choose a price card !</strong>');
                }
            }

            if ($('div.no-price-card-div').is(':visible')) {
                e.preventDefault();
            }

            if (!$('input.select-days:checked').val()) {
                e.preventDefault();
                $('span.days-error').html('<strong>Please choose a day !</strong>');
            }

            var emp = 0;
            var valid = 0;
            $(document).find('.show-time-input').each(function () {
                if ($(this).val() == '') {
                    emp = 1;
                }
            });
            if (emp == 1) {
                e.preventDefault();
                $('span.show-time-error').html('<strong>Please enter show time !</strong>');
            }

            if (emp == 0) {
                var today = new Date();
                var year = today.getFullYear();
                var month = ("0" + parseInt(today.getMonth() + 1)).slice(-2);
                var date = ("0" + today.getDate()).slice(-2)
                var todayDate = year + '-' + month + '-' + date;
                var showErr = 0;
                var todayChoosedErr = 0;
                $('input.select-days:checked').each(function () {
                    var choosed = $(this).val();
                    if (choosed != 'every-day') {
                        var choosedVal = $(document).find('input.show-date-' + choosed).val();
                        choosedVal = new Date(choosedVal);
                        var choosedYear = choosedVal.getFullYear();
                        var choosedMonth = ("0" + parseInt(choosedVal.getMonth() + 1)).slice(-2);
                        var choosedDate = ("0" + choosedVal.getDate()).slice(-2);
                        var todayDate1 = choosedYear + '-' + choosedMonth + '-' + choosedDate;

                        if (todayDate1 == todayDate) {
                            todayChoosedErr = 1;
                            $(document).find('.show-time-input').each(function () {
                                var compareDateTime = todayDate + ' ' + $(this).val();
                                var currentDateTime = todayDate + ' ' + ("0" + parseInt(today.getHours())).slice(-2) + ':' + ("0" + parseInt(today.getMinutes())).slice(-2);
                                if (compareDateTime < currentDateTime) {
                                    showErr = 1;
                                }
                            });

                            if (showErr == 1) {
                                e.preventDefault();
                                $('span.show-time-error').html('<strong>Show time cannot be set in the past !</strong>');
                            } else {
                                $('span.show-time-error').html('');
                            }
                        }
                    }
                });

                if (todayChoosedErr == 0) {
                    $('span.show-time-error').html('');
                }

            }

            if (!$('input.select-sales-via:checked').val()) {
                e.preventDefault();
                $('span.sales-via-error').html('<strong>Please choose a sales via field !</strong>');
            }

            if ($('input[name=clean_up_time]').val() == '') {
                e.preventDefault();
                $('span.clean-up-error').html('<strong>Please enter a clean up time !</strong>');
            }

            if ($('input.select-days:checked').val()) {
                var today = new Date();
                var year = today.getFullYear();
                var month = ("0" + parseInt(today.getMonth() + 1)).slice(-2);
                var date = ("0" + today.getDate()).slice(-2)
                var todayDate = year + '-' + month + '-' + date;
                $('input.select-days:checked').each(function () {
                    var choosed = $(this).val();
                    if (choosed != 'every-day') {
                        var choosedVal = $(document).find('input.show-date-' + choosed).val();
                        choosedVal = new Date(choosedVal);
                        var choosedYear = choosedVal.getFullYear();
                        var choosedMonth = ("0" + parseInt(choosedVal.getMonth() + 1)).slice(-2);
                        var choosedDate = ("0" + choosedVal.getDate()).slice(-2);
                        var todayDate1 = choosedYear + '-' + choosedMonth + '-' + choosedDate;

                        if (todayDate1 < todayDate) {
                            e.preventDefault();
                            $('span.days-error').html('<strong>Show time cannot be set in the past !</strong>');
                        }
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
        $('input[name=clean_up_time]').keypress(function (event) {
            return isNumber(event, this)
        });

    </script>
    {{--form-script--}}


    {{--timeline-script--}}
    <script>
        $(window).on('load', function () {
            // DOM element where the Timeline will be attached
            var container = document.getElementById('movies-calendar');

            // Create a DataSet (allows two way data-binding)
            var items = new vis.DataSet([
                {id: 1, content: 'item 1', start: '2016-08-15T10:00'},
                {id: 2, content: 'item 2', start: '2016-08-15T12:00'},
                {id: 3, content: 'item 3', start: '2016-08-15T14:00'},
                {id: 4, content: 'item 4', start: '2016-08-15T16:00'}
            ]);

            // Configuration for the Timeline
            var options = {
//            start: '2016-08-15T08:00',
//            end: '2016-08-15T20:00'
            };

            // Create a Timeline
            var timeline = new vis.Timeline(container, items, options);
        });
    </script>
    {{--timeline script--}}

    <script>
        $(document).find('input.datepicker').on('click', function () {
            $(document).find('td.active').on('click', function () {
                return false;
            });
        });
        $('.add-new-show').on('click', function () {
            $('div.addAShowDiv').fadeIn('slow');
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });


        $('.close-add-show-div').on('click', function () {
            $("form")[0].reset();
            $('div.price-card-div').hide();
            $('div.no-price-card-div').hide();
            $('form').find('span.error').html('');
            $('form').find('div.stDivAppended').remove();
            $('div.addAShowDiv').fadeOut('slow');
        });

        $('.datepicker').on('changeDate', function (ev) {
            $(document).find('td.active').on('click', function () {
                return false;
            });
            $(this).datepicker('hide');
            var defaultDays = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
            var curr = new Date($(document).find('input.datepicker').val()); // get current date
            var currDay = defaultDays[curr.getDay()];
            if (currDay == 'fri') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var friDate = curr;
                var satDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var sunDate = new Date(curr.getTime() + 2 * 24 * 60 * 60 * 1000);
                var monDate = new Date(curr.getTime() + 3 * 24 * 60 * 60 * 1000);
                var tueDate = new Date(curr.getTime() + 4 * 24 * 60 * 60 * 1000);
                var wedDate = new Date(curr.getTime() + 5 * 24 * 60 * 60 * 1000);
                var thuDate = new Date(curr.getTime() + 6 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }


            if (currDay == 'sat') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var satDate = curr;
                var sunDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var monDate = new Date(curr.getTime() + 2 * 24 * 60 * 60 * 1000);
                var tueDate = new Date(curr.getTime() + 3 * 24 * 60 * 60 * 1000);
                var wedDate = new Date(curr.getTime() + 4 * 24 * 60 * 60 * 1000);
                var thuDate = new Date(curr.getTime() + 5 * 24 * 60 * 60 * 1000);
                var friDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }


            if (currDay == 'sun') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var sunDate = curr;
                var monDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var tueDate = new Date(curr.getTime() + 2 * 24 * 60 * 60 * 1000);
                var wedDate = new Date(curr.getTime() + 3 * 24 * 60 * 60 * 1000);
                var thuDate = new Date(curr.getTime() + 4 * 24 * 60 * 60 * 1000);
                var satDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                var friDate = new Date(curr.getTime() - 2 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }

            if (currDay == 'mon') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var monDate = curr;
                var tueDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var wedDate = new Date(curr.getTime() + 2 * 24 * 60 * 60 * 1000);
                var thuDate = new Date(curr.getTime() + 3 * 24 * 60 * 60 * 1000);
                var sunDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                var satDate = new Date(curr.getTime() - 2 * 24 * 60 * 60 * 1000);
                var friDate = new Date(curr.getTime() - 3 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }

            if (currDay == 'tue') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var tueDate = curr;
                var wedDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var thuDate = new Date(curr.getTime() + 2 * 24 * 60 * 60 * 1000);
                var friDate = new Date(curr.getTime() - 4 * 24 * 60 * 60 * 1000);
                var monDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                var sunDate = new Date(curr.getTime() - 2 * 24 * 60 * 60 * 1000);
                var satDate = new Date(curr.getTime() - 3 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }

            if (currDay == 'wed') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var wedDate = curr;
                var thuDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var friDate = new Date(curr.getTime() - 5 * 24 * 60 * 60 * 1000);
                var satDate = new Date(curr.getTime() - 4 * 24 * 60 * 60 * 1000);
                var tueDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                var monDate = new Date(curr.getTime() - 2 * 24 * 60 * 60 * 1000);
                var sunDate = new Date(curr.getTime() - 3 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }

            if (currDay == 'thu') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var thuDate = curr;
                var friDate = new Date(curr.getTime() - 6 * 24 * 60 * 60 * 1000);
                var satDate = new Date(curr.getTime() - 5 * 24 * 60 * 60 * 1000);
                var sunDate = new Date(curr.getTime() - 4 * 24 * 60 * 60 * 1000);
                var wedDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                var tueDate = new Date(curr.getTime() - 2 * 24 * 60 * 60 * 1000);
                var monDate = new Date(curr.getTime() - 3 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }
        });

        $(window).on('load', function () {
            $("form")[0].reset();
            $('div.price-card-div').hide();
            $('div.no-price-card-div').hide();
            var defaultDays = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
            var curr = new Date($(document).find('input.datepicker').val()); // get current date
            var currDay = defaultDays[curr.getDay()];
            if (currDay == 'fri') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var friDate = curr;
                var satDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var sunDate = new Date(curr.getTime() + 2 * 24 * 60 * 60 * 1000);
                var monDate = new Date(curr.getTime() + 3 * 24 * 60 * 60 * 1000);
                var tueDate = new Date(curr.getTime() + 4 * 24 * 60 * 60 * 1000);
                var wedDate = new Date(curr.getTime() + 5 * 24 * 60 * 60 * 1000);
                var thuDate = new Date(curr.getTime() + 6 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }


            if (currDay == 'sat') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var satDate = curr;
                var sunDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var monDate = new Date(curr.getTime() + 2 * 24 * 60 * 60 * 1000);
                var tueDate = new Date(curr.getTime() + 3 * 24 * 60 * 60 * 1000);
                var wedDate = new Date(curr.getTime() + 4 * 24 * 60 * 60 * 1000);
                var thuDate = new Date(curr.getTime() + 5 * 24 * 60 * 60 * 1000);
                var friDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }


            if (currDay == 'sun') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var sunDate = curr;
                var monDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var tueDate = new Date(curr.getTime() + 2 * 24 * 60 * 60 * 1000);
                var wedDate = new Date(curr.getTime() + 3 * 24 * 60 * 60 * 1000);
                var thuDate = new Date(curr.getTime() + 4 * 24 * 60 * 60 * 1000);
                var satDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                var friDate = new Date(curr.getTime() - 2 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }

            if (currDay == 'mon') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var monDate = curr;
                var tueDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var wedDate = new Date(curr.getTime() + 2 * 24 * 60 * 60 * 1000);
                var thuDate = new Date(curr.getTime() + 3 * 24 * 60 * 60 * 1000);
                var sunDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                var satDate = new Date(curr.getTime() - 2 * 24 * 60 * 60 * 1000);
                var friDate = new Date(curr.getTime() - 3 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }

            if (currDay == 'tue') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var tueDate = curr;
                var wedDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var thuDate = new Date(curr.getTime() + 2 * 24 * 60 * 60 * 1000);
                var friDate = new Date(curr.getTime() - 4 * 24 * 60 * 60 * 1000);
                var monDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                var sunDate = new Date(curr.getTime() - 2 * 24 * 60 * 60 * 1000);
                var satDate = new Date(curr.getTime() - 3 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }

            if (currDay == 'wed') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var wedDate = curr;
                var thuDate = new Date(curr.getTime() + 1 * 24 * 60 * 60 * 1000);
                var friDate = new Date(curr.getTime() - 5 * 24 * 60 * 60 * 1000);
                var satDate = new Date(curr.getTime() - 4 * 24 * 60 * 60 * 1000);
                var tueDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                var monDate = new Date(curr.getTime() - 2 * 24 * 60 * 60 * 1000);
                var sunDate = new Date(curr.getTime() - 3 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }

            if (currDay == 'thu') {
                $(document).find('input.show-date').each(function () {
                    $(this).remove();
                });
                var thuDate = curr;
                var friDate = new Date(curr.getTime() - 6 * 24 * 60 * 60 * 1000);
                var satDate = new Date(curr.getTime() - 5 * 24 * 60 * 60 * 1000);
                var sunDate = new Date(curr.getTime() - 4 * 24 * 60 * 60 * 1000);
                var wedDate = new Date(curr.getTime() - 1 * 24 * 60 * 60 * 1000);
                var tueDate = new Date(curr.getTime() - 2 * 24 * 60 * 60 * 1000);
                var monDate = new Date(curr.getTime() - 3 * 24 * 60 * 60 * 1000);
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-fri" value="' + friDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sat" value="' + satDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-sun" value="' + sunDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-mon" value="' + monDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-tue" value="' + tueDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-wed" value="' + wedDate + '">');
                $('form').append('<input type="hidden" name="show_dates[]" class="show-date show-date-thu" value="' + thuDate + '">');
            }
        });
    </script>
@stop