<style>
    .help-block {
        display: block !important;
        color: red !important;
        font-size: 15px !important;
        font-weight: 500 !important;
    }

    #place {
        margin: 0 auto;
    }

    div.content {
        border: 1px solid #ddd;
        /*margin: 0 10%;*/
        padding: 1%;
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

    .span-info {
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
                                <input readonly
                                       value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                       type="text" name="alphabets[]" class="alphabets">
                            </td>
                            @php $titleNum1 = 0; @endphp
                            @for ($j = 1; $j <= $noOfColumns; $j++)
                                <td id="" class="seat"
                                    onclick="seatNum('{{$i.'-'.$j}}','{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}');"
                                    data-seatnum="{{$i.'-'.$j}}"></td>
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
                                <input readonly
                                       value="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}"
                                       style="" oninput="" type="text" class="alphabets">
                            </td>

                            @for ($j = $noOfColumns; $j >= 1; $j--)
                                <td class="seat" data-seatnum="{{$i.'-'.$j}}"
                                    onclick="seatNum('{{$i.'-'.$j}}', '{{$alphaDirection == 'top to bottom' ? $alphas[$i-1] : $alphas[$alpCount]}}');"
                                    style=""></td>
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
        <span class="span-info">Click on the seats to select path.</span>
        <form action="{{url('admin/seat-management/screens/'.$screen->slug.'/seat/submit')}}" method="post"
              id="seatStructureForm">
            {{csrf_field()}}
            <input type="hidden" name="numOfRows" value="{{$noOfRows}}">
            <input type="hidden" name="numOfColumns" value="{{$noOfColumns}}">
            <input type="hidden" name="seatDirection" value="{{$seatDirection}}">
            <input type="hidden" name="alphabetDirection" value="{{$alphaDirection}}">
            <div class="form-group">
                <select onfocus="rErr('seat-categories');" name="seat_categories" id="seat-categories" class="custom-select" style="width: 40%; margin-top: 10px;">
                    <option value="">-- Select Number Of Seat Categories --</option>
                    @for($i = 1; $i <= 10; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <span class="seat-categories-error help-block"></span>
            </div>

            <div class="category-div"></div>
            <button type="submit" class="btn btn-primary ajaxSubmitButton">Submit</button>
        </form>
    </div>
</div>

<script>
    $(document).find('#seatStructureForm').on('submit', function(e){
        var emp = 0;
        var chk = 0;
        if($(document).find('select#seat-categories').val() == '')
        {
            e.preventDefault();
            $(document).find('.seat-categories-error').html('<strong>Please choose a value !</strong>');
        }

        $(document).find('input.category-name').each(function () {
            if($(this).val() == '')
            {
                emp = 1;
            }
        });


        $(document).find('select.category-from-row').each(function () {
            if($(this).val() == '')
            {
                emp = 1;
            }
        });


        $(document).find('select.category-to-row').each(function () {
            if($(this).val() == '')
            {
                emp = 1;
            }
        });

        if(emp == 1)
        {
            e.preventDefault();
            $(document).find('.category-name-error').html('<strong>Please fill all required values !</strong>');
        }

        if(emp == 0)
        {
            var count = $(document).find('select#seat-categories').val();

            for(var a = 0; a < count; a++)
            {
                var firstCategoryNameVal = $(document).find('input.category-name-'+a).val();

                for(var b = (a+1); b < count; b++)
                {
                    var otherCategoryNameVal = $(document).find('input.category-name-'+b).val();

                    if(firstCategoryNameVal == otherCategoryNameVal)
                    {
                        chk = 1;
                    }
                }
            }

            if(chk == 1)
            {
                e.preventDefault();
                $(document).find('.category-name-error').html('<strong>Errorous Values Found !</strong>');
            }

            if(chk == 0)
            {
                var num = 0;
                var numOfCategs = $(document).find('input.category-name').length;

                var rowArray = [];
                for(var j = 0; j < numOfCategs; j++)
                {
                    var fromRowNum = $(document).find('select.category-from-row-'+j+' option:selected').data('val');
                    var toRowNum = $(document).find('select.category-to-row-'+j+' option:selected').data('val');

                    if(fromRowNum > toRowNum)
                    {
                        for(var k = toRowNum; k <= fromRowNum; k++)
                        {
                            rowArray.push(k);
                        }
                    }else{
                        for(var k = fromRowNum; k <= toRowNum; k++)
                        {
                            rowArray.push(k);
                        }
                    }
                }
                var result = [];
                $.each(rowArray, function(i, e) {
                    if ($.inArray(e, result) == -1) result.push(e);
                });
                var rowLength = $(document).find('select.category-from-row-0').children('option').length;
                if((rowLength-1) != result.length)
                {
                    e.preventDefault();
                    $(document).find('.category-name-error').html('<strong>Error ! You cannot leave any row without any category !</strong>');
                }
            }
        }
    });

    $(document).find('select#seat-categories').on('change', function(){
        var val = $(this).val();
        if(val != '')
        {
            var alphabets = [];
            $(document).find('input.alphabets').each(function () {
                alphabets.push($(this).val());
            });

            alphabets = jQuery.unique( alphabets );
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
            for(var i = 0; i < val; i++)
            {
                html += '<tr>';
                html += '<td>';
                html += '<input type="text" class="form-control category-name category-name-'+i+'" data-id="'+i+'" name="category_name[]" placeholder="Enter Category Name">';
                html += '</td>';
                html += '<td>';
                html += '<select name="category_from_row[]" data-id="'+i+'" class="custom-select category-from-row category-from-row-'+i+'">';
                html += '<option value="">-- Select From Row --</option>';
                for(var k = 0; k < alphabets.length; k++)
                {
                    html += '<option class="option'+k+'" data-val="'+k+'" value="'+alphabets[k]+'">'+alphabets[k]+'</option>';
                }
                html += '</select>';
                html += '</td>';
                html += '<td>';
                html += '<select name="category_to_row[]" data-id="'+i+'" class="custom-select category-to-row category-to-row-'+i+'">';
                html += '<option value="">-- Select To Row --</option>';
                for(var k = 0; k < alphabets.length; k++)
                {
                    html += '<option class="option'+k+'" data-val="'+k+'" value="'+alphabets[k]+'">'+alphabets[k]+'</option>';
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
        }else{
            $(document).find('div.category-div').html('');
        }
    });

    function rErr(text) {
        $('.'+text+'-error').html('');
    }
</script>