@extends('admin.layout.master1')

@section('styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <style>
        /*ul.pagination li {*/
            /*padding: .5rem .75rem;*/
            /*background: #fff;*/
            /*border: 1px solid #ddd;*/
        /*}*/

        /*ul.pagination li.active {*/
            /*background-color: #da1113;*/
            /*border-color: #da1113;*/
            /*color: #fff !important;*/
        /*}*/
    </style>
@stop

@section('main-body')
    <div class="app-main">
        <!-- BEGIN .main-heading -->
        <header class="main-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="page-icon">
                            <i class="icon-tabs-outline"></i>
                        </div>
                        <div class="page-title">
                            <h5>Sold Report</h5>
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
        <!-- END: .main-heading -->
        <!-- BEGIN .main-content -->
        <div class="main-content">
            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">Filter By Users</div>
                        <div class="card-body">
                            <div class="trasaction-wrap">
                                <div class="trasaction-btn">
                                    <a href="#"
                                       class="range-tab  {{!isset($_GET['range']) || (isset($_GET['range']) && $_GET['range'] == 'daily') ? 'active' : ''}}"
                                       data-date="{{date('Y-m-d')}}">Daily</a>

                                    @php
                                        $dt_min = new DateTime("last sunday");
                                        $dt_max = clone($dt_min);
                                        $dt_max->modify('+6 days');
                                    @endphp
                                    <a href="#"
                                       class="range-tab {{isset($_GET['range']) && $_GET['range'] == 'weekly' ? 'active' : ''}}"
                                       data-startdate="{{$dt_min->format('Y-m-d')}}"
                                       data-enddate="{{$dt_max->format('Y-m-d')}}">Weekly</a>

                                    @php
                                        $start = new \Carbon\Carbon('first day of this month');
                                        $end = new \Carbon\Carbon('last day of this month');
                                    @endphp
                                    <a href="#"
                                       class="range-tab {{isset($_GET['range']) && $_GET['range'] == 'monthly' ? 'active' : ''}}"
                                       data-startdate="{{$start->format('Y-m-d')}}"
                                       data-enddate="{{$end->format('Y-m-d')}}">Monthly</a>
                                </div>
                                <h5>Custom Date Range</h5>
                                <div class="transaction-date">
                                    <div class="input-group input-daterange">
                                        <div class="input-group-addon">From</div>
                                        <input class="form-control" id="custom-start-date"
                                               value="{{isset($_GET['range']) && $_GET['range'] == 'custom-date' ? $_GET['start-date'] : ''}}"
                                               type="text">
                                        <div class="input-group-addon">To</div>
                                        <input class="form-control" id="custom-to-date"
                                               value="{{isset($_GET['range']) && $_GET['range'] == 'custom-date' ? $_GET['end-date'] : ''}}"
                                               type="text">
                                        <div class="input-group-addon trasaction-sumbit-btn"><a href="#"
                                                                                                class="submit-custom-date">submit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">Sold Report Quaterly</div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="sold-chart">
                                    {{--<div class="chartist-tooltip"></div>--}}
                                    {{--<div class="ct-chart"></div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
            <!-- Row start -->
            <div class="row gutters">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="card block-300 block-336">
                        <div class="card-body">
                            <div class="transaction-map">
                                <img src="{{asset('admins/theme/img/map.png')}}" alt="map">
                            </div>
                            <div class="info-stats">
                                <span class="info-label red"></span>
                                <p class="info-title">Overall Sold</p>
                                <h4 class="info-total">{{$totalOverallSell}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col">
                    <a href="#" class="block-140 block-160">
                        <div class="icon primary">
                            <i class="icon-touch_app"></i>
                        </div>
                        <h5>2540</h5>
                        <p>Online Booking</p>
                    </a>
                    <a href="#" class="block-140 block-160">
                        <div class="icon primary">
                            <i class="icon-phone_android"></i>
                        </div>
                        <h5>763</h5>
                        <p>Phone Booking</p>
                    </a>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12 col">
                    <a href="#" class="block-140 block-160">
                        <div class="icon primary">
                            <i class="icon-apps"></i>
                        </div>
                        <h5>218</h5>
                        <p>Android Apps Booking</p>
                    </a>
                    <a href="#" class="block-140 block-160">
                        <div class="icon primary">
                            <i class="icon-location4"></i>
                        </div>
                        <h5>549</h5>
                        <p>Iphon Apps Booking</p>
                    </a>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                    <a href="#" class="block-140 block-160">
                        <div class="icon primary">
                            <i class="icon-users"></i>
                        </div>
                        <h5>367</h5>
                        <p>Third Party API</p>
                    </a>
                    <a href="#" class="block-140 block-160">
                        <div class="icon secondary">
                            <i class="icon-download5"></i>
                        </div>
                        <h5>{{$totalCounterSell}}</h5>
                        <p>Counter Sell</p>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="screen-profile block-336">
                        <div class="screen-img">
                            <img src="{{asset('admins/theme/img/screen.png')}}" class="profile-thumb" alt="User Thumb">
                        </div>
                        <h5 class="profile-name">MeroTheatre</h5>
                        <div class="screen-btn">
                            @if(isset($screens) && $screens->count() > 0)
                                @php $count = 0; @endphp
                                @foreach($screens as $screen)
                                    <a href="#"
                                       class="{{isset($activeScreen) && $activeScreen->id == $screen->id ? 'active' : ''}} screen-tabs"
                                       data-screenid="{{$screen->id}}">{{$screen->name}}</a>
                                    @php $count += 1; @endphp
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
            <!-- Row start -->


            <!-- Row start -->
            <div class="row gutters transaction-profile" id="tabular-data-section">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">Sold Report Screen Wise <a href="#" class="btn btn-primary export-to-excel">Export</a></div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover m-0" id="sold-report-table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Show</th>
                                    <th>Seat Plan</th>
                                    <th>Screen</th>
                                    <th>Show Date</th>
                                    @if(count($seatCategoryData) != 0)
                                        @foreach($seatCategoryData as $seatCategoryDatum)
                                            <th>{{$seatCategoryDatum['category_name']}}</th>
                                        @endforeach
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($soldReports) && $soldReports->count() > 0)
                                    @foreach($soldReports as $soldReport)
                                        @foreach($schedules as $schedule)
                                            @if($soldReport == $schedule->movie_id)
                                                <tr>
                                                    <th scope="row">{{\App\MovieModel::find($soldReport)->movie_title}}</th>
                                                    <td>
                                                        <a href="{{url('admin/sales-management/sold-reports/view-seat?screen='.$activeScreen->id.'&date='.$schedule->show_date.'&time='.$schedule->show_time_start.'&movie='.$soldReport.'&schedule='.$schedule->id)}}">View
                                                            Seat</a></td>
                                                    <td>{{$activeScreen->name}} ({{$schedule->show_time_start}})</td>
                                                    <td>{{$schedule->show_date}}</td>
                                                    @if(count($seatCategoryData) != 0)
                                                        @foreach($seatCategoryData as $seatCategoryDatum)
                                                            @if(!isset($_GET['range']) || (isset($_GET['range']) && $_GET['range'] == 'daily'))
                                                                <td>{{\App\BookingModel\CounterSell::where('screen_id', $activeScreen->id)->where('schedule_id', $schedule->id)->where('seat_category', $seatCategoryDatum['category_name'])->whereDate('show_date', date('Y-m-d'))->count()}}
                                                                    ( {{$seatCategoryDatum['category_total_seats']}} )
                                                                </td>
                                                            @else
                                                                <td>{{\App\BookingModel\CounterSell::where('screen_id', $activeScreen->id)->where('schedule_id', $schedule->id)->where('seat_category', $seatCategoryDatum['category_name'])->whereBetween('show_date', [$_GET['start-date'], $_GET['end-date']])->count()}}
                                                                    ( {{$seatCategoryDatum['category_total_seats']}} )
                                                                </td>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @else
                                    @if(!isset($_GET['range']) || (isset($_GET['range']) && $_GET['range'] == 'daily'))
                                        @php $show = 'today'; @endphp
                                    @elseif(isset($_GET['range']) && $_GET['range'] == 'weekly')
                                        @php $show = 'this week'; @endphp
                                    @elseif(isset($_GET['range']) && $_GET['range'] == 'monthly')
                                        @php $show = 'this month'; @endphp
                                    @elseif(isset($_GET['range']) && $_GET['range'] == 'custom-date')
                                        @php $show = 'from '.$_GET['start-date'].' to '.$_GET['end-date']; @endphp
                                    @endif
                                    <tr>
                                        <td colspan="5">No Reports Found
                                            For {{$activeScreen->name}} {{$show}} !
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
        <!-- END: .main-content -->
    </div>
@stop

@section('scripts')

    {{--script fot chart--}}
    <script>
        new Chartist.Bar('.sold-chart', {
            labels: ['Q1', 'Q2', 'Q3', 'Q4'],
            series: [
                [
                    {meta: 'Sold', value: "{{$chartData['q1']}}"},
                    {meta: 'Sold', value: "{{$chartData['q2']}}"},
                    {meta: 'Sold', value: "{{$chartData['q3']}}"},
                    {meta: 'Sold', value: "{{$chartData['q4']}}"}
                ],
            ],
        }, {
            seriesBarDistance: 11,
            reverseData: true,
            horizontalBars: true,
            height: "190px",
            chartPadding: {
                right: 0,
                left: 0,
                top: 0,
                bottom: -10,
            },
            axisY: {
                offset: 30
            },
            plugins: [
                Chartist.plugins.tooltip()
            ],
        });
    </script>
    {{--script fot chart--}}


    <script>
//        $('#reporitng-table').dataTable();
    </script>
    <script>
        $(document).on('click', '.screen-tabs', function (e) {
            e.preventDefault();
            if (!$(this).hasClass('active')) {
                var range = $('.range-tab.active').text();
                var screenId = $(this).data('screenid');
                if (range == 'Daily') {
                    var date = $('.range-tab.active').data('date');
                    window.location = baseurl + '/admin/sales-management/sold-reports?screen=' + screenId + '&range=daily&date=' + date;
                } else {
                    var startdate = $('.range-tab.active').data('startdate');
                    var enddate = $('.range-tab.active').data('enddate');
                    window.location = baseurl + '/admin/sales-management/sold-reports?screen=' + screenId + '&range=' + range.toLowerCase() + '&start-date=' + startdate + '&end-date=' + enddate;
                }
            }
        });

        $(document).on('click', '.range-tab', function (e) {
            e.preventDefault();
            if (!$(this).hasClass('active')) {
                var range = $(this).text();
                if (range == 'Daily') {
                    var date = $(this).data('date');
                    var screenId = $('.screen-tabs.active').data('screenid');
                    window.location = baseurl + '/admin/sales-management/sold-reports?screen=' + screenId + '&range=daily&date=' + date;
                } else {
                    var startdate = $(this).data('startdate');
                    var enddate = $(this).data('enddate');
                    var screenId = $('.screen-tabs.active').data('screenid');
                    window.location = baseurl + '/admin/sales-management/sold-reports?screen=' + screenId + '&range=' + range.toLowerCase() + '&start-date=' + startdate + '&end-date=' + enddate;
                }
            }
        });

        $(document).on('click', '.submit-custom-date', function (e) {
            e.preventDefault();
            var startDate = $('#custom-start-date').val();
            var endDate = $('#custom-to-date').val();
            if (startDate != '' && endDate != '') {
                if (endDate < startDate) {
                    alertify.alert('End Date Cannot Be Greater Than Start Date');
                } else if (endDate == startDate) {
                    var screenId = $('.screen-tabs.active').data('screenid');
                    window.location = baseurl + '/admin/sales-management/sold-reports?screen=' + screenId + '&range=custom-date&start-date=' + startDate + '&end-date=' + endDate;
                } else {
                    var screenId = $('.screen-tabs.active').data('screenid');
                    window.location = baseurl + '/admin/sales-management/sold-reports?screen=' + screenId + '&range=custom-date&start-date=' + startDate + '&end-date=' + endDate;
                }
            }
        });

        $('#custom-start-date').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('#custom-to-date').datepicker({
            format: 'yyyy-mm-dd'
        });

        $(document).on('click', '.export-to-excel', function(e){
           e.preventDefault();
           var url = window.location.href;
           if(url.indexOf('?') > -1)
           {
               url = url+'&action=export';
           }else{
               url = url+'?action=export';
           }

           window.location = url;
        });
    </script>
@stop