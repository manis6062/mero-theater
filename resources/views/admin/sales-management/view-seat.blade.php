@extends('admin.layout.master1')

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

        #place .sold-seat {
            background: url("{{asset('screen/sold-seat-image/'.$screen->sold_seat)}}") no-repeat scroll 0 0 transparent;
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
    <div class="app-main">
        <header class="main-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="page-icon">
                            <i class="icon-tabs-outline"></i>
                        </div>
                        <div class="page-title">
                            <h5>Sold Report (Seat)</h5>
                            <h6 class="sub-heading">Welcome to Merotheatre Admin</h6>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="right-actions">
                            <span class="last-login">@include('admin.last-login-time')</span>
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
                                                                            @if(in_array($seatName, $soldSeats))
                                                                                @php $class = 'sold-seat'; @endphp
                                                                            @elseif(in_array($seatName, $temporaryReservedSeats))
                                                                                @php $class = 'reserved-seat'; @endphp
                                                                            @elseif(in_array($seatName, $reservedSeats))
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
                                                                            @if(in_array($seatName, $soldSeats))
                                                                                @php $class = 'sold-seat'; @endphp
                                                                            @elseif(in_array($seatName, $temporaryReservedSeats))
                                                                                @php $class = 'reserved-seat'; @endphp
                                                                            @elseif(in_array($seatName, $reservedSeats))
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
                                                                            @if(in_array($seatName, $soldSeats))
                                                                                @php $class = 'sold-seat'; @endphp
                                                                            @elseif(in_array($seatName, $temporaryReservedSeats))
                                                                                @php $class = 'reserved-seat'; @endphp
                                                                            @elseif(in_array($seatName, $reservedSeats))
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
                                                                            @if(in_array($seatName, $soldSeats))
                                                                                @php $class = 'sold-seat'; @endphp
                                                                            @elseif(in_array($seatName, $temporaryReservedSeats))
                                                                                @php $class = 'reserved-seat'; @endphp
                                                                            @elseif(in_array($seatName, $reservedSeats))
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
    </div>
@stop