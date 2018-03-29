@extends('counter-management.layout.master1')

@section('styles')
    <style>
        .seatDiv {
            border: 1px solid #ddd;
            padding: 3%;
        }

        #place {
            margin: 0 auto;
        }

        #place .available-seat {
            background: url("{{asset('screen/available-seat-image/'.$screen->available_seat)}}") no-repeat scroll 0 0 transparent;
        }

        #place .selected-seat {
            background: url("{{asset('screen/selected-seat-image/'.$screen->selected_seat)}}") no-repeat scroll 0 0 transparent;
        }

        #place .reserved-seat {
            background: url("{{asset('screen/reserved-seat-image/'.$screen->reserved_seat)}}") no-repeat scroll 0 0 transparent;
            cursor: not-allowed;
        }

        .available-seat-legend {
            background: url("{{asset('screen/available-seat-image/'.$screen->available_seat)}}") no-repeat scroll 0 0 transparent;
        }

        .sold-seat-legend {
            background: url("{{asset('screen/sold-seat-image/'.$screen->sold_seat)}}") no-repeat scroll 0 0 transparent;
        }

        .reserved-seat-legend {
            background: url("{{asset('screen/reserved-seat-image/'.$screen->reserved_seat)}}") no-repeat scroll 0 0 transparent;
        }

        .selected-seat-legend {
            background: url("{{asset('screen/selected-seat-image/'.$screen->selected_seat)}}") no-repeat scroll 0 0 transparent;
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

        #load-modal {
            display: none;
            position: absolute;
            top: 30%;
            left: 50%;
            width: 64px;
            height: 64px;
            padding: 15px;
            border: 3px solid #ababab;
            box-shadow: 1px 1px 10px #ababab;
            border-radius: 20px;
            background-color: white;
            z-index: 1002;
            text-align: center;
            overflow: auto;
        }

        #load-fade {
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            background-color: #fff;
            z-index: 1001;
            -moz-opacity: 0.8;
            opacity: .70;
            filter: alpha(opacity=80);
        }
    </style>
@stop

