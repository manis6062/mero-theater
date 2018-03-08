<style>
    #place {
        margin: 0 auto;
    }

    div.content{
        border: 1px solid #ddd;
        margin: 0 10%;
        margin-top: 20px;
    }

    #place .seat {
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

    .span-info{
        font-size: 15px;
        color: #1155CC;
        font-weight: 600;
        text-transform: uppercase;
        text-decoration: underline;
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
    /*.seat-structure-main-div {*/
        /*width: 80%;*/
        /*margin-left: 10%;*/
        /*margin-right: 10%;*/
        /*padding: 1%;*/
        /*border: 1px solid #ddd;*/
        /*margin-top: 20px;*/
    /*}*/
</style>
<div class="">
    <div class="content">
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
        @php
            $seatDirection = $data['seatDir'];
            $alphaDirection = $data['alphaDir'];
            $noOfRows = $data['numRows'];
            $noOfColumns = $data['numCols'];
            $alphas = range('A', 'Z');
            $alpCount = $noOfRows-1;
        @endphp
        @if ($seatDirection == 'left to right')
            <div class="table-responsive seat-structure-main-div" id="place">
                <table class="table">
                    <tbody>
                    @for ($i = 1; $i <= $noOfRows; $i++)
                        <tr>
                            <td>
                                <input readonly value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}" type="text" name="alphabets[]" class="alphabets">
                            </td>
                            @php $titleNum1 = 0; @endphp
                            @for ($j = 1; $j <= $noOfColumns; $j++)
                                <td id="" class="seat" onclick="seatNum('{{$i.'-'.$j}}','{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}');" data-seatnum="{{$i.'-'.$j}}"></td>
                                @if ($j == $noOfColumns)
                                    <td>
                                        <input readonly style="float: right;" value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}" type="text" class="alphabets">
                                    </td>
                                @endif
                            @endfor
                        </tr>
                        @php $alpCount --; @endphp
                    @endfor
                    </tbody>
                </table>
                <img src="{{asset('screen/screen-image/screen.png')}}" class="img img-responsive screenImg">
            </div>
        @else
            <div class="table-responsive" id="place">
                <table class="table">
                    <tbody>
                    {{--@for ($i = 1; $i <= $noOfRows; $i++)--}}
                    {{--@php $temp = 0; @endphp--}}
                    {{--@for ($j = $noOfColumns; $j >= 1; $j--)--}}
                    {{--@if (!in_array(($i.'-'.$j), $inActiveSeatArray))--}}
                    {{--@php $temp += 1; @endphp--}}
                    {{--@endif--}}
                    {{--@endfor--}}
                    {{--@php $activeSeatCount[$i] = $temp; @endphp--}}
                    {{--@endfor--}}

                    @for ($i = 1; $i <= $noOfRows; $i++)
                        <tr>
                            <td>
                                <input readonly value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}" style="" oninput="" type="text" class="alphabets">
                            </td>

                            @for ($j = $noOfColumns; $j >= 1; $j--)
                                <td class="seat" data-seatnum="{{$i.'-'.$j}}" onclick="seatNum('{{$i.'-'.$j}}', '{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}');"  style=""></td>
                                @if ($j == 1)
                                    <td>
                                        <input readonly value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}" style="float: right;" type="text" class="alphabets">
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
        <span class="span-info">Click on the seats to select path.</span>
        <form action="{{url('admin/seat-management/screens/'.$screen->slug.'/seat/submit')}}" method="post" id="seatStructureForm">
            {{csrf_field()}}
            <input type="hidden" name="numOfRows" value="{{$noOfRows}}">
            <input type="hidden" name="numOfColumns" value="{{$noOfColumns}}">
            <input type="hidden" name="seatDirection" value="{{$seatDirection}}">
            <input type="hidden" name="alphabetDirection" value="{{$alphaDirection}}">
            <input type="submit" value="Submit" class="btn btn-lg btn-success ajaxSubmitButton">
        </form>
    </div>
</div>