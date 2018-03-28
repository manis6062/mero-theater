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

                                                                    @for ($j = 1; $j <= $noOfColumns; $j++)
                                                                        @php $titleCount += 1; @endphp
                                                                        <td id="" class="{{$class}}"
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

                                                                    @for ($j = $noOfColumns; $j >= 1; $j--)
                                                                        <td class="{{$class}}"
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
                                                                    @foreach($seatCategories as $seatCategory)
                                                                        @php $alphabetRangeArray = range($seatCategory['category_from_row'], $seatCategory['category_to_row']); @endphp
                                                                        @if(in_array($alphebtName, $alphabetRangeArray))
                                                                            @php $categoryName = $seatCategory->category_name; @endphp
                                                                             
                                                                        @endif
                                                                    @endforeach
                                                                    @for ($j = 1; $j <= $noOfColumns; $j++)
                                                                        @if(!in_array($i.'-'.$j, $pathArr))
                                                                            @php $titleCount += 1; @endphp
                                                                        @endif
                                                                        <td id=""
                                                                            class="{{!in_array($i.'-'.$j, $pathArr) ? ''.$class.'' : 'inactiveSeat'}}"
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

                                                                    @for ($j = $noOfColumns; $j >= 1; $j--)
                                                                        <td class="{{!in_array($i.'-'.$j, $pathArr) ? ''.$class.'' : 'inactiveSeat'}}"
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


                                            <div class="slected-seat" style="display: none;">
                                                <h5>Selected Seat</h5>
                                                <span>a1</span><span>a2</span>
                                            </div>
                                            <div class="ticket-amount" style="display: none;">
                                                <span>amount :</span><span class="total-amount">350</span>
                                            </div>
                                            <div class="tkt-book-btn" style="display: none;">
                                                <a href="#" class="btn btn-primary">Book Now</a>
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
@stop

@section('scripts')
    <script>
        $(document).find('.available-seat').on('click', function () {
            $(this).removeClass('available-seat').addClass('selected-seat');
        });
    </script>
@stop