@extends('admin.layout.master1')

@section('styles')
    <style>
        .small-text {
            font-size: 15px;
        }

        ul.pagination li {
            padding: .5rem .75rem;
            background: #fff;
            border: 1px solid #ddd;
            cursor: pointer;
        }

        ul.pagination li.active {
            background-color: #da1113;
            border-color: #da1113;
            color: #fff !important;
            cursor: not-allowed;
        }

        ul.pagination li.disabled {
            cursor: not-allowed;
        }

        #load-modal {
            display: none;
            position: absolute;
            top: 50%;
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
        <!-- BEGIN .main-heading -->
        <header class="main-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="page-icon">
                            <i class="icon-laptop_windows"></i>
                        </div>
                        <div class="page-title">
                            <h5>Mero Theatre</h5>
                            <h6 class="sub-heading">Welcome to your Dashboard</h6>
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
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="reports-tab" data-toggle="tab" href="#reports"
                                       role="tab" aria-controls="reports" aria-selected="true" aria-expanded="true">Statistics</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab"
                                       aria-controls="sales" aria-selected="false" aria-expanded="false">Sales</a>
                                </li>
                            </ul>
                        </div>
                        <div id="select-screen">
                            <div class="form-group">
                                <select id="screen-select" class=" custom-select">
                                    @if(isset($screens) && $screens->count() > 0)
                                        @foreach($screens as $screen)
                                            <option value="{{$screen->id}}"
                                                    {{isset($_GET['screen']) && $_GET['screen'] == $screen->id ? 'selected' : ''}} data-screenid="{{$screen->id}}">{{$screen->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="toggle-switch tr-xl">
                            <input class="check" type="checkbox">
                            <b class="b switch"></b>
                            <b class="b track"></b>
                        </div>
                        <div class="card-body">
                            <div class="tab-content plain" id="myTabContent">
                                <div class="tab-pane fade active show" id="reports" role="tabpanel"
                                     aria-labelledby="reports-tab" aria-expanded="true">
                                    <!-- Row start -->
                                    <div class="row gutters">
                                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                                            <h6 class="card-title mt-0">Visitors</h6>
                                            <div class="chartist custom-one">
                                                <div class="line-chart"></div>
                                            </div>
                                            <div class="download-details">
                                                @if($visitorStatus == 'increased')
                                                    <p>{{$increasedRateOfVisitors}} more visitors than last month</p>
                                                @elseif($visitorStatus == 'decreased')
                                                    <p>{{$increasedRateOfVisitors}} less visitors than last month</p>
                                                @else
                                                    <p>No increase in visitors than last month</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                            <div class="monthly-avg">
                                                <h6>Monthly Average</h6>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-secondary">{{$totalVisitors}}
                                                        <small class="small-text">(NPR. {{$totalSoldAndReservedPrice}}
                                                            )
                                                        </small>
                                                    </h4>
                                                    <h6 class="avg-label">
                                                        Visitors
                                                    </h6>
                                                </div>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-primary">{{$totalVisitorsSell}}
                                                        <small class="small-text">(NPR. {{$totalSoldPrice}})</small>
                                                    </h4>
                                                    <h6 class="avg-label">
                                                        Sales
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                                            <h6 class="card-title mt-0">Orders</h6>
                                            <div class="chartist custom-two">
                                                <div class="line-chart2"></div>
                                            </div>
                                            <div class="download-details">
                                                @if($orderStatus == 'increased')
                                                    <p>{{$increasedRateOfOrders}} more sales than last month</p>
                                                @elseif($orderStatus == 'decreased')
                                                    <p>{{$increasedRateOfOrders}} less sales than last month</p>
                                                @else
                                                    <p>No increase in sales than last month</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->
                                </div>
                                <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab"
                                     aria-expanded="false">
                                    <!-- Row starts -->
                                    <div class="row align-items-center gutters">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <div class="monthly-avg plain">
                                                <h6>Daily</h6>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-secondary">NPR. {{$dailySale}}</h4>
                                                    <h6 class="avg-label">
                                                        Direct
                                                    </h6>
                                                </div>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-primary">$7,160<sup>k</sup></h4>
                                                    <h6 class="avg-label">
                                                        Online
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <div class="monthly-avg plain">
                                                <h6>Weekly</h6>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-secondary">NPR. {{$weeklySale}}</h4>
                                                    <h6 class="avg-label">
                                                        Direct
                                                    </h6>
                                                </div>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-primary">$470<sup>k</sup></h4>
                                                    <h6 class="avg-label">
                                                        Online
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <div class="monthly-avg plain">
                                                <h6>Monthly</h6>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-secondary">NPR. {{$monthlySale}}</h4>
                                                    <h6 class="avg-label">
                                                        Direct
                                                    </h6>
                                                </div>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-primary">$7,160<sup>k</sup></h4>
                                                    <h6 class="avg-label">
                                                        Online
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <div class="slimScrollDiv"
                                                 style="position: relative; overflow: hidden; width: auto; height: 245px;">
                                                <div class="customScroll3"
                                                     style="overflow: hidden; width: auto; height: 245px;">
                                                    <div class="card m-0">
                                                        <div class="card-body">
                                                            <ul class="stocks">
                                                                <li>
                                                                    <p class="clearfix">Counter
                                                                        @if($monthlySaleStatus == 'increased')
                                                                            <span><i class="icon-arrow-up-right2 text-success"></i>
																			NPR. {{$monthlySale}}
                                                                                <small class="text-success">+{{$increasedMonthlySale}}</small></span>
                                                                        @elseif($monthlySaleStatus == 'decreased')
                                                                            <span><i class="icon-arrow-down-right2 text-danger"></i>
																			NPR. {{$monthlySale}}
                                                                                <small class="text-danger">-{{$increasedMonthlySale}}</small></span>
                                                                        @else
                                                                            <span>NPR. {{$monthlySale}}
                                                                                <small class="text-danger">-</small></span>
                                                                        @endif
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Google Inc<span><i
                                                                                    class="icon-arrow-up-right2 text-success"></i>8219<small
                                                                                    class="text-success">-4.031</small></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Yahoo Inc<span><i
                                                                                    class="icon-arrow-down-right2 text-danger"></i>3188<small
                                                                                    class="text-danger">+7.652</small></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Facebook Inc<span><i
                                                                                    class="icon-arrow-up-right2 text-success"></i>46545<small
                                                                                    class="text-success">+11.82</small></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Ebay Inc<span><i
                                                                                    class="icon-arrow-down-right2 text-danger"></i>662<small
                                                                                    class="text-danger">-5.281</small></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Amazon Inc<span><i
                                                                                    class="icon-arrow-up-right2 text-success"></i>27873<small
                                                                                    class="text-success">+7.318</small></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Microsoft<span><i
                                                                                    class="icon-arrow-up-right2 text-success"></i>3964<small
                                                                                    class="text-success">-3.091</small></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Federal Bank<span><i
                                                                                    class="icon-arrow-up-right2 text-success"></i>10760<small
                                                                                    class="text-success">+4.585</small></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Nicco Corp<span><i
                                                                                    class="icon-arrow-down-right2 text-danger"></i>260<small
                                                                                    class="text-danger">-6.955</small></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Uflex<span><i
                                                                                    class="icon-arrow-up-right2 text-success"></i>37095<small
                                                                                    class="text-success">+5.079</small></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Trivago NV<span><i
                                                                                    class="icon-arrow-up-right2 text-success"></i>1851<small
                                                                                    class="text-success">+9.555</small></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Cobham PLC<span><i
                                                                                    class="icon-arrow-down-right2 text-danger"></i>364<small
                                                                                    class="text-danger">-8.432</small></span>
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slimScrollBar"
                                                     style="background: rgb(229, 232, 242) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.8; display: block; border-radius: 0px; z-index: 99; right: 1px;"></div>
                                                <div class="slimScrollRail"
                                                     style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(0, 122, 225) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Row ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters screen-sec">
                @if(isset($screens) && $screens->count() > 0)
                    @foreach($screens as $screen)
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                            <div class="info-stats4">
                                <div class="icon-type pull-left">
                                    <i class="icon-wallet"></i>
                                </div>
                                <div class="sale-num">
                                    <h4>{{\App\BookingModel\CounterSell::where('screen_id', $screen->id)->whereDate('show_date', date('Y-m-d'))->count() + \App\BookingModel\CounetrReservation::where('screen_id', $screen->id)->whereDate('show_date', date('Y-m-d'))->count()}} <span>({{$screen->name}})</span></h4>
                                    <p>Number of Transaction</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                            <div class="info-stats4">
                                <div class="icon-type pull-left">
                                    <i class="icon-pricetags"></i>
                                </div>
                                <div class="sale-num">
                                    <h4>{{\App\BookingModel\CounterSell::where('screen_id', $screen->id)->whereDate('show_date', date('Y-m-d'))->count()}} <span>({{$screen->name}})</span></h4>
                                    <p>Total Sold</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters pie-sec">

                <div class="col-lg-4 col-md-4 col-sm-6 one-fifth">
                    <div class="card">
                        <div class="card-header">Counter Booking</div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="counter-pie-chart">

                                </div>
                            </div>
                            <div class="row gutters pie-info">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-ttl"></span>
                                        <p class="info-title">Total </p>
                                        <h4 class="info-total">{{$totalValueForCounterPieChart + $sellValueForCounterPieChart + $reservationValueForCounterPieChart}}</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats info-sld">
                                        <span class="info-label"></span>
                                        <p class="info-title">Sold </p>
                                        <h4 class="info-total">{{$sellValueForCounterPieChart}}</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-rsv"></span>
                                        <p class="info-title">Reservation </p>
                                        <h4 class="info-total">{{$reservationValueForCounterPieChart}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-4 col-sm-6 one-fifth">
                    <div class="card">
                        <div class="card-header">Online Booking</div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="pie-chart">
                                    <div class="chartist-tooltip"></div>
                                    <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                         height="180px" class="ct-chart-pie" style="width: 100%; height: 180px;">
                                        <g class="ct-series ct-series-a">
                                            <path d="M229.77,132.5A85,85,0,0,0,156.158,5L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                        <g class="ct-series ct-series-b">
                                            <path d="M82.546,132.5A85,85,0,0,0,229.918,132.243L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                        <g class="ct-series ct-series-c">
                                            <path d="M156.158,5A85,85,0,0,0,82.695,132.757L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="row gutters pie-info">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-ttl"></span>
                                        <p class="info-title">Total </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats info-sld">
                                        <span class="info-label"></span>
                                        <p class="info-title">Sold </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-rsv"></span>
                                        <p class="info-title">Reservation </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 one-fifth">
                    <div class="card">
                        <div class="card-header">Phone Booking</div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="pie-chart2">
                                    <div class="chartist-tooltip"></div>
                                    <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                         height="180px" class="ct-chart-pie" style="width: 100%; height: 180px;">
                                        <g class="ct-series ct-series-a">
                                            <path d="M229.77,132.5A85,85,0,0,0,156.158,5L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                        <g class="ct-series ct-series-b">
                                            <path d="M82.546,132.5A85,85,0,0,0,229.918,132.243L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                        <g class="ct-series ct-series-c">
                                            <path d="M156.158,5A85,85,0,0,0,82.695,132.757L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="row gutters pie-info">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-ttl"></span>
                                        <p class="info-title">Total </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats info-sld">
                                        <span class="info-label"></span>
                                        <p class="info-title">Sold </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-rsv"></span>
                                        <p class="info-title">Reservation </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 one-fifth">
                    <div class="card">
                        <div class="card-header">Android Apps Booking</div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="pie-chart3">
                                    <div class="chartist-tooltip"></div>
                                    <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                         height="180px" class="ct-chart-pie" style="width: 100%; height: 180px;">
                                        <g class="ct-series ct-series-a">
                                            <path d="M229.77,132.5A85,85,0,0,0,156.158,5L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                        <g class="ct-series ct-series-b">
                                            <path d="M82.546,132.5A85,85,0,0,0,229.918,132.243L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                        <g class="ct-series ct-series-c">
                                            <path d="M156.158,5A85,85,0,0,0,82.695,132.757L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="row gutters pie-info">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-ttl"></span>
                                        <p class="info-title">Total </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats info-sld">
                                        <span class="info-label"></span>
                                        <p class="info-title">Sold </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-rsv"></span>
                                        <p class="info-title">Reservation </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 one-fifth">
                    <div class="card">
                        <div class="card-header">iPhone Apps Booking</div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="pie-chart4">
                                    <div class="chartist-tooltip"></div>
                                    <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                         height="180px" class="ct-chart-pie" style="width: 100%; height: 180px;">
                                        <g class="ct-series ct-series-a">
                                            <path d="M229.77,132.5A85,85,0,0,0,156.158,5L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                        <g class="ct-series ct-series-b">
                                            <path d="M82.546,132.5A85,85,0,0,0,229.918,132.243L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                        <g class="ct-series ct-series-c">
                                            <path d="M156.158,5A85,85,0,0,0,82.695,132.757L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="row gutters pie-info">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-ttl"></span>
                                        <p class="info-title">Total </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats info-sld">
                                        <span class="info-label"></span>
                                        <p class="info-title">Sold </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-rsv"></span>
                                        <p class="info-title">Reservation </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 one-fifth">
                    <div class="card">
                        <div class="card-header">Third Party API sold</div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="pie-chart5">
                                    <div class="chartist-tooltip"></div>
                                    <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%"
                                         height="180px" class="ct-chart-pie" style="width: 100%; height: 180px;">
                                        <g class="ct-series ct-series-a">
                                            <path d="M229.77,132.5A85,85,0,0,0,156.158,5L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                        <g class="ct-series ct-series-b">
                                            <path d="M82.546,132.5A85,85,0,0,0,229.918,132.243L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                        <g class="ct-series ct-series-c">
                                            <path d="M156.158,5A85,85,0,0,0,82.695,132.757L156.158,90Z"
                                                  class="ct-slice-pie" ct:value="328"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="row gutters pie-info">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-ttl"></span>
                                        <p class="info-title">Total </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats info-sld">
                                        <span class="info-label"></span>
                                        <p class="info-title">Sold </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col">
                                    <div class="info-stats">
                                        <span class="info-label info-rsv"></span>
                                        <p class="info-title">Reservation </p>
                                        <h4 class="info-total">985</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">Seat Purchase Report by Screen & Class Level Wise</div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover m-0" id="" style="width:100%">
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
                                @if(isset($todayScheduledMovies) && $todayScheduledMovies->count() > 0)
                                    @foreach($todayScheduledMovies as $todayScheduledMovie)
                                        @foreach($schedules as $schedule)
                                            @if($todayScheduledMovie == $schedule->movie_id)
                                                <tr>
                                                    <th scope="row">{{\App\MovieModel::find($todayScheduledMovie)->movie_title}}</th>
                                                    <td>
                                                        <a href="{{url('admin/sales-management/sold-reports/view-seat?screen='.$activeScreen->id.'&date='.$schedule->show_date.'&time='.$schedule->show_time_start.'&movie='.$todayScheduledMovie.'&schedule='.$schedule->id)}}">View
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

            <!-- Row start -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card m-0">
                        <div class="card-body scroll-to-here">
                            <div class="table-responsive">
                                <div id="load-fade"></div>
                                <div id="load-modal">
                                    <img id="loader" src="{{asset('admins/loader/loading.gif')}}"/>
                                </div>
                                <table class="table table-hover m-0" id="transaction-log-table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        {{--<th>Customer Pan</th>--}}
                                        <th>Invoice Number</th>
                                        <th>Payment Mode</th>
                                        <th>Screen</th>
                                        <th>Category</th>
                                        <th>Seat</th>
                                        <th>Price</th>
                                        <th>Movie</th>
                                        <th>Show Date</th>
                                        <th>Show Time</th>
                                        <th>Show Day</th>
                                        <th>Sold At</th>
                                    </tr>
                                    </thead>
                                    <tbody class="transaction-log-tbody">
                                    @if(isset($transactionData) && $transactionData->count() > 0)
                                        @foreach($transactionData as $transactionDatum)
                                            <tr>
                                                <td>{{\App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->customer_name != null ? \App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->customer_name : 'N/A'}}</td>
                                                {{--<td>{{$transactionDatum->customer_pan_num != null ? $transactionDatum->customer_pan_num : 'N/A'}}</td>--}}
                                                <td>{{$transactionDatum->invoice_number}}</td>
                                                <td>{{\App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->payment_mode != null ? \App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->payment_mode : 'N/A'}}</td>
                                                <td>{{\App\Screen\Screen::find($transactionDatum->screen_id)->name}}</td>
                                                <td>{{$transactionDatum->seat_category}}</td>
                                                <td>{{$transactionDatum->seat_name}}</td>
                                                <td>{{$transactionDatum->seat_price}}</td>
                                                <td>{{\App\MovieModel::find($transactionDatum->movie_id)->movie_title}}</td>
                                                <td>{{$transactionDatum->show_date}}</td>
                                                <td>{{$transactionDatum->show_time}}</td>
                                                <td>{{$transactionDatum->show_day}}</td>
                                                <td>{{date('d M, Y', strtotime($transactionDatum->created_at))}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="10">{{$transactionData->appends(\Illuminate\Support\Facades\Input::except('page'))}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="10">No Reports Found !
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
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
    <script !src="">
        function openModal() {
            document.getElementById('load-modal').style.display = 'block';
            document.getElementById('load-fade').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('load-modal').style.display = 'none';
            document.getElementById('load-fade').style.display = 'none';
        }



        var chart = new Chartist.Line('.line-chart', {
            labels: [1, 2, 3, 4, 5],
            series: [
                [
                    {meta: 'Visitors', value: "{{$totalVisitorsLastMonth}}"},
                    {meta: 'Visitors', value: "{{$totalVisitors}}"},
                ]
            ]
        }, {
            // Remove this configuration to see that chart rendered with cardinal spline interpolation
            // Sometimes, on large jumps in data values, it's better to use simple smoothing.
            lineSmooth: Chartist.Interpolation.simple({
                divisor: 2
            }),
            height: "190px",
            fullWidth: true,
            chartPadding: {
                right: 20,
                left: 10,
                top: 10,
                bottom: 0,
            },
            axisX: {
                offset: 0,
                showGrid: false,
                showLabel: false,
            },
            axisY: {
                offset: 0,
                showLabel: false,
            },
            plugins: [
                Chartist.plugins.tooltip()
            ],
            low: 0,
        });

        chart.on('draw', function (data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 2000 * data.index,
                        dur: 2000,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            }
        });


        var chart2 = new Chartist.Line('.line-chart2', {
            labels: [1, 2, 3, 4, 5],
            series: [
                [
                    {meta: 'Orders', value: "{{$totalVisitorsSellLastMonth}}"},
                    {meta: 'Orders', value: "{{$totalVisitorsSell}}"},
                ]
            ]
        }, {
            // Remove this configuration to see that chart rendered with cardinal spline interpolation
            // Sometimes, on large jumps in data values, it's better to use simple smoothing.
            lineSmooth: Chartist.Interpolation.simple({
                divisor: 2
            }),
            height: "190px",
            fullWidth: true,
            chartPadding: {
                right: 20,
                left: 10,
                top: 10,
                bottom: 0,
            },
            axisX: {
                offset: 0,
                showGrid: false,
                showLabel: false,
            },
            axisY: {
                offset: 0,
                showLabel: false,
            },
            plugins: [
                Chartist.plugins.tooltip()
            ],
            low: 0,
        });

        chart2.on('draw', function (data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 2000 * data.index,
                        dur: 2000,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            }
        });

        $(document).on('change', '#screen-select', function () {
            var url = baseurl + '/admin/dashboard?screen=' + $(this).children('option:selected').data('screenid');
            window.location = url;
        });

        new Chartist.Pie('.counter-pie-chart', {
            series: ["{{$totalValueForCounterPieChart}}", "{{$sellValueForCounterPieChart}}", "{{$reservationValueForCounterPieChart}}"],
        }, {
            pie: true,
            showLabel: false,
            height: "180px",
            plugins: [
                Chartist.plugins.tooltip()
            ],
            low: 0
        });

        $(document).on('click', 'ul.pagination li', function(e){
           e.preventDefault();
           if(!$(this).hasClass('active') && !$(this).hasClass('disabled'))
           {
               openModal();
               var url = $(this).children('a').attr('href');
               $.ajax({
                  url: url,
                   type: 'get',
                   success:function(data)
                   {
                       $(document).find('.transaction-log-tbody').html(data);
                       $('html, body').animate({
                           scrollTop: $(".scroll-to-here").offset().top - 80
                       }, 100);
                       closeModal();
                   }, error:function(data)
                   {
                       closeModal();
                       alertify.alert('Oops ! something went wrong. Data could not be loaded.');
                   }
               });
           }
        });
    </script>
@stop

