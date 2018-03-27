@extends('admin.layout.master1')

@section('styles')
    <link rel="stylesheet" href="{{asset('admins/theme/calendar/css/fullcalendar.min.css')}}">
    <link rel="stylesheet" media="print" href="{{asset('admins/theme/calendar/css/full-calendar.print.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/theme/calendar/css/scheduler.min.css')}}">
    <style>
        .timepicker.increment-allowed {
            /*padding: 1px 36px 0;*/
            /*width: 26%;*/
            display: -webkit-flex;
            display: flex;
        }



        .timepicker {
            position: relative;
            height: auto;
        }



        .timepicker.increment-allowed .prev {
            display: block;
        }

        .timepicker-edit.increment-allowed-edit .prev-edit {
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

        .timepicker-edit.increment-allowed-edit .next-edit {
            display: block;
        }

        .timepicker span.next {
            display: none;
            right: 0;
            left: auto;
            background-position: -216px -38px;
        }

        .timepicker-edit span.next-edit {
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
            max-width: calc(100% - 72px);
            overflow-x: auto;
            flex-flow: row;
            overflow-y: hidden;
        }

        .edit-show-time-input-div {
            display: -webkit-flex;
            display: flex;
            -webkit-flex-wrap: wrap;
            flex-wrap: wrap;
            max-width: calc(100% - 72px);
            overflow-x: auto;
            flex-flow: row;
            overflow-y: hidden;
        }


        .stDiv {
            flex: 1;
            position: relative;
        }

        .stDivEdit {
            flex: 1;
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

        .closeInputEdit {
            margin-right: 0;

            position: absolute;

            right: 1px;

            top: 4px;

            padding: 1px;

            background: #fff;
        }

        .show-time-input::-webkit-clear-button { /* Removes blue cross */
            -webkit-appearance: none;
            -moz-appearance: none;
            margin: 0;

        }

        .edit-show-time-input::-webkit-clear-button { /* Removes blue cross */
            -webkit-appearance: none;
            -moz-appearance: none;
            margin: 0;

        }

        div.addAShowDiv {
            margin-top: 20px;
            display: none;
        }

        div.editAShowDiv {
            padding: 5%;
            display: none;
        }

        div.artist-form {
            padding: 3%;
            border: 1px solid #000;
            background-color: #f1f2f8;
        }

        .close-add-show-div {
            float: right;

            margin-top: 0px;

            background: #000;

            padding: 5px 12px;

            color: #fff;

            cursor: pointer;
        }

        .close-edit-show-div {
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

        .restrict-show{
            color: #721c24;
            background: #f8d7da;
            border: none;
            font-size: 14px;
            padding: 10px 20px;
            height: auto;
            margin-bottom: 0;
            border-radius: 0;
        }

        .event-style{
            text-align: center;
            color: #000 !important;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .removeSchedule{
            color: maroon;
            font-weight: 600;
            text-decoration: underline;
            cursor: pointer;
        }

        /*.datepicker-days td.active {*/
            /*cursor: not-allowed !important;*/
        /*}*/

        /*.vis-time-axis{*/
        /*width: 200px !important;*/
        /*display: block !important;*/
        /*}*/

        /*.vis-panel .vis-left {*/
        /*touch-action: none;*/
        /*-moz-user-select: none;*/
        /*height: 32px;*/
        /*left: 0px;*/
        /*top: -1px;*/
        /*}*/

        /*.vis-panel .vis-right {*/
        /*height: 32px;*/
        /*left: 1036px;*/
        /*top: -1px;*/
        /*}*/

        /*.vis-panel .vis-top {*/
        /*width: 1037px;*/
        /*left: -1px;*/
        /*top: 0px;*/
        /*}*/

        /*.vis-panel .vis-bottom {*/
        /*width: 1037px;*/
        /*left: -1px;*/
        /*top: 31px;*/
        /*}*/

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
                            @if(\Illuminate\Support\Facades\Session::has('message') && \Illuminate\Support\Facades\Session::get('message') == 'success')
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">New shows scheduled successfully.</p>
                                </div>
                            @endif

                            @if(\Illuminate\Support\Facades\Session::has('message') && \Illuminate\Support\Facades\Session::get('unmessage') == 'success')
                                <div class="alert alert-danger">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">Oops ! something went wrong. No schedules has been saved.</p>
                                </div>
                            @endif
                            {{--<div class="calendar-head">--}}
                            {{--<div class="input-group date pickDate">--}}
                            {{--<input onkeydown="return false;" type="text" class="form-control datepicker"--}}
                            {{--value="{{date('Y-m-d')}}">--}}
                            {{--<div class="input-group-addon pickDateAddon">--}}
                            {{--<span class="fa fa-calendar"></span>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            <div id='calendar'></div>

                            <div class="addAShowDiv">
                                <div class="close-add-show-div">
                                    <i class="fa fa-close"></i>
                                </div>
                                <div class="artist-form">
                                    <div class="clearfix"></div>
                                    <form class="form-horizontal"
                                          method="post" id="scheduleForm">
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
                                                            <option data-duration="{{$film->duration}}"
                                                                    value="{{$film->id}}">{{$film->movie_title}}</option>
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
                                                                   name=""
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
                                            <label class="col-lg-3 col-form-label form-control-label">Show Times
                                                <span class="req">*</span></label>
                                            <div class="col-lg-9">
                                                <div class="timepicker increment-allowed scrolling">
                                                    <span class="prev"></span>
                                                    <div class="show-time-input-div">
                                                        <div class="stDiv">
                                                            <input class="show-time-input" name="show_time[]"
                                                                   type="time" id="time1">
                                                            <i class="fa fa-times closeInput"
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
                                                <button type="submit" class="btn btn-primary">Save <span
                                                            class="submit-processing" style="display: none;"><i
                                                                class="fa fa-spin fa-spinner"></i> Please Wait ...</span>
                                                </button>
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
    <script src="{{asset('admins/theme/calendar/js/fullcalendar.js')}}"></script>
    <script src="{{asset('admins/theme/calendar/js/scheduler.js')}}"></script>
    {{--form script--}}
    <script>
        $(document).find('.closeMessage').on('click', function () {
            $(this).parent('div').remove();
        });

        $('div.price-card-div').hide();
        $('div.no-price-card-div').hide();


        var showTimeId = 1;
        $('.next').on('click', function () {
            var purpose = $('form').find('input.purpose').val();
            if(purpose == 'store')
            {
                var empty = 0;
                $('input.show-time-input').each(function () {
                    if ($(this).val() == '') {
                        empty = 1;
                    }
                });

                if (empty == 0) {
                    var times = [];
                    $(document).find('input.show-time-input').each(function () {
                        times.push($(this).val());
                    });


                    times.sort(function (a, b) {
                        return new Date('1970/01/01 ' + a) - new Date('1970/01/01 ' + b);
                    });

                    console.log(times);

                    var html = '';
                    for (var i = 0; i < times.length; i++) {
                        html += '<div class="stDiv stDivAppended"><input name="show_time[]" class="show-time-input" id="time' + parseInt(i + 1) + '" value="' + times[i] + '" type="time"><i class="fa fa-times closeInput" style="margin-right: 5px;"></i></div>';
                    }
                    console.log(html);
//
                    if (html != '') {
                        $(document).find('div.show-time-input-div').html(html);
                    }
                    if ($('#film').val() != '') {
                        if ($(document).find('input[name=clean_up_time]').val() != '') {
                            var lastInputVal = $(document).find('input.show-time-input:last').val();
                            var lastInputValArr = lastInputVal.split(':');
                            var movieDuration = $(document).find('#film option:selected').data('duration');
                            var totalDuration = parseInt(movieDuration + parseInt($('input[name=clean_up_time]').val()));
                            var minutesToAdd = totalDuration % 60;
                            var hoursToAdd = Math.floor(totalDuration / 60);
                            var minute = (parseInt(lastInputValArr[1]) + parseInt(minutesToAdd));
                            var newMinute = minute % 60;
                            var newHour = ((parseInt(parseInt(lastInputValArr[0]) + parseInt(hoursToAdd))) + (parseInt(Math.floor(minute / 60))));
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
                        } else {
                            $(document).find('span.show-time-error').html('<strong>First enter film and clean up time !</strong>');
                        }
                    } else {
                        $(document).find('span.show-time-error').html('<strong>First enter film and clean up time !</strong>');
                    }
                }
            }
        });

        $('.prev').on('click', function () {
            var purpose = $('form').find('input.purpose').val();
            if(purpose == 'store')
            {
                var empty = 0;
                $('input.show-time-input').each(function () {
                    if ($(this).val() == '') {
                        empty = 1;
                    }
                });

                if (empty == 0) {
                    var times = [];
                    $(document).find('input.show-time-input').each(function () {
                        times.push($(this).val());
                    });


                    times.sort(function (a, b) {
                        return new Date('1970/01/01 ' + a) - new Date('1970/01/01 ' + b);
                    });

                    console.log(times);

                    var html = '';
                    for (var i = 0; i < times.length; i++) {
                        html += '<div class="stDiv stDivAppended"><input name="show_time[]" class="show-time-input" id="time' + parseInt(i + 1) + '" value="' + times[i] + '" type="time"><i class="fa fa-times closeInput" style="margin-right: 5px;"></i></div>';
                    }
                    console.log(html);
//
                    if (html != '') {
                        $(document).find('div.show-time-input-div').html(html);
                    }
                    if ($('#film').val() != '') {
                        if ($(document).find('input[name=clean_up_time]').val() != '') {
                            var lastInputVal = $(document).find('input.show-time-input:first').val();
                            var lastInputValArr = lastInputVal.split(':');
                            var movieDuration = $(document).find('#film option:selected').data('duration');
                            var totalDuration = parseInt(movieDuration + parseInt($('input[name=clean_up_time]').val()));
                            var minutesToSubtract = totalDuration % 60;
                            var hoursToSubtract = Math.floor(totalDuration / 60);
                            if (parseInt(lastInputValArr[1]) == 00) {
                                var minute = (parseInt(60) - parseInt(minutesToSubtract));
                                hoursToSubtract = parseInt(hoursToSubtract + 1);
                                var newMinute = minute % 60;
                            } else if (parseInt(lastInputValArr[1]) >= parseInt(minutesToSubtract)) {
                                var minute = (parseInt(lastInputValArr[1]) - parseInt(minutesToSubtract));
                                var newMinute = minute % 60;
                            } else {
                                var minute = (parseInt(60) - parseInt(minutesToSubtract));
                                var minute = (parseInt(minute) + parseInt(lastInputValArr[1]));
                                hoursToSubtract = parseInt(hoursToSubtract + 1);
                                var newMinute = 0;
                            }

                            var newMinute = minute % 60;
                            var newHour = ((parseInt(parseInt(lastInputValArr[0]) - parseInt(hoursToSubtract))) + (parseInt(Math.floor(minute / 60))));
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
                        } else {
                            $(document).find('span.show-time-error').html('<strong>First enter film and clean up time !</strong>');
                        }
                    } else {
                        $(document).find('span.show-time-error').html('<strong>First enter film and clean up time !</strong>');
                    }
                }
            }
        });



        $(document).on('click', '.closeInput', function () {
            if ($(document).find('.closeInput').length > 1) {
                $(this).prev('input').remove();
                $(this).remove();
                showTimeId--;
            }
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
                            $('span.no-price-card-div').html('<strong>No any price card is defined.</strong>');
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


        $(document).on('change', 'input.edit-select-screen-id', function () {
            $('span.pw-edit').show();
            $('div.edit-price-card-div').hide();
            var screenIds = [];
            screenIds.push($(this).val());


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
                            $(document).find('select#edit-price-card-select').html(html);
                            $('div.edit-price-card-div').show();
                            $('div.edit-no-price-card-div').hide();
                        } else {
                            $('div.edit-no-price-card-div').show();
                            $('div.edit-price-card-div').hide();
                        }
                        $('span.pw-edit').hide();
                    }, error: function (data) {
                        alertify.alert('Oops ! something went wrong. Please Try Again.');
                        $(document).find('input.screenIdRadio').each(function () {
                            $(this).prop('checked', false);
                        });
                        $('div.edit-price-card-div').hide();
                        $('div.edit-no-price-card-div').hide();
                        $('span.pw-edit').hide();
                    }
                });
            } else {
                $('span.pw-edit').hide();
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

        $(document).find('select[name=price_card]').on('change', function () {
            var choosedPriceCard = $(this).val();
            $.ajax({
                url: baseurl + '/admin/programming/get-pricecard-time?pc=' + choosedPriceCard,
                type: 'get',
                success: function (data) {
                    $(document).find('input.price-card-start-time').remove();
                    $(document).find('input.price-card-end-time').remove();
                    $(document).find('input.price-card-week-days').remove();
                    $(document).find('form').append('<input type="hidden" class="price-card-start-time" value="' + data[0] + '">');
                    $(document).find('form').append('<input type="hidden" class="price-card-end-time" value="' + data[1] + '">');
                    $(document).find('form').append('<input type="hidden" class="price-card-week-days" value="' + data[2] + '">');
                }, error: function (data) {
                    $(document).find('select[name=price_card]').val('');
                    alertify.alert('Oops ! something went wrong. Please try again.');
                }
            });
        });

        $(document).on('submit', '#scheduleForm', function (e) {
            var submit = 'true';
            var times = [];
            $(document).find('input.show-time-input').each(function () {
                times.push($(this).val());
            });


            times.sort(function (a, b) {
                return new Date('1970/01/01 ' + a) - new Date('1970/01/01 ' + b);
            });

            console.log(times);

            var html = '';
            for (var i = 0; i < times.length; i++) {
                html += '<div class="stDiv stDivAppended"><input name="show_time[]" class="show-time-input" id="time' + parseInt(i + 1) + '" value="' + times[i] + '" type="time"><i class="fa fa-times closeInput" style="margin-right: 5px;"></i></div>';
            }
            console.log(html);
//
            if (html != '') {
                $(document).find('div.show-time-input-div').html(html);
            }

            if ($('#film').val() == '') {
                e.preventDefault();
                submit = 'false';
                $('span.film-error').html('<strong>Please choose a film !</strong>');
            }

            if (!$('input.select-screen-id:checked').val()) {
                e.preventDefault();
                submit = 'false';
                $('span.screen-id-error').html('<strong>Please choose a screen !</strong>');
            }

            if (!$('input[name=seating]:checked').val()) {
                e.preventDefault();
                submit = 'false';
                $('span.seating-error').html('<strong>Please choose a value !</strong>');
            }

            if (!$('input[name=comps]:checked').val()) {
                e.preventDefault();
                submit = 'false';
                $('span.comps-error').html('<strong>Please choose a value !</strong>');
            }
            if (!$('input[name=status]:checked').val()) {
                e.preventDefault();
                submit = 'false';
                $('span.status-error').html('<strong>Please choose a value !</strong>');
            }
            if (!$('input[name=show_type]:checked').val()) {
                e.preventDefault();
                submit = 'false';
                $('span.show-type-error').html('<strong>Please choose a value !</strong>');
            }

            if ($('div.price-card-div').is(':visible')) {
                if ($('#price-card-select').val() == '') {
                    e.preventDefault();
                    submit = 'false';
                    $('span.price-card-error').html('<strong>Please choose a price card !</strong>');
                }
            }

            if ($('div.no-price-card-div').is(':visible')) {
                e.preventDefault();
                submit = 'false';
            }

            if (!$('input.select-days:checked').val()) {
                e.preventDefault();
                submit = 'false';
                $('span.days-error').html('<strong>Please choose a day !</strong>');
            }

            if ($('input.select-days:checked').val()) {
                var priceCardWeekDays = $(document).find('input.price-card-week-days').val();
                var priceCardDaysArray = priceCardWeekDays.split(',');
                priceCardDaysArray = $.map(priceCardDaysArray, function (n, i) {
                    return n.toLowerCase();
                });
                console.log(priceCardDaysArray);
                $('input.select-days:checked').each(function () {
//                    alert($.inArray( $(this).val(), priceCardDaysArray ));
//                    alert(priceCardDaysArray);
                    if ($(this).val() != 'every-day') {
                        if ($.inArray($(this).val(), priceCardDaysArray) < 0) {
                            e.preventDefault();
                            submit = 'false';
                            $('span.days-error').html('<strong>Selected days did not match the choosed price card ! </strong>');
                        }
                    }

                });

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
                submit = 'false';
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
                                submit = 'false';
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
                submit = 'false';
                $('span.sales-via-error').html('<strong>Please choose a sales via field !</strong>');
            }

            if ($('input[name=clean_up_time]').val() == '') {
                e.preventDefault();
                submit = 'false';
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
                            submit = 'false';
                            $('span.days-error').html('<strong>Show time cannot be set in the past !</strong>');
                        }
                    }
                });
            }

            if ($(document).find('select#price-card-select').val() != '') {

                var priceCardStartTime = $(document).find('input.price-card-start-time').val();
                var priceCardEndTime = $(document).find('input.price-card-end-time').val();
                var hours = Number(priceCardStartTime.match(/^(\d+)/)[1]);
                var minutes = Number(priceCardStartTime.match(/:(\d+)/)[1]);
                var AMPM = priceCardStartTime.match(/\s(.*)$/)[1];
                if (AMPM == "PM" && hours < 12) hours = hours + 12;
                if (AMPM == "AM" && hours == 12) hours = hours - 12;
                var sHours = hours.toString();
                var sMinutes = minutes.toString();
                if (hours < 10) sHours = "0" + sHours;
                if (minutes < 10) sMinutes = "0" + sMinutes;
                priceCardStartTime = sHours + ":" + sMinutes;

                var hours = Number(priceCardEndTime.match(/^(\d+)/)[1]);
                var minutes = Number(priceCardEndTime.match(/:(\d+)/)[1]);
                var AMPM = priceCardEndTime.match(/\s(.*)$/)[1];
                if (AMPM == "PM" && hours < 12) hours = hours + 12;
                if (AMPM == "AM" && hours == 12) hours = hours - 12;
                var sHours = hours.toString();
                var sMinutes = minutes.toString();
                if (hours < 10) sHours = "0" + sHours;
                if (minutes < 10) sMinutes = "0" + sMinutes;
                priceCardEndTime = sHours + ":" + sMinutes;

                $(document).find('input.show-time-input').each(function () {
                    var choosedTime = $(this).val();
                    if (Date.parse('01/01/2011 ' + choosedTime) < Date.parse('01/01/2011 ' + priceCardStartTime)) {
                        e.preventDefault();
                        submit = 'false';
                        $(document).find('span.show-time-error').html('<strong>Given times did not match the choosed price card !</strong>');
                    }

                    if (Date.parse('01/01/2011 ' + choosedTime) > Date.parse('01/01/2011 ' + priceCardEndTime)) {
                        e.preventDefault();
                        submit = 'false';
                        $(document).find('span.show-time-error').html('<strong>Given times did not match the choosed price card !</strong>');
                    }

                    var lastInputValArr = choosedTime.split(':');
                    var movieDuration = $(document).find('#film option:selected').data('duration');
                    var totalDuration = parseInt(movieDuration + parseInt($('input[name=clean_up_time]').val()));
                    var minutesToAdd = totalDuration % 60;
                    var hoursToAdd = Math.floor(totalDuration / 60);
                    var minute = (parseInt(lastInputValArr[1]) + parseInt(minutesToAdd));
                    var newMinute = minute % 60;
                    var newHour = ((parseInt(parseInt(lastInputValArr[0]) + parseInt(hoursToAdd))) + (parseInt(Math.floor(minute / 60))));
                    if (newHour.toString().length == 1) {
                        newHour = 0 + newHour.toString();
                    }
                    if (newMinute.toString().length == 1) {
                        newMinute = 0 + newMinute.toString();
                    }
                    var newTime = newHour + ':' + newMinute;
                    if (Date.parse('01/01/2011 ' + newTime) > Date.parse('01/01/2011 ' + priceCardEndTime)) {
                        e.preventDefault();
                        submit = 'false';
                        $(document).find('span.show-time-error').html('<strong>Show times exceeded price card time !</strong>');
                    }
                });
            }

            var numberOfShowTimes = $(document).find('input.show-time-input').length;
            var movieDuration = $(document).find('#film option:selected').data('duration');
            var cleanUpDuration = $('input[name=clean_up_time]').val();
            var totalDuration = parseInt(movieDuration + parseInt($('input[name=clean_up_time]').val()));
            for (var i = 1; i <= numberOfShowTimes; i++) {
                for (var j = (i + 1); j <= numberOfShowTimes; j++) {
                    var time1 = $(document).find('input#time' + i).val();
                    var time2 = $(document).find('input#time' + j).val();
                    var minutesBetween = (Date.parse('January 1, 1971 ' + time2) - Date.parse('January 1, 1971 ' + time1)) / 60000;
                    if (minutesBetween < totalDuration) {
                        e.preventDefault();
                        submit = 'false';
                        $(document).find('span.show-time-error').html('<strong>The show times conflict as movie duration is ' + movieDuration + ' minutes and clean up time is ' + cleanUpDuration + ' minutes !</strong>');
                    }
                }
            }

            if (submit == 'true') {
                e.preventDefault();
                $(document).find('input.choosed-show-dates').remove();
                $(document).find('input.select-days:checked').each(function () {
                    if ($(this).val() != 'every-day') {
                        var fullDate = $(document).find('input.show-date-' + $(this).val()).val();
                        fullDate = new Date(fullDate);
                        var chYear = fullDate.getFullYear();
                        var chMonth = ("0" + parseInt(fullDate.getMonth() + 1)).slice(-2);
                        var chDate = ("0" + fullDate.getDate()).slice(-2);
                        var sd = chYear + '-' + chMonth + '-' + chDate;
                        $(document).find('form').append('<input value="' + sd + '" class="choosed-show-dates" name="choosed_show_dates[]" type="hidden">');
                    }

                });

                $(document).find('button[type=submit]').prop('disabled', true);
                $(document).find('span.submit-processing').show();
                var formData = $('form').serialize();
                if($('form').find('button[type=submit]').text() == 'Save')
                {
                    $.ajax({
                        url: baseurl + '/admin/programming/submit',
                        type: 'post',
                        data: formData,
                        success: function (data) {
                            if (data == 'success') {
                                $("form")[0].reset();
                                $('div.price-card-div').hide();
                                $('div.no-price-card-div').hide();
                                $('form').find('span.error').html('');
                                $(document).find('input.show-time-input').each(function () {
                                    if ($(this).attr('id') == 'time1') {
                                        $(this).val('');
                                    } else {
                                        $(this).remove();
                                    }
                                });
                                $('div.addAShowDiv').fadeOut('slow');
                                $('html, body').animate({
                                    scrollTop: 0
                                }, 500);
                                $('#calendar').fullCalendar( 'refetchEvents' );
                            }

                            if (data == 'unsuccess') {
                                alerify.alert('Oops ! something went wrong. Schedule not saved.');
                            }

                            if (data == 'conflict') {
                                alertify.alert('Oops ! the given schedule conflicts with other schedule.');
                            }

                            $(document).find('button[type=submit]').prop('disabled', false);
                            $(document).find('span.submit-processing').hide();
                        }, error: function (data) {
                            alertify.alert('Oops ! something went wrong. Schedule not saved.');
                            $(document).find('button[type=submit]').prop('disabled', false);
                            $(document).find('span.submit-processing').hide();
                        }
                    });
                }else{
                    var editId = $('form').find('input.editId').val();
                    $.ajax({
                        url: baseurl + '/admin/programming/update',
                        type: 'post',
                        data: formData,
                        success: function (data) {
                            if (data == 'success') {
                                $("form")[0].reset();
                                $('div.price-card-div').hide();
                                $('div.no-price-card-div').hide();
                                $('form').find('span.error').html('');
                                $(document).find('input.show-time-input').each(function () {
                                    if ($(this).attr('id') == 'time1') {
                                        $(this).val('');
                                    } else {
                                        $(this).remove();
                                    }
                                });
                                $('div.addAShowDiv').fadeOut('slow');
                                $('html, body').animate({
                                    scrollTop: 0
                                }, 500);
                                $('#calendar').fullCalendar( 'refetchEvents' );
                            }

                            if (data == 'unsuccess') {
                                alerify.alert('Oops ! something went wrong. Schedule not updated.');
                            }

                            if (data == 'conflict') {
                                alertify.alert('Oops ! the given schedule conflicts with other schedule.');
                            }

                            $(document).find('button[type=submit]').prop('disabled', false);
                            $(document).find('span.submit-processing').hide();
                        }, error: function (data) {
                            alertify.alert('Oops ! something went wrong. Schedule not saved.');
                            $(document).find('button[type=submit]').prop('disabled', false);
                            $(document).find('span.submit-processing').hide();
                        }
                    });
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
        $('input[name=clean_up_time]').keypress(function (event) {
            $(document).find('input.show-time-input').each(function () {
                if ($(this).attr('id') == 'time1') {

                } else {
                    $(this).remove();
                }
            });
            return isNumber(event, this);
        });



        $('input[name=clean_up_time]').keypress(function (event) {
            return isNumber(event, this);
        });


        $('input[name=clean_up_time]').change(function (event) {
            $(document).find('input.show-time-input').each(function () {
                if ($(this).attr('id') == 'time1') {

                } else {
                    $(this).remove();
                }
            });
        });



        $(document).on('change', '#film', function () {
            $(document).find('input.show-time-input').each(function () {
                if ($(this).attr('id') == 'time1') {

                } else {
                    $(this).remove();
                }
            });
        });


    </script>
    {{--form-script--}}


    {{--timeline-script--}}
    <script>

        var current_view = "day";
        $(window).on('load', function () {
            $(function () { // document ready
                var colors = ['#ff0000', '#ff9a00', '#ffec00', '#bdff00', '#00c200', '#65ffff', '#3875db', '#8700a1', '#f11eec', '#b7b7b7', '#ffc8de', '#ffd8ae', '#f7f6cd', '#a5ffc1'];
                var colorIndex = 0;

                $('#calendar').fullCalendar({
                    eventClick: function (calEvent, jsEvent, view) {
                        $("form")[0].reset();
                        $('div.price-card-div').hide();
                        $('div.no-price-card-div').hide()
                        $('form').find('span.error').html('');
                        $('form').find('div.stDivAppended').not(':first').remove();
                        $('div.addAShowDiv').fadeOut('slow');
                        var scheduleId = calEvent.unique_id;
                        $('form').find('input.editId').remove();
                        $('form').append('<input class="editId" name="scheduleIdToEdit" value="'+scheduleId+'" type="hidden">');
                        $('form').find('a.removeSchedule').remove();
                        $('form').prepend('<a href="#" class="removeSchedule" data-scheduleid="'+scheduleId+'"><i class="fa fa-trash"></i> Remove This Schedule</a>');
                        $.ajax({
                           url: baseurl+'/admin/programming/getScheduleData?sid='+scheduleId,
                            type: 'get',
                            success: function (data) {
                               console.log(data);
                               $('form').find('input.purpose').remove();
                               $('form').append('<input class="purpose" value="edit" type="hidden">');
                                $('div.addAShowDiv').fadeIn('slow');
                                $('#film').val(data.scheduleData.movie_id);
                                $('.select-screen-id[value='+data.scheduleData.screen_id+']').prop('checked', true);

                                var html = '';
                                for(var k = 0; k < data.priceCardData.length; k++)
                                {
                                    html += '<option value="'+data.priceCardData[k]+'">'+data.priceCardData[k]+'</option>'
                                }

                                $('#price-card-select').html(html);
                                $('#price-card-select').val(data.scheduleData.price_card_name);
                                $('div.price-card-div').show();
                                var dbDay = data.scheduleData.show_day.slice(0,3);
                                $('.select-days[value='+dbDay.toLowerCase()+']').prop('checked', true);
                                $(document).find('input[name=clean_up_time]').val(data.scheduleData.clean_up_time);
                                $(document).find('input#time1').val(data.showTime);
                                $(document).find('.select-sales-via').each(function(){
                                    if($.inArray($(this).val(), data.salesVia)  != -1)
                                    {
                                        $(this).prop('checked', true);
                                    }
                                });
                                $(document).find('input[name=seating][value='+data.scheduleData.seating+']').prop('checked', true);
                                $(document).find('input[name=comps][value='+data.scheduleData.comps+']').prop('checked', true);
                                $(document).find('input[name=status][value='+data.scheduleData.status+']').prop('checked', true);
                                $('form').find('.screenIdCheckbox').each(function(data){
                                   $(this).removeAttr('type').attr('type', 'radio');
                                });
                                $('form').find('.select-screen-id[value=all]').prop('disabled', true);
                                $('form').find('.dayCheckBox').each(function(data){
                                    $(this).removeAttr('type').attr('type', 'radio');
                                });

                                $('form').find('.select-days[value=every-day]').prop('disabled', true);
                                $('form').find('button[type=submit]').text('Update');
                                    var choosedPriceCard = $('select[name=price_card]').val();
                                    $.ajax({
                                        url: baseurl + '/admin/programming/get-pricecard-time?pc=' + choosedPriceCard,
                                        type: 'get',
                                        success: function (data) {
                                            $(document).find('input.price-card-start-time').remove();
                                            $(document).find('input.price-card-end-time').remove();
                                            $(document).find('input.price-card-week-days').remove();
                                            $(document).find('form').append('<input type="hidden" class="price-card-start-time" value="' + data[0] + '">');
                                            $(document).find('form').append('<input type="hidden" class="price-card-end-time" value="' + data[1] + '">');
                                            $(document).find('form').append('<input type="hidden" class="price-card-week-days" value="' + data[2] + '">');
                                        }, error: function (data) {
                                            $(document).find('select[name=price_card]').val('');
                                            alertify.alert('Oops ! something went wrong. Please try again.');
                                        }
                                    });
                                $('html, body').animate({
                                    scrollTop: $(".addAShowDiv").offset().top - 80
                                }, 500);
                            }
                        });

                    },
                    editable: false, // disable draggable events
                    scrollTime: '06:00', // undo default 6am scrollTime
                    customButtons: { // Custom Button
                        myCustomButton: {
                            text: ' '
                        }
                    },

                    header: {
                        left: 'today prev,next',
                        center: 'myCustomButton',
                        right: 'timelineDay,agendaWeek,month,listWeek'
                    },
                    defaultView: 'timelineDay',
                    viewRender: function (view) {
//                        $('#calendar').fullCalendar( 'refetchEvents' );
                        $('.fc-myCustomButton-button').text(view.title); // Set Text of Custom Button everytime view changes
                        current_view = view.name;
                        $('.add-new-show').next('span').remove();
                        if (current_view!="timelineDay") {
                            $("form")[0].reset();
                            $('div.price-card-div').hide();
                            $('div.no-price-card-div').hide();
                            $('form').find('span.error').html('');
                            $('form').find('div.stDivAppended').not(':first').remove();
                            $('div.addAShowDiv').fadeOut('slow');
                        }



                        var defaultDays = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
                        var curr = new Date($(document).find('.fc-myCustomButton-button').text()); // get current date
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



                    },


                    resources: [
                        @foreach(\App\Screen\Screen::where('admin_id', \Illuminate\Support\Facades\Auth::guard('admin')->user()->id)->orderBy('screen_number', 'ASC')->get() as $sc)
                        { id: '{{$sc->id}}', title: '{{$sc->name}}', eventColor: getColor(colorIndex) },
                        @endforeach
                    ],
                    eventSources: [
                        {
                            url: baseurl+'/admin/programming/events', // use the `url` property
                        }

                    ],

                });

                function getColor(index)
                {
                    colorIndex++;
                    return colors[index];
                }



//            $('.fc-myCustomButton-button').attr('id', 'datepicker-custom');

                $('.fc-myCustomButton-button').addClass('datepicker');

                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                });


                $('.datepicker').on('changeDate', function (ev) {
                    $('.datepicker-dropdown').hide();
                    $('#calendar').fullCalendar('gotoDate', ev.date);

                    var defaultDays = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
                    var curr = new Date($(document).find('.fc-myCustomButton-button').text()); // get current date
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


                var defaultDays = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
                var curr = new Date($(document).find('.fc-myCustomButton-button').text()); // get current date
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

        });

        $(document).on('click', 'a.removeSchedule', function(e){
            e.preventDefault();
            var scheduleId = $(this).data('scheduleid');
            alertify.confirm("Delete this schedule ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/programming/delete-schedule?scheduleId=' + scheduleId,
                        type: 'get',
                        success: function (data) {
                            if (data == 'true') {
                                $("form")[0].reset();
                                $('div.price-card-div').hide();
                                $('div.no-price-card-div').hide();
                                $('form').find('span.error').html('');
                                $(document).find('input.show-time-input').each(function () {
                                    if ($(this).attr('id') == 'time1') {
                                        $(this).val('');
                                    } else {
                                        $(this).remove();
                                    }
                                });
                                $('div.addAShowDiv').fadeOut('slow');
                                $('html, body').animate({
                                    scrollTop: 0
                                }, 500);
                                $('#calendar').fullCalendar( 'refetchEvents' );
                            } else {
                                alertify.alert("Oops ! something went wrong. Please try again.");
                            }
                        }, error: function (data) {
                            alertify.alert("Oops ! something went wrong. Please try again.");
                        }
                    });
                },
                function () {

                });
        });
    </script>
    {{--timeline script--}}

    <script>
//        $(document).find('input.datepicker').on('click', function () {
//            $(document).find('td.active').on('click', function () {
//                return false;
//            });
//        });
        $('.add-new-show').on('click', function () {
           // alert(current_view);
            if (current_view=="timelineDay") {
                $("form")[0].reset();
                $('div.price-card-div').hide();
                $('div.no-price-card-div').hide()
                $('form').find('span.error').html('');
                $('form').find('div.stDivAppended').not(':first').remove();
                $('div.addAShowDiv').fadeIn('slow');
                $('html, body').animate({
                    scrollTop: $(".addAShowDiv").offset().top - 80
                }, 500);
                $('form').find('.screenIdCheckbox ').each(function(data){
                    $(this).removeAttr('type').attr('type', 'checkbox');
                });
                $('form').find('.select-screen-id[value=all]').prop('disabled', false);
                $('form').find('.select-days[value=every-day]').prop('disabled', false);
                $('form').find('.dayCheckBox').each(function(data){
                    $(this).removeAttr('type').attr('type', 'checkbox');
                });
                $('form').find('input.purpose').remove();
                $('form').find('input.editId').remove();
                $('form').append('<input class="purpose" value="store" type="hidden">');
                $('form').find('button[type=submit]').text('Save');
                $('form').find('a.removeSchedule').remove();
            }
            else{
             $('.add-new-show').parent().append('<span class="restrict-show"  role="alert">You can add new shows only in Day View</span>');
            }
        });


        $('.close-add-show-div').on('click', function () {
            $("form")[0].reset();
            $('div.price-card-div').hide();
            $('div.no-price-card-div').hide();
            $('form').find('span.error').html('');
            $('form').find('div.stDivAppended').not(':first').remove();
            $('div.addAShowDiv').fadeOut('slow');
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });





        $(window).on('load', function () {
            $("form")[0].reset();
            $('div.price-card-div').hide();
            $('div.no-price-card-div').hide();
        });

    </script>
@stop