@section('main-body')
    <header class="main-heading">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <div class="page-icon" data-toggle="tooltip" data-placement="bottom" title=""
                         data-original-title="Back">
                        <a href="{{url(\Illuminate\Support\Facades\Session::get('redirect-url'))}}"><i
                                    class="icon-arrow-left4"></i></a>
                    </div>
                    <div class="page-title">
                        <h5>{{$screen->name}}</h5>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                    <div class="right-ac5460-54we+
                     ``tions">

                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="main-content">

        <!-- Row start -->
        <div class="movie-details">
            <div class=" col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-xl-10 col-md-9 col-sm-9 col-xm-8">
                        <div class="card">
                            <div class="text-center" id="remaining-timer-div" style="height: 10px;"></div>
                            <div class="card-body">
                                <div class="card-header">
                                    <h4>
                                        Movie : {{$movie->movie_title}}
                                        <span>({{$schedule->price_card_name}})</span>
                                        <em>
                                            <span class="movie-date">Date | Time : {{date('M d, Y', strtotime($date))}}
                                                | {{$time}}</span><span
                                                    class="movie-details-duration"> Movie Duration: {{$movie->duration}}
                                                mins
                                            </span>
                                        </em>
                                    </h4>

                                </div>

                                <div class="seatlist-wrapper">
                                    <div class="movie-seat-list">
                                        <div id="load-fade"></div>
                                        <div id="load-modal">
                                            <img id="loader" src="{{asset('admins/loader/loading.gif')}}"/>
                                        </div>
                                        @if(isset($seatData) && $seatData->count() > 0)
                                            @php
                                                $class = 'available-seat';
                                                $noOfRows = $seatData->num_rows;
                                                $noOfColumns = $seatData->num_columns;
                                                $seatDirection = $seatData['seat_direction'];
                                                $alphaDirection = $seatData['alphabet_direction'];
                                                $alphas = range('A', 'Z');
                                                $alpCount = $noOfRows-1;
                                            @endphp
                                            @if($seatData['path'] == '0')
                                                @if ($seatDirection == 'left to right')

                                                    <div class="table-responsive seat-structure-main-div" id="place">
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

                                                                    @php $alphebtName = $alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]; @endphp
                                                                    @php $categoryPrice = json_decode($schedule->seat_categories_with_price, true); @endphp
                                                                    @foreach($seatCategories as $seatCategory)
                                                                        @php $alphabetRangeArray = range($seatCategory['category_from_row'], $seatCategory['category_to_row']); @endphp
                                                                        @if(in_array($alphebtName, $alphabetRangeArray))
                                                                            @php $categoryName = $seatCategory->category_name; @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                    @foreach($categoryPrice as $catPrice)
                                                                        @if($catPrice['category_name'] == $categoryName)
                                                                            @php $categoryPrice = $catPrice['category_price']; @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                    @for ($j = 1; $j <= $noOfColumns; $j++)
                                                                        @php $titleCount += 1; @endphp
                                                                        @php $seatName = $alphaDirection == 'top to bottom' ? $alphas[$i-1].$titleCount : $alphas[$alpCount].$titleCount; @endphp
                                                                        @if(in_array($seatName, $temporaryReservedSeats))
                                                                            @php $class = 'reserved-seat'; @endphp
                                                                        @else
                                                                            @php $class = 'available-seat'; @endphp
                                                                        @endif
                                                                        <td id="" class="seat {{$class}}"
                                                                            data-categoryname="{{$categoryName}}"
                                                                            data-categoryprice="{{$categoryPrice}}"
                                                                            title="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1].$titleCount : $alphas[$alpCount].$titleCount}}"></td>
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

                                                                    @php $alphebtName = $alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]; @endphp
                                                                    @php $categoryPrice = json_decode($schedule->seat_categories_with_price, true); @endphp
                                                                    @foreach($seatCategories as $seatCategory)
                                                                        @php $alphabetRangeArray = range($seatCategory['category_from_row'], $seatCategory['category_to_row']); @endphp
                                                                        @if(in_array($alphebtName, $alphabetRangeArray))
                                                                            @php $categoryName = $seatCategory->category_name; @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                    @foreach($categoryPrice as $catPrice)
                                                                        @if($catPrice['category_name'] == $categoryName)
                                                                            @php $categoryPrice = $catPrice['category_price']; @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach

                                                                    @for ($j = $noOfColumns; $j >= 1; $j--)
                                                                        @php $seatName = $alphaDirection == 'top to bottom' ? $alphas[$i-1].$titleCount : $alphas[$alpCount].$titleCount; @endphp
                                                                        @if(in_array($seatName, $temporaryReservedSeats))
                                                                            @php $class = 'reserved-seat'; @endphp
                                                                        @else
                                                                            @php $class = 'available-seat'; @endphp
                                                                        @endif
                                                                        <td class="seat {{$class}}"
                                                                            data-categoryname="{{$categoryName}}"
                                                                            data-categoryprice="{{$categoryPrice}}"
                                                                            title="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1].$titleCount : $alphas[$alpCount].$titleCount}}"></td>
                                                                        @php $titleCount -= 1; @endphp

                                                                        @if ($j == 1)
                                                                            <td>
                                                                                <input readonly
                                                                                       value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                                                       style="float: right;" type="text"
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
                                                @php $pathArr = json_decode($seatData['path'], true); @endphp

                                                @if ($seatDirection == 'left to right')
                                                    <div class="table-responsive seat-structure-main-div" id="place">
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

                                                                    @php $alphebtName = $alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]; @endphp
                                                                    @php $categoryPrice = json_decode($schedule->seat_categories_with_price, true); @endphp
                                                                    @foreach($seatCategories as $seatCategory)
                                                                        @php $alphabetRangeArray = range($seatCategory['category_from_row'], $seatCategory['category_to_row']); @endphp
                                                                        @if(in_array($alphebtName, $alphabetRangeArray))
                                                                            @php $categoryName = $seatCategory->category_name; @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                    @foreach($categoryPrice as $catPrice)
                                                                        @if($catPrice['category_name'] == $categoryName)
                                                                            @php $categoryPrice = $catPrice['category_price']; @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                    @for ($j = 1; $j <= $noOfColumns; $j++)
                                                                        @if(!in_array($i.'-'.$j, $pathArr))
                                                                            @php $titleCount += 1; @endphp
                                                                        @endif
                                                                        @php $seatName = $alphaDirection == 'top to bottom' ? $alphas[$i-1].$titleCount : $alphas[$alpCount].$titleCount; @endphp
                                                                        @if(in_array($seatName, $temporaryReservedSeats))
                                                                            @php $class = 'reserved-seat'; @endphp
                                                                        @else
                                                                            @php $class = 'available-seat'; @endphp
                                                                        @endif
                                                                        <td id="" data-categoryname="{{$categoryName}}"
                                                                            data-categoryprice="{{$categoryPrice}}"
                                                                            class="seat {{!in_array($i.'-'.$j, $pathArr) ? ''.$class.'' : 'inactiveSeat'}}"
                                                                            title="{{!in_array($i.'-'.$j, $pathArr) ? $alphaDirection == 'top to bottom' ? $alphas[$i-1].$titleCount : $alphas[$alpCount].$titleCount : ''}}"></td>
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
                                                                    @php $alphebtName = $alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]; @endphp
                                                                    @php $categoryPrice = json_decode($schedule->seat_categories_with_price, true); @endphp
                                                                    @foreach($seatCategories as $seatCategory)
                                                                        @php $alphabetRangeArray = range($seatCategory['category_from_row'], $seatCategory['category_to_row']); @endphp
                                                                        @if(in_array($alphebtName, $alphabetRangeArray))
                                                                            @php $categoryName = $seatCategory->category_name; @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach

                                                                    @foreach($categoryPrice as $catPrice)
                                                                        @if($catPrice['category_name'] == $categoryName)
                                                                            @php $categoryPrice = $catPrice['category_price']; @endphp
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                    @for ($j = $noOfColumns; $j >= 1; $j--)
                                                                        @php $seatName = $alphaDirection == 'top to bottom' ? $alphas[$i-1].$titleCount : $alphas[$alpCount].$titleCount; @endphp
                                                                        @if(in_array($seatName, $temporaryReservedSeats))
                                                                            @php $class = 'reserved-seat'; @endphp
                                                                        @else
                                                                            @php $class = 'available-seat'; @endphp
                                                                        @endif
                                                                        <td class="seat {{!in_array($i.'-'.$j, $pathArr) ? ''.$class.'' : 'inactiveSeat'}}"
                                                                            data-categoryname="{{$categoryName}}"
                                                                            data-categoryprice="{{$categoryPrice}}"
                                                                            title="{{!in_array($i.'-'.$j, $pathArr) ? $alphaDirection == 'top to bottom' ? $alphas[$i-1].$titleCount : $alphas[$alpCount].$titleCount : ''}}"></td>
                                                                        @if(!in_array($i.'-'.$j, $pathArr))
                                                                            @php $titleCount -= 1; @endphp
                                                                        @endif

                                                                        @if ($j == 1)
                                                                            <td>
                                                                                <input readonly
                                                                                       value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                                                                       style="float: right;" type="text"
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
                                            <div class="category-div"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-3 col-sm-3 col-xm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="movie-details-sidebar">
                                    <div class="sidebar-widget">
                                        <div class="ticket-sold-list">
                                            <div class="ticket-list available-seat-legend">
                                                <span class=""></span> Available
                                            </div>
                                            <div class="ticket-list sold-seat-legend">
                                                <span class=""></span> Sold
                                            </div>
                                            <div class="ticket-list selected-seat-legend">
                                                <span class=""></span> Selected
                                            </div>
                                            <div class="ticket-list reserved-seat-legend">
                                                <span class=""></span> Reserved
                                            </div>

                                            <form id="booking-form" method="post" style="display: none;">
                                                <div class="slected-seat">
                                                    <h5>Selected Seat</h5>
                                                    <div class="selected-seat-list"></div>
                                                </div>
                                                <div class="ticket-amount">
                                                    <span>amount :</span><span class="total-amount"></span>
                                                </div>
                                                <div class="tkt-book-btn">
                                                    <input type="submit" class="btn btn-primary" value="Book Now">
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
            <!-- Row end -->

        </div>
    </div>
