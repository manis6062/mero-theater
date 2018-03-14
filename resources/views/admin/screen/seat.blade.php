@extends('admin.layout.master')

@section('styles')
    <style>
        .seatDiv {
            width: 80%;
            margin: 0 10%;
            border: 1px solid #ddd;
            padding: 5%;
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
    </style>

@section('main-body')
    <section class="content">
        <div style="margin-top: 5%;">
            <div class="seatDiv">
                @if(\Illuminate\Support\Facades\Session::has('status') && \Illuminate\Support\Facades\Session::get('status') == 'success')
                    <div class="alert alert-success">
                        <i class="fa fa-times pull-right closeMessage"></i>
                        <p class="text-center">Seat structure successfully created !</p>
                    </div>
                @endif
                @if(\Illuminate\Support\Facades\Session::has('status') && \Illuminate\Support\Facades\Session::get('status') == 'unsuccess')
                    <div class="alert alert-danger">
                        <i class="fa fa-times pull-right closeMessage"></i>
                        <p class="text-center">Oops ! something went wrong. Please try again !</p>
                    </div>
                @endif



                    @if(\Illuminate\Support\Facades\Session::has('status') && \Illuminate\Support\Facades\Session::get('status') == 'success-update')
                        <div class="alert alert-success">
                            <i class="fa fa-times pull-right closeMessage"></i>
                            <p class="text-center">Seat structure successfully updated !</p>
                        </div>
                    @endif
                    @if(\Illuminate\Support\Facades\Session::has('status') && \Illuminate\Support\Facades\Session::get('status') == 'unsuccess-update')
                        <div class="alert alert-danger">
                            <i class="fa fa-times pull-right closeMessage"></i>
                            <p class="text-center">Oops ! something went wrong. Please try again !</p>
                        </div>
                    @endif

                @if(isset($seatData) && $seatData->count() > 0)
                    <a href="{{url('admin/seat-management/screens/'.$screen->slug.'/seat/edit')}}" style="font-size: 15px; font-weight: 600;"><i class="fa fa-edit"></i> Edit</a>
                    <p style="font-size: 15px; font-weight: 600; color: #00acd6;">Seat Structure
                        Of {{$screen->name}}</p>
                    @php
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
                                                       type="text" name="alphabets[]" class="alphabets">
                                            </td>

                                            @for ($j = 1; $j <= $noOfColumns; $j++)
                                                @php $titleCount += 1; @endphp
                                                <td id="" class="seat"
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
                                                       style="" oninput="" type="text" class="alphabets">
                                            </td>

                                            @for ($j = $noOfColumns; $j >= 1; $j--)
                                                <td class="seat"
                                                    title="{{$alphaDirection == 'top to bottom' ? $alphas[$i-1].$titleCount : $alphas[$alpCount].$titleCount}}"></td>
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
                                                       type="text" name="alphabets[]" class="alphabets">
                                            </td>
                                            @for ($j = 1; $j <= $noOfColumns; $j++)
                                                @if(!in_array($i.'-'.$j, $pathArr))
                                                    @php $titleCount += 1; @endphp
                                                @endif
                                                <td id=""
                                                    class="{{!in_array($i.'-'.$j, $pathArr) ? 'seat' : 'inactiveSeat'}}"
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
                                                       style="" oninput="" type="text" class="alphabets">
                                            </td>

                                            @for ($j = $noOfColumns; $j >= 1; $j--)
                                                <td class="{{!in_array($i.'-'.$j, $pathArr) ? 'seat' : 'inactiveSeat'}}"
                                                    title="{{!in_array($i.'-'.$j, $pathArr) ? $alphaDirection == 'top to bottom' ? $alphas[$i-1].$titleCount : $alphas[$alpCount].$titleCount : ''}}"></td>
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
                        <div class="category-div"></div>
                @else
                    <div class="seat-structure">
                        <span style="display: block;">No any seat structure defined for {{$screen->name}}</span>
                        <a href="{{url('admin/seat-management/screens/'.$screen->slug.'/seat/create')}}">
                            <button class="btn btn-primary">Create Now</button>
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </section>
@stop

@section('scripts')
    <script>
        $(document).find('.closeMessage').on('click', function () {
            $(this).parent('div').remove();
        });

        $(window).on('load', function(){
                    @if(isset($seatData->num_of_seat_categories))
            var val = "{{$seatData->num_of_seat_categories}}";
            var html = "";
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
                        @foreach($seatCategories as $dat)
                var fr = "{{$dat->category_from_row}}";
                var tr = "{{$dat->category_to_row}}";
                html += '<tr>';
                html += '<td>';
                html += '<input value="{{$dat->category_name}}" type="text" class="form-control category-name" name="category_name[]" placeholder="Enter Category Name">';
                html += '</td>';
                html += '<td>';
                html += '<select name="category_from_row[]" class="form-control category-from-row">';
                html += '<option value="">-- Select From Row --</option>';
                for(var k = 0; k < alphabets.length; k++)
                {
                    if(alphabets[k] == fr)
                    {
                        var attr = 'selected';
                    }else{
                        var attr = '';
                    }
                    html += '<option value="'+alphabets[k]+'" '+attr+'>'+alphabets[k]+'</option>';
                }
                html += '</select>';
                html += '</td>';
                html += '<td>';
                html += '<select name="category_to_row[]" class="form-control category-to-row">';
                html += '<option value="">-- Select To Row --</option>';
                for(var k = 0; k < alphabets.length; k++)
                {
                    if(alphabets[k] == tr)
                    {
                        var attr = 'selected';
                    }else{
                        var attr = '';
                    }
                    html += '<option value="'+alphabets[k]+'" '+attr+'>'+alphabets[k]+'</option>';
                }
                html += '</select>';
                html += '</td>';
                html += '</tr>';
                @endforeach
                html += '</tbody>';
                html += '</table>';
                $(document).find('div.category-div').html(html);
            }
            $(document).find('input').prop('disabled', true);
            $(document).find('select').prop('disabled', true);
            @endif
        });


    </script>
@stop