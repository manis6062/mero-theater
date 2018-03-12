@extends('admin.layout.master')

@section('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

    <style>
        .create-price-card-div {
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

        .day-span {
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

        .screen-span {
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

        .day-span-div {
            margin-top: 10px;
        }

        .screen-span-div {
            margin-top: 10px;
        }

        .day-selected {
            color: #629221 !important;
            background: #CCFF00 !important;
            text-shadow: 1px 1px 1px #fff !important;
        }

        .screen-selected {
            color: #629221 !important;
            background: #CCFF00 !important;
            text-shadow: 1px 1px 1px #fff !important;
        }

        .time-range-span {
            display: block;
            font-weight: bold;
        }

        #slider-range {
            width: 98%;
            margin-left: 1%;
        }

        .include-ticket-type {
            padding: 10px;
            border: 5px solid #ddd;
        }

        table {
            padding: 10px;
        }

        table input {
            width: 80px !important;
        }

        .include-ticket-header {
            display: block;
            font-size: 20px;
            font-weight: 700;
        }

        .include-ticket-body {
            font-size: 15px;
            font-weight: 500;
            display: block;
        }
    </style>
@stop


@section('main-body')
    <section class="content">
        <div class="row create-price-card-div">
            <p class="info-span">Create New Price Card</p>
            <form action="{{url('admin/box-office/price-card-management/submit')}}" class="form-horizontal"
                  id="create-form"
                  method="post"
                  enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <span>Name <small>*</small></span>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control"
                           id="name"
                           onfocus="removeError('name');" placeholder="Enter Price Card Name">
                    @if($errors->has('name'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('name')}}
                    </strong>
                </span>
                    @endif
                    <span class="name-error error help-block"></span>
                </div>

                <div class="form-group">
                    <span>Screens <small>*</small></span>
                    <div class="screen-span-div">
                        @if(isset($screens) && $screens->count() > 0)
                            @foreach($screens as $s)
                                <span onclick="removeError('screen-id');" class="screen-span"
                                      data-screenid="{{$s->id}}">{{$s->name}}</span>
                            @endforeach
                            <span onclick="removeError('screen-id');" class="screen-span screen-span-all"
                                  data-screenid="all">All</span>
                        @endif
                    </div>
                    @if($errors->has('screen_id'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('screen_id')}}
                    </strong>
                </span>
                    @endif
                    <span class="screen-id-error error help-block"></span>
                </div>

                <div class="form-group">
                    <span>Days <small>*</small></span>
                    <div class="day-span-div">
                        <span onclick="removeError('days');" class="day-span">Sun</span>
                        <span onclick="removeError('days');" class="day-span">Mon</span>
                        <span onclick="removeError('days');" class="day-span">Tue</span>
                        <span onclick="removeError('days');" class="day-span">Wed</span>
                        <span onclick="removeError('days');" class="day-span">Thu</span>
                        <span onclick="removeError('days');" class="day-span">Fri</span>
                        <span onclick="removeError('days');" class="day-span">Sat</span>
                        <span onclick="removeError('days');" class="day-span day-span-all">Every Day</span>
                    </div>
                    @if($errors->has('days'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('days')}}
                    </strong>
                </span>
                    @endif
                    <span class="days-error error help-block"></span>
                </div>

                <div class="form-group">
                    <span>Time Range <small>*</small></span>
                    <span class="time-range-span">Choose Time Range</span>
                    <div id="slider-range"></div>
                    @if($errors->has('time_range'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('time_range')}}
                    </strong>
                </span>
                    @endif
                    <span class="time-range-error error help-block"></span>
                </div>

                <div class="form-group">
                    <span>Status <small>*</small></span>
                    <select name="status" id="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @if($errors->has('status'))
                        <span class="help-block error">
                    <strong>
                        {{$errors->first('status')}}
                    </strong>
                </span>
                    @endif
                    <span class="status-error error help-block"></span>
                </div>


                <div class="form-group">

                    <div class="include-ticket-type">
                        <span class="include-ticket-header">Included Tickets</span>
                        <span class="include-ticket-body">Click the include box to include a ticket in your price card</span>

                        <table id="example" class="display" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Include</th>
                                <th>Ticket Name</th>
                                <th>Ticket Class</th>
                                <th>Ticket Type</th>
                                <th>Sequence</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($ticketTypes) && $ticketTypes->count() > 0)
                                @foreach($ticketTypes as $ts)
                                    <tr>
                                        <td><input onclick="removeError('ticket-type');" type="checkbox" name=""
                                                   class="tic-type-ids" data-ticketid="{{$ts->id}}"></td>
                                        <td>{{$ts->label}}</td>
                                        <td>{{$ts->ticket_class}}</td>
                                        <td>{{$ts->ticket_type}}</td>
                                        <td><input onfocus="removeError('ticket-type');" type="text" class="sequence-input sequence-{{$ts->id}}"
                                                   value="{{$ts->display_sequence}}"></td>
                                        <td><input onfocus="removeError('ticket-type');" type="text" class="price-input price-{{$ts->id}}"
                                                   value="{{$ts->default_price}}"></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No Ticket Types Found !</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <span class="ticket-type-error error help-block"></span>
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-primary subBtn" value="Create">
                </div>
            </form>
        </div>
    </section>
@stop

@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
    <script>
        $('.day-span').on('click', function () {
            var day = $(this).text();
            if(day == 'Every Day')
            {
                $(document).find('span.day-span').addClass('day-selected');
                $(document).find('input.sel-days').remove();
                $(document).find('form').append('<input name="days[]" value="Sun" type="hidden" class="sel-days Sun">');
                $(document).find('form').append('<input name="days[]" value="Mon" type="hidden" class="sel-days Mon">');
                $(document).find('form').append('<input name="days[]" value="Tue" type="hidden" class="sel-days Tue">');
                $(document).find('form').append('<input name="days[]" value="Wed" type="hidden" class="sel-days Wed">');
                $(document).find('form').append('<input name="days[]" value="Thu" type="hidden" class="sel-days Thu">');
                $(document).find('form').append('<input name="days[]" value="Fri" type="hidden" class="sel-days Fri">');
                $(document).find('form').append('<input name="days[]" value="Sat" type="hidden" class="sel-days Sat">');

            }else{
                $(document).find('span.day-span-all').removeClass('day-selected');
                if ($(this).hasClass('day-selected')) {
                    $(document).find('input.' + day + '').remove();
                    $(this).removeClass('day-selected');
                } else {
                    $(document).find('form').append('<input name="days[]" value="' + day + '" type="hidden" class="sel-days ' + day + '">');
                    $(this).addClass('day-selected');
                }
            }
        });

        $('.screen-span').on('click', function () {
            var screenId = $(this).data('screenid');
            if (screenId == 'all') {
                $('.screen-span').addClass('screen-selected');
                $(document).find('input.screen-ids').remove();
                @foreach($screens as $s)
                    $(document).find('form').append('<input name="screen_id[]" value="{{$s->id}}" type="hidden" class="screen-ids screenid-{{$s->id}}">');
                @endforeach
            } else {
                $(document).find('.screen-span-all').removeClass('screen-selected');
                if ($(this).hasClass('screen-selected')) {
                    $(document).find('input.screenid-' + screenId + '').remove();
                    $(this).removeClass('screen-selected');
                } else {
                    $(document).find('form').append('<input name="screen_id[]" value="' + screenId + '" type="hidden" class="screen-ids screenid-' + screenId + '">');
                    $(this).addClass('screen-selected');
                }
            }

        });


        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 1440,
            step: 15,
            values: [0, 1440],
            slide: function (event, ui) {
                removeError('time-range');
                var hours1 = Math.floor(ui.values[0] / 60);
                var minutes1 = ui.values[0] - (hours1 * 60);
                var hours2 = Math.floor(ui.values[1] / 60);
                var minutes2 = ui.values[1] - (hours2 * 60);
                if (hours1.length == 1) hours1 = '0' + hours1;
                if (minutes1.length == 1) minutes1 = '0' + minutes1;
                if (minutes1 == 0) minutes1 = '00';

                if (hours2.length == 1) hours2 = '0' + hours2;
                if (minutes2.length == 1) minutes2 = '0' + minutes2;
                if (minutes2 == 0) minutes2 = '00';

                if (hours1 >= 12) {

                    if (hours1 == 12) {
                        hours1 = hours1;
                        minutes1 = minutes1 + " PM";
                    }
                    else {
                        hours1 = hours1 - 12;
                        minutes1 = minutes1 + " PM";
                    }
                }

                else {

                    hours1 = hours1;
                    minutes1 = minutes1 + " AM";
                }
                if (hours1 == 0) {
                    hours1 = 12;
                    minutes1 = minutes1;
                }

                if (hours2 >= 12) {
                    if (hours2 == 12) {
                        hours2 = hours2;
                        minutes2 = minutes2 + " PM";
                    }
                    else if (hours2 == 24) {
                        hours2 = 11;
                        minutes2 = "59 PM";
                    }
                    else {
                        hours2 = hours2 - 12;
                        minutes2 = minutes2 + " PM";
                    }
                }
                else {
                    hours2 = hours2;
                    minutes2 = minutes2 + " AM";
                }

                $(".time-range-span").html(hours1 + ':' + minutes1 + " - " + hours2 + ':' + minutes2);
                $(document).find('input.time-range-input').remove();
                $(document).find('form').append('<input type="hidden" name="time_range" class="time-range-input sel-time-range" value="' + hours1 + ':' + minutes1 + " - " + hours2 + ':' + minutes2 + '">');
            }
        });

        $(window).on('load', function () {
            $('#example').DataTable({
                paging: false
            });
        });

        $('#create-form').on('submit', function (e) {
            $('.error').html('');
            var ticTypeCheck = 0;
            var ticSequenceCheck = 0;
            var ticSequenceUniqueCheck = 0;
            var ticPriceCheck = 0;
            var seqVal = [];
            if ($('#name').val() == '') {
                e.preventDefault();
                $('.name-error').html('<strong>Please enter the name of price card.</strong>');
            }

            if ($(document).find('input.screen-ids').length < 1) {
                e.preventDefault();
                $('.screen-id-error').html('<strong>Please choose the screen.</strong>');
            }

            if ($(document).find('input.sel-days').length < 1) {
                e.preventDefault();
                $('.days-error').html('<strong>Please choose the day.</strong>');
            }

            if ($(document).find('input.sel-time-range').length < 1) {
                e.preventDefault();
                $('.time-range-error').html('<strong>Please choose the time range.</strong>');
            }

            if ($('#status').val() == '') {
                e.preventDefault();
                $('.status-error').html('<strong>Please choose the status.</strong>');
            }


            $(document).find('input.tic-type-ids').each(function () {
                if ($(this).is(':checked')) {
                    ticTypeCheck = 1;
                }
            });

            $(document).find('input.sequence-input').each(function () {
                seqVal.push($(this).val());
                if ($(this).val() == '') {
                    ticSequenceCheck = 1;
                }
            });

            $(document).find('input.price-input').each(function () {
                if ($(this).val() == '') {
                    ticPriceCheck = 1;
                }
            });

            if (ticPriceCheck == 1) {
                e.preventDefault();
                $('.ticket-type-error').html('<strong>Please enter the price value.</strong>');
            }

            if (ticSequenceCheck == 1) {
                e.preventDefault();
                $('.ticket-type-error').html('<strong>Please enter the sequence value.</strong>');
            }

            if (ticTypeCheck == 0) {
                e.preventDefault();
                $('.ticket-type-error').html('<strong>Please include ticket type for the price card.</strong>');
            }

            if (ticSequenceCheck == 0 && ticPriceCheck == 0 && ticTypeCheck == 1) {
                for(var i = 0; i < seqVal.length; i++)
                {
                    for(var j = i+1; j < seqVal.length; j++)
                    {
                        if(seqVal[i] == seqVal[j])
                        {
                            e.preventDefault();
                            $('.ticket-type-error').html('<strong>Sequence numbers must be unique.</strong>');
                        }
                    }
                }
            }

        });


        $(document).find('input.tic-type-ids').on('click', function () {
            var ticTypeId = $(this).data('ticketid');
            var ticTypeSequence = $('input.sequence-'+ticTypeId).val();
            var ticTypePrice = $('input.price-'+ticTypeId).val();
            if(ticTypeSequence == '' || ticTypePrice == '')
            {
                $(this).prop('checked', false);
                $('.ticket-type-error').html('<strong>Please fill all the fields.</strong>');
            }else{
                if ($(this).is(':checked')) {
                    $(document).find('form').append('<input type="hidden" name="ticket_types_id[]" class="tic_types_id_'+ticTypeId+'" value="'+ticTypeId+'">');
                    $(document).find('form').append('<input type="hidden" name="ticket_types_sequence[]" class="tic_types_sequence_'+ticTypeId+'" value="'+ticTypeSequence+'">');
                    $(document).find('form').append('<input type="hidden" name="ticket_types_price[]" class="tic_types_price_'+ticTypeId+'" value="'+ticTypePrice+'">');
                }else{
                    $(document).find('input.tic_types_id_'+ticTypeId).remove();
                    $(document).find('input.tic_types_sequence_'+ticTypeId).remove();
                    $(document).find('input.tic_types_price_'+ticTypeId).remove();
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
        $('input.sequence-input').keypress(function (event) {
            return isNumber(event, this)
        });

        $(document).on('keypress', '.price-input', function (event) {
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
            $('.' + text + '-error').html('');
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
            if ($(document).find('input.usedSqNum').length > 0) {
                var arr = [];
                $(document).find('input.usedSqNum').each(function () {
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