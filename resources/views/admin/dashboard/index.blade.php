@extends('admin.layout.master1')

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
                            <span class="last-login">Last Login: 2 hours ago</span>
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
                                    <a class="nav-link active" id="reports-tab" data-toggle="tab" href="#reports" role="tab" aria-controls="reports" aria-selected="true" aria-expanded="true">Statistics</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false" aria-expanded="false">Sales</a>
                                </li>
                            </ul>
                        </div>
                        <div id="select-screen">
                            <div class="form-group">
                                <select id="" class=" custom-select">
                                    <option>Screen 1</option>
                                    <option>Screen 2</option>
                                    <option>Screen 3</option>
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
                                <div class="tab-pane fade active show" id="reports" role="tabpanel" aria-labelledby="reports-tab" aria-expanded="true">
                                    <!-- Row start -->
                                    <div class="row gutters">
                                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                                            <h6 class="card-title mt-0">Visitors</h6>
                                            <div class="chartist custom-one">
                                                <div class="line-chart"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="190px" class="ct-chart-line" style="width: 100%; height: 190px;"><g class="ct-grids"><line y1="190" y2="190" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="164.28571428571428" y2="164.28571428571428" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="138.57142857142856" y2="138.57142857142856" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="112.85714285714286" y2="112.85714285714286" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="87.14285714285714" y2="87.14285714285714" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="61.428571428571416" y2="61.428571428571416" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="35.71428571428572" y2="35.71428571428572" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="10" y2="10" x1="10" x2="402.75" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><path d="M10,164.286C59.094,164.286,59.094,87.143,108.188,87.143C157.281,87.143,157.281,92.286,206.375,92.286C255.469,92.286,255.469,35.714,304.563,35.714C353.656,35.714,353.656,10,402.75,10" class="ct-line"></path><line x1="10" y1="164.28571428571428" x2="10.01" y2="164.28571428571428" class="ct-point" ct:value="500" ct:meta="Visitors"></line><line x1="108.1875" y1="87.14285714285714" x2="108.1975" y2="87.14285714285714" class="ct-point" ct:value="2000" ct:meta="Visitors"></line><line x1="206.375" y1="92.28571428571429" x2="206.385" y2="92.28571428571429" class="ct-point" ct:value="1900" ct:meta="Visitors"></line><line x1="304.5625" y1="35.71428571428572" x2="304.5725" y2="35.71428571428572" class="ct-point" ct:value="3000" ct:meta="Visitors"></line><line x1="402.75" y1="10" x2="402.76" y2="10" class="ct-point" ct:value="3500" ct:meta="Visitors"></line></g></g><g class="ct-labels"></g></svg></div>
                                            </div>
                                            <div class="download-details">
                                                <p>21<sup>%</sup> more visitors than last month</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                                            <div class="monthly-avg">
                                                <h6>Monthly Average</h6>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-secondary">9500</h4>
                                                    <h6 class="avg-label">
                                                        Visitors
                                                    </h6>
                                                </div>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-primary">$510<sup>k</sup></h4>
                                                    <h6 class="avg-label">
                                                        Sales
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                                            <h6 class="card-title mt-0">Orders</h6>
                                            <div class="chartist custom-two">
                                                <div class="line-chart2"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="190px" class="ct-chart-line" style="width: 100%; height: 190px;"><g class="ct-grids"><line y1="190" y2="190" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="167.5" y2="167.5" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="145" y2="145" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="122.5" y2="122.5" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="100" y2="100" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="77.5" y2="77.5" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="55" y2="55" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="32.5" y2="32.5" x1="10" x2="402.75" class="ct-grid ct-vertical"></line><line y1="10" y2="10" x1="10" x2="402.75" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><path d="M10,154C59.094,154,59.094,133.75,108.188,133.75C157.281,133.75,157.281,95.5,206.375,95.5C255.469,95.5,255.469,154,304.563,154C353.656,154,353.656,23.5,402.75,23.5" class="ct-line"></path><line x1="10" y1="154" x2="10.01" y2="154" class="ct-point" ct:value="800" ct:meta="Sales"></line><line x1="108.1875" y1="133.75" x2="108.1975" y2="133.75" class="ct-point" ct:value="1250" ct:meta="Sales"></line><line x1="206.375" y1="95.5" x2="206.385" y2="95.5" class="ct-point" ct:value="2100" ct:meta="Sales"></line><line x1="304.5625" y1="154" x2="304.5725" y2="154" class="ct-point" ct:value="800" ct:meta="Sales"></line><line x1="402.75" y1="23.5" x2="402.76" y2="23.5" class="ct-point" ct:value="3700" ct:meta="Sales"></line></g></g><g class="ct-labels"></g></svg></div>
                                            </div>
                                            <div class="download-details">
                                                <p>15<sup>%</sup> more sales than last month</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->
                                </div>
                                <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab" aria-expanded="false">
                                    <!-- Row starts -->
                                    <div class="row align-items-center gutters">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <div class="monthly-avg plain">
                                                <h6>Daily</h6>
                                                <div class="avg-block">
                                                    <h4 class="avg-total text-secondary">29,300</h4>
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
                                                    <h4 class="avg-total text-secondary">3,200</h4>
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
                                                    <h4 class="avg-total text-secondary">29,300</h4>
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
                                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 245px;"><div class="customScroll3" style="overflow: hidden; width: auto; height: 245px;">
                                                    <div class="card m-0">
                                                        <div class="card-body">
                                                            <ul class="stocks">
                                                                <li>
                                                                    <p class="clearfix">Apple Inc
                                                                        <span><i class="icon-arrow-up-right2 text-success"></i>
																			46,540<small class="text-success">+2.005</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Google Inc<span><i class="icon-arrow-up-right2 text-success"></i>8219<small class="text-success">-4.031</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Yahoo Inc<span><i class="icon-arrow-down-right2 text-danger"></i>3188<small class="text-danger">+7.652</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Facebook Inc<span><i class="icon-arrow-up-right2 text-success"></i>46545<small class="text-success">+11.82</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Ebay Inc<span><i class="icon-arrow-down-right2 text-danger"></i>662<small class="text-danger">-5.281</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Amazon Inc<span><i class="icon-arrow-up-right2 text-success"></i>27873<small class="text-success">+7.318</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Microsoft<span><i class="icon-arrow-up-right2 text-success"></i>3964<small class="text-success">-3.091</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Federal Bank<span><i class="icon-arrow-up-right2 text-success"></i>10760<small class="text-success">+4.585</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Nicco Corp<span><i class="icon-arrow-down-right2 text-danger"></i>260<small class="text-danger">-6.955</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Uflex<span><i class="icon-arrow-up-right2 text-success"></i>37095<small class="text-success">+5.079</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Trivago NV<span><i class="icon-arrow-up-right2 text-success"></i>1851<small class="text-success">+9.555</small></span></p>
                                                                </li>
                                                                <li>
                                                                    <p class="clearfix">Cobham PLC<span><i class="icon-arrow-down-right2 text-danger"></i>364<small class="text-danger">-8.432</small></span></p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div><div class="slimScrollBar" style="background: rgb(229, 232, 242) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.8; display: block; border-radius: 0px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(0, 122, 225) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
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
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                    <div class="info-stats4">
                        <div class="icon-type pull-left">
                            <i class="icon-wallet"></i>
                        </div>
                        <div class="sale-num">
                            <h4>450 <span>(screen 1)</span></h4>
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
                            <h4>890 <span>(screen 1)</span></h4>
                            <p>Total Sold</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                    <div class="info-stats4">
                        <div class="icon-type pull-left">
                            <i class="icon-wallet"></i>
                        </div>
                        <div class="sale-num">
                            <h4>185 <span>(screen 2)</span></h4>
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
                            <h4>570 <span>(screen 2)</span></h4>
                            <p>Total Sold</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gutters pie-sec">
                <div class="col-lg-4 col-md-4 col-sm-6 one-fifth">
                    <div class="card">
                        <div class="card-header">Online Booking </div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="pie-chart"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="180px" class="ct-chart-pie" style="width: 100%; height: 180px;"><g class="ct-series ct-series-a"><path d="M229.77,132.5A85,85,0,0,0,156.158,5L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g><g class="ct-series ct-series-b"><path d="M82.546,132.5A85,85,0,0,0,229.918,132.243L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g><g class="ct-series ct-series-c"><path d="M156.158,5A85,85,0,0,0,82.695,132.757L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g></svg></div>
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
                        <div class="card-header">Phone Booking </div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="pie-chart2"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="180px" class="ct-chart-pie" style="width: 100%; height: 180px;"><g class="ct-series ct-series-a"><path d="M229.77,132.5A85,85,0,0,0,156.158,5L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g><g class="ct-series ct-series-b"><path d="M82.546,132.5A85,85,0,0,0,229.918,132.243L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g><g class="ct-series ct-series-c"><path d="M156.158,5A85,85,0,0,0,82.695,132.757L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g></svg></div>
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
                        <div class="card-header">Android Apps Booking </div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="pie-chart3"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="180px" class="ct-chart-pie" style="width: 100%; height: 180px;"><g class="ct-series ct-series-a"><path d="M229.77,132.5A85,85,0,0,0,156.158,5L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g><g class="ct-series ct-series-b"><path d="M82.546,132.5A85,85,0,0,0,229.918,132.243L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g><g class="ct-series ct-series-c"><path d="M156.158,5A85,85,0,0,0,82.695,132.757L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g></svg></div>
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
                        <div class="card-header">iPhone Apps Booking </div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="pie-chart4"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="180px" class="ct-chart-pie" style="width: 100%; height: 180px;"><g class="ct-series ct-series-a"><path d="M229.77,132.5A85,85,0,0,0,156.158,5L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g><g class="ct-series ct-series-b"><path d="M82.546,132.5A85,85,0,0,0,229.918,132.243L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g><g class="ct-series ct-series-c"><path d="M156.158,5A85,85,0,0,0,82.695,132.757L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g></svg></div>
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
                        <div class="card-header">Third Party API sold </div>
                        <div class="card-body">
                            <div class="chartist custom-two">
                                <div class="pie-chart5"><div class="chartist-tooltip"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="180px" class="ct-chart-pie" style="width: 100%; height: 180px;"><g class="ct-series ct-series-a"><path d="M229.77,132.5A85,85,0,0,0,156.158,5L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g><g class="ct-series ct-series-b"><path d="M82.546,132.5A85,85,0,0,0,229.918,132.243L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g><g class="ct-series ct-series-c"><path d="M156.158,5A85,85,0,0,0,82.695,132.757L156.158,90Z" class="ct-slice-pie" ct:value="328"></path></g></svg></div>
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
                        <div class="card-header">Seat Purchase Report by Class Level Wise, Real Time</div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover m-0">
                                <thead>
                                <tr>
                                    <th>Show</th>
                                    <th>Seat Plan</th>
                                    <th>Screen</th>
                                    <th>Tkt Type 1</th>
                                    <th>Tkt Type 2</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Mr. Virgin</th>
                                    <td>View Seat</td>
                                    <td>Screen 1: 11 am</td>
                                    <td>30 (200)</td>
                                    <td>40 (250)</td>
                                </tr>
                                <tr>
                                    <th scope="row">Padmavati</th>
                                    <td>View Seat</td>
                                    <td>Screen 2: 10 am</td>
                                    <td>12 (250)</td>
                                    <td>40 (350)</td>
                                </tr>
                                <tr>
                                    <th scope="row">Blind Rocks</th>
                                    <td>View Seat</td>
                                    <td>Screen 2: 1 PM</td>
                                    <td>25 (250)</td>
                                    <td>40 (350)</td>
                                </tr>
                                <tr>
                                    <th scope="row">Naaka</th>
                                    <td>View Seat</td>
                                    <td>Screen 1: 2 PM</td>
                                    <td>40 (200)</td>
                                    <td>40 (250)</td>
                                </tr>
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
                        <div class="card-body">
                            <div class="table-responsive table-scroll">
                                <table id="" class="table table-striped table-bordered m-0 table-bottom">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Location</th>
                                        <th>Product code</th>
                                        <th>Purchased on</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Edinburgh</td>
                                        <td>#127654</td>
                                        <td>2017/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2017/07/25</td>
                                        <td>$170,750</td>
                                    </tr>
                                    <tr>
                                        <td>Ashton Cox</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2017/01/12</td>
                                        <td>$86,000</td>
                                    </tr>
                                    <tr>
                                        <td>Cedric Kelly</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2017/03/29</td>
                                        <td>$433,060</td>
                                    </tr>
                                    <tr>
                                        <td>Airi Satou</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Tokyo</td>
                                        <td>33</td>
                                        <td>2017/11/28</td>
                                        <td>$162,700</td>
                                    </tr>
                                    <tr>
                                        <td>Brielle Williamson</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>61</td>
                                        <td>2017/12/02</td>
                                        <td>$372,000</td>
                                    </tr>
                                    <tr>
                                        <td>Herrod Chandler</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>59</td>
                                        <td>2017/08/06</td>
                                        <td>$137,500</td>
                                    </tr>
                                    <tr>
                                        <td>Rhona Davidson</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Tokyo</td>
                                        <td>55</td>
                                        <td>2017/10/14</td>
                                        <td>$327,900</td>
                                    </tr>
                                    <tr>
                                        <td>Colleen Hurst</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>39</td>
                                        <td>2017/09/15</td>
                                        <td>$205,500</td>
                                    </tr>
                                    <tr>
                                        <td>Sonya Frost</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Edinburgh</td>
                                        <td>23</td>
                                        <td>2017/12/13</td>
                                        <td>$103,600</td>
                                    </tr>
                                    <tr>
                                        <td>Jena Gaines</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>30</td>
                                        <td>2017/12/19</td>
                                        <td>$90,560</td>
                                    </tr>
                                    <tr>
                                        <td>Quinn Flynn</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2017/03/03</td>
                                        <td>$342,000</td>
                                    </tr>
                                    <tr>
                                        <td>Charde Marshall</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>36</td>
                                        <td>2017/10/16</td>
                                        <td>$470,600</td>
                                    </tr>
                                    <tr>
                                        <td>Haley Kennedy</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>43</td>
                                        <td>2017/12/18</td>
                                        <td>$313,500</td>
                                    </tr>
                                    <tr>
                                        <td>Tatyana Fitzpatrick</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>19</td>
                                        <td>2017/03/17</td>
                                        <td>$385,750</td>
                                    </tr>
                                    <tr>
                                        <td>Michael Silva</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>66</td>
                                        <td>2017/11/27</td>
                                        <td>$198,500</td>
                                    </tr>
                                    <tr>
                                        <td>Paul Byrd</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>64</td>
                                        <td>2017/06/09</td>
                                        <td>$725,000</td>
                                    </tr>
                                    <tr>
                                        <td>Gloria Little</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>59</td>
                                        <td>2017/04/10</td>
                                        <td>$237,500</td>
                                    </tr>
                                    <tr>
                                        <td>Bradley Greer</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>41</td>
                                        <td>2017/10/13</td>
                                        <td>$132,000</td>
                                    </tr>
                                    <tr>
                                        <td>Dai Rios</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Edinburgh</td>
                                        <td>35</td>
                                        <td>2017/09/26</td>
                                        <td>$217,500</td>
                                    </tr>
                                    <tr>
                                        <td>Jenette Caldwell</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>30</td>
                                        <td>2017/09/03</td>
                                        <td>$345,000</td>
                                    </tr>
                                    <tr>
                                        <td>Yuri Berry</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>40</td>
                                        <td>2017/06/25</td>
                                        <td>$675,000</td>
                                    </tr>
                                    <tr>
                                        <td>Caesar Vance</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>21</td>
                                        <td>2017/12/12</td>
                                        <td>$106,450</td>
                                    </tr>
                                    <tr>
                                        <td>Doris Wilder</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Sidney</td>
                                        <td>23</td>
                                        <td>2017/09/20</td>
                                        <td>$85,600</td>
                                    </tr>
                                    <tr>
                                        <td>Angelica Ramos</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>47</td>
                                        <td>2017/10/09</td>
                                        <td>$1,200,000</td>
                                    </tr>
                                    <tr>
                                        <td>Gavin Joyce</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Edinburgh</td>
                                        <td>42</td>
                                        <td>2017/12/22</td>
                                        <td>$92,575</td>
                                    </tr>
                                    <tr>
                                        <td>Jennifer Chang</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Singapore</td>
                                        <td>28</td>
                                        <td>2017/11/14</td>
                                        <td>$357,650</td>
                                    </tr>
                                    <tr>
                                        <td>Brenden Wagner</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>28</td>
                                        <td>2017/06/07</td>
                                        <td>$206,850</td>
                                    </tr>
                                    <tr>
                                        <td>Fiona Green</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>48</td>
                                        <td>2017/03/11</td>
                                        <td>$850,000</td>
                                    </tr>
                                    <tr>
                                        <td>Shou Itou</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Tokyo</td>
                                        <td>20</td>
                                        <td>2017/08/14</td>
                                        <td>$163,000</td>
                                    </tr>
                                    <tr>
                                        <td>Michelle House</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Sidney</td>
                                        <td>37</td>
                                        <td>2017/06/02</td>
                                        <td>$95,400</td>
                                    </tr>
                                    <tr>
                                        <td>Suki Burks</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>53</td>
                                        <td>2017/10/22</td>
                                        <td>$114,500</td>
                                    </tr>
                                    <tr>
                                        <td>Prescott Bartlett</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>27</td>
                                        <td>2017/05/07</td>
                                        <td>$145,000</td>
                                    </tr>
                                    <tr>
                                        <td>Gavin Cortez</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>22</td>
                                        <td>2017/10/26</td>
                                        <td>$235,500</td>
                                    </tr>
                                    <tr>
                                        <td>Martena Mccray</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Edinburgh</td>
                                        <td>46</td>
                                        <td>2017/03/09</td>
                                        <td>$324,050</td>
                                    </tr>
                                    <tr>
                                        <td>Unity Butler</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>47</td>
                                        <td>2017/12/09</td>
                                        <td>$85,675</td>
                                    </tr>
                                    <tr>
                                        <td>Howard Hatfield</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>51</td>
                                        <td>2017/12/16</td>
                                        <td>$164,500</td>
                                    </tr>
                                    <tr>
                                        <td>Hope Fuentes</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>41</td>
                                        <td>2017/02/12</td>
                                        <td>$109,850</td>
                                    </tr>
                                    <tr>
                                        <td>Vivian Harrell</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>62</td>
                                        <td>2017/02/14</td>
                                        <td>$452,500</td>
                                    </tr>
                                    <tr>
                                        <td>Timothy Mooney</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>37</td>
                                        <td>2017/12/11</td>
                                        <td>$136,200</td>
                                    </tr>
                                    <tr>
                                        <td>Jackson Bradshaw</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>65</td>
                                        <td>2017/09/26</td>
                                        <td>$645,750</td>
                                    </tr>
                                    <tr>
                                        <td>Olivia Liang</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Singapore</td>
                                        <td>64</td>
                                        <td>2017/02/03</td>
                                        <td>$234,500</td>
                                    </tr>
                                    <tr>
                                        <td>Bruno Nash</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>38</td>
                                        <td>2017/05/03</td>
                                        <td>$163,500</td>
                                    </tr>
                                    <tr>
                                        <td>Sakura Yamamoto</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Tokyo</td>
                                        <td>37</td>
                                        <td>2017/08/19</td>
                                        <td>$139,575</td>
                                    </tr>
                                    <tr>
                                        <td>Thor Walton</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>61</td>
                                        <td>2017/08/11</td>
                                        <td>$98,540</td>
                                    </tr>
                                    <tr>
                                        <td>Finn Camacho</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>47</td>
                                        <td>2017/07/07</td>
                                        <td>$87,500</td>
                                    </tr>
                                    <tr>
                                        <td>Serge Baldwin</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Singapore</td>
                                        <td>64</td>
                                        <td>2017/04/09</td>
                                        <td>$138,575</td>
                                    </tr>
                                    <tr>
                                        <td>Zenaida Frank</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>63</td>
                                        <td>2017/01/04</td>
                                        <td>$125,250</td>
                                    </tr>
                                    <tr>
                                        <td>Zorita Serrano</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>56</td>
                                        <td>2017/06/01</td>
                                        <td>$115,000</td>
                                    </tr>
                                    <tr>
                                        <td>Jennifer Acosta</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Edinburgh</td>
                                        <td>43</td>
                                        <td>2017/02/01</td>
                                        <td>$75,650</td>
                                    </tr>
                                    <tr>
                                        <td>Cara Stevens</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>46</td>
                                        <td>2017/12/06</td>
                                        <td>$145,600</td>
                                    </tr>
                                    <tr>
                                        <td>Hermione Butler</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>47</td>
                                        <td>2017/03/21</td>
                                        <td>$356,250</td>
                                    </tr>
                                    <tr>
                                        <td>Lael Greer</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>London</td>
                                        <td>21</td>
                                        <td>2017/02/27</td>
                                        <td>$103,500</td>
                                    </tr>
                                    <tr>
                                        <td>Jonas Alexander</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>San Francisco</td>
                                        <td>30</td>
                                        <td>2017/07/14</td>
                                        <td>$86,500</td>
                                    </tr>
                                    <tr>
                                        <td>Shad Decker</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Edinburgh</td>
                                        <td>51</td>
                                        <td>2017/11/13</td>
                                        <td>$183,000</td>
                                    </tr>
                                    <tr>
                                        <td>Michael Bruce</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>Singapore</td>
                                        <td>29</td>
                                        <td>2017/06/27</td>
                                        <td>$183,000</td>
                                    </tr>
                                    <tr>
                                        <td>Donna Snider</td>
                                        <td><img src="img/user.png" class="img-30" alt="product"></td>
                                        <td>New York</td>
                                        <td>27</td>
                                        <td>2017/01/25</td>
                                        <td>$112,000</td>
                                    </tr>
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