@stop

@section('scripts')
    {{--loading modal script--}}
    <script>
        function openModal() {
            document.getElementById('load-modal').style.display = 'block';
            document.getElementById('load-fade').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('load-modal').style.display = 'none';
            document.getElementById('load-fade').style.display = 'none';
        }
    </script>
    {{--loading modal script--}}

    {{--firebase script--}}
    <script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
    <script>
        openModal();
        var config = {
            apiKey: "{{ config('services.firebase.api_key') }}",
            authDomain: "{{ config('services.firebase.auth_domain') }}",
            databaseURL: "{{ config('services.firebase.database_url') }}",
            storageBucket: "{{ config('services.firebase.storage_bucket') }}",
        };

        firebase.initializeApp(config);
        var screen_id = "{{$_GET['screen']}}";
        var movie_id = "{{$_GET['movie']}}";
        var show_date = "{{$_GET['date']}}";
        var show_time = "{{$_GET['time']}}";
        var counter_id = "{{\Illuminate\Support\Facades\Auth::guard('counter')->user()->id}}";

        var gotSeatsNotMine = [];
        var gotSeatsMine = [];

        firebase.database().ref('temporary_reserved_seats/').on('value', function (snapshot) {
            $(document).find('.uniqueHoldId').remove();
            var gotSeatsNotMine = [];
            var gotSeatsMine = [];
            // Everytime the Firebase data changes, update the users array.
            bookings = snapshot.val();
            console.log(bookings);
            for (var prop in bookings) {
                if (bookings[prop]['screen_id'] == screen_id && bookings[prop]['movie_id'] == movie_id && bookings[prop]['show_date'] == show_date && bookings[prop]['show_time'] == show_time) {
                    if (bookings[prop]['counter_id'] == counter_id) {
                        $('form').append('<input type="hidden" class="uniqueHoldId" name="uniqueHoldId[]" value="' + bookings[prop]['unique_hold_id'] + '">');
                        gotSeatsMine.push(bookings[prop]['seat']);
                    } else {
                        gotSeatsNotMine.push(bookings[prop]['seat']);
                    }
                }
            }

            gotSeatsMine = $.unique(gotSeatsMine);
            gotSeatsNotMine = $.unique(gotSeatsNotMine);
            $(document).find('td.seat').each(function(){
                if(!$(this).hasClass('inactiveSeat'))
                {
                    if($.inArray($(this).attr('title'), gotSeatsMine) != -1)
                    {
                        $(this).removeClass('reserved-seat').removeClass('sold-seat').removeClass('available-seat').addClass('selected-seat');
                    }else if($.inArray($(this).attr('title'), gotSeatsNotMine) != -1)
                    {
                        $(this).removeClass('selected-seat').removeClass('sold-seat').removeClass('available-seat').addClass('reserved-seat');
                    }else{
                        $(this).removeClass('selected-seat').removeClass('sold-seat').removeClass('reserved-seat').addClass('available-seat');
                    }
                }

            });
            closeModal();
        });
    </script>
    {{--firebase script--}}
    <script>
        if ("{{Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($_GET['date'].' '.$_GET['time']))}}") {
            alertify.alert('This is a past show. You can only view the reports of seats.');
        } else {
            var countSelectedSeat = 0;
            $(document).find('td.seat').on('click', function () {
                if ($(this).hasClass('reserved-seat')) {
                    return false;
                }
                openModal();

                if ($(this).hasClass('available-seat')) {
                    var price = $(this).data('categoryprice');
                    var seat = $(this).attr('title');
                    var process = 'yes';
                    var dataToSend = {
                        screen_id: "{{$_GET['screen']}}",
                        movie_id: "{{$_GET['movie']}}",
                        show_date: "{{$_GET['date']}}",
                        show_time: "{{$_GET['time']}}",
                        processed_by: 'counter',
                        counter_id: "{{\Illuminate\Support\Facades\Auth::guard('counter')->user()->id}}",
                        seat: seat,
                        _token: "{{csrf_token()}}"
                    };

                    $.ajax({
                        url: baseurl + '/counter-management/booking/check-booking',
                        type: 'POST',
                        data: dataToSend,
                        async: false,
                        success: function (data) {

                            if (data.status == 'blocked') {
                                alertify.alert('This seat is under process.');
                                $('.available-seat').each(function () {

                                    if ($.inArray($(this).attr('title'), data.seats) != -1) {
                                        $(this).removeClass('available-seat');
                                        $(this).addClass('reserved-seat');
                                    }
                                });
                                process = 'no';
                                closeModal();
                            } else {
                                countSelectedSeat++;
                                $('form').append('<input type="hidden" class="uniqueHoldId" name="uniqueHoldId[]" value="' + data.unique_hold_id + '">');
                                if (countSelectedSeat == 1) {
                                    setInterval(showTimer, 1000);
                                }


                                closeModal();
                            }
                        }, error: function () {
                            alerify.alert('Oops ! something went wrong. Please Try Again.');
                            closeModal();
                        }
                    });

                    if (process == 'yes') {
                        $(this).removeClass('available-seat').addClass('selected-seat');
                        $('form#booking-form').show();

                        if ($('div.selected-seat-list').html() == '') {
                            $('div.selected-seat-list').html('<span>' + seat + '</span>');
                            $('span.total-amount').html(price);
                            $('form').find('input.seatChoosed').remove();
                            $('form').find('input.noOfSeatsChoosed').remove();
                            $('form').find('input.totalPriceOfTic').remove();
                            $('form').append('<input type="hidden" class="seatChoosed" name="seatChoosed" value="' + seat + '">');
                            $('form').append('<input type="hidden" class="noOfSeatsChoosed" name="noOfSeatsChoosed" value="' + $('td.selected-seat').length + '">');
                            $('form').append('<input type="hidden" class="totalPriceOfTic" name="totalPriceOfTic" value="' + price + '">');
                        } else {
                            var setArr = [];
                            $('div.selected-seat-list').children('span').each(function () {
                                setArr.push($(this).text());
                            });

                            var calculatedPrice = $('span.total-amount').text();
                            var totAmt = parseFloat(calculatedPrice) + parseFloat(price);

                            setArr.push(seat);
                            var html = '';
                            for (var m = 0; m < setArr.length; m++) {
                                html += '<span>' + setArr[m] + '</span>';
                            }
                            $('div.selected-seat-list').html(html);
                            $('span.total-amount').html(totAmt);

                            $('form').find('input.seatChoosed').remove();
                            $('form').find('input.noOfSeatsChoosed').remove();
                            $('form').find('input.totalPriceOfTic').remove();
                            $('form').append('<input type="hidden" class="seatChoosed" name="seatChoosed" value="' + setArr.join(',') + '">');
                            $('form').append('<input type="hidden" class="noOfSeatsChoosed" name="noOfSeatsChoosed" value="' + $('td.selected-seat').length + '">');
                            $('form').append('<input type="hidden" class="totalPriceOfTic" name="totalPriceOfTic" value="' + totAmt + '">');
                        }


                    }
                } else if ($(this).hasClass('selected-seat')) {
                    openModal();
                    var price = $(this).data('categoryprice');
                    var seat = $(this).attr('title');

                    var dataToSend = {
                        screen_id: "{{$_GET['screen']}}",
                        movie_id: "{{$_GET['movie']}}",
                        show_date: "{{$_GET['date']}}",
                        show_time: "{{$_GET['time']}}",
                        processed_by: 'counter',
                        counter_id: "{{\Illuminate\Support\Facades\Auth::guard('counter')->user()->id}}",
                        seat: seat,
                        _token: "{{csrf_token()}}"
                    };

                    $.ajax({
                        url: baseurl + '/counter-management/booking/remove-booking',
                        type: 'POST',
                        data: dataToSend,
                        async: false,
                        success: function (data) {
                            $(document).find('input.uniqueHoldId[value=' + data + ']').remove();
                        }
                    });

                    $(this).removeClass('selected-seat').addClass('available-seat');
                    var setArr = [];
                    $('div.selected-seat-list').children('span').each(function () {
                        setArr.push($(this).text());
                    });

                    setArr = jQuery.grep(setArr, function (value) {
                        return value != seat;
                    });

                    var calculatedPrice = $('span.total-amount').text();
                    var totAmt = parseFloat(calculatedPrice) - parseFloat(price);
                    if (setArr.length > 0) {
                        var html = '';
                        for (var m = 0; m < setArr.length; m++) {
                            html += '<span>' + setArr[m] + '</span>';
                        }
                        $('div.selected-seat-list').html(html);
                        $('span.total-amount').html(totAmt);
                        $('form').find('input.seatChoosed').remove();
                        $('form').find('input.noOfSeatsChoosed').remove();
                        $('form').find('input.totalPriceOfTic').remove();
                        $('form').append('<input type="hidden" class="seatChoosed" name="seatChoosed" value="' + setArr.join(', ') + '">');
                        $('form').append('<input type="hidden" class="noOfSeatsChoosed" name="noOfSeatsChoosed" value="' + $('.selected-seat').length + '">');
                        $('form').append('<input type="hidden" class="totalPriceOfTic" name="totalPriceOfTic" value="' + totAmt + '">');
                    } else {
                        $('form').find('input.seatChoosed').remove();
                        $('form').find('input.noOfSeatsChoosed').remove();
                        $('form').find('input.totalPriceOfTic').remove();
                        $('div.selected-seat-list').html('');
                        $('span.total-amount').html('');
                        $('form#booking-form').hide();
                    }
                    closeModal();
                }

            });

            var minutes = 6;
            var seconds = 60;

            function showTimer() {
                // Update the count down every 1 second

                seconds = parseInt(seconds) - 1;
                // Display the result in the element with id="demo"

                if (minutes == -1) {
                    $("#remaining-timer-div").html('');
                } else {
                    $("#remaining-timer-div").html('<p style="font-size: 18px;">Time Left to Buy tickets <span class="time" id="remaining-timer">' + minutes + "m " + seconds + "s " + '</span></p>');
                }

                // If the count down is finished, write some text
                if (seconds == 0) {
                    seconds = 60;
                    minutes -= 1;
                    if (minutes == -1) {
                        openModal();
                        $("#remaining-timer-div").html('');
                        var uniqueHoldArray = $(document).find('input.uniqueHoldId').each(function () {
                            return $(this).val();
                        });
                        console.log(uniqueHoldArray);
                        var ar = [];
                        $(uniqueHoldArray).each(function () {
                            ar.push($(this).val());
                        });
                        $(document).find('.uniqueHoldId').remove();
                        var holdIds = JSON.stringify(ar);
                        console.log(holdIds);
                        $.ajax({
                            url: baseurl + '/counter-management/booking/remove-hold-data',
                            data: {_token: "{{csrf_token()}}", holdIds: holdIds},
                            type: 'post',
                            success: function (data) {
                                window.location.reload();
                            }
                        });
                    }
                }
                {{--$.session.set("{{$screenDetail->id.$movieDetail->id.$choosedDate.$choosedTime}}" + "minutesRemaining", minutes);--}}
                {{--$.session.set("{{$screenDetail->id.$movieDetail->id.$choosedDate.$choosedTime}}" + "secondsRemaining", seconds);--}}
            }
        }
    </script>
@stop