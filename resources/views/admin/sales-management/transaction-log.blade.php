@extends('admin.layout.master1')

@section('styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <style>
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
        }

        .cancel-all-filters {
            float: right;
            padding: 6px 10px;
            margin-right: 10px;
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
                            <i class="icon-tabs-outline"></i>
                        </div>
                        <div class="page-title">
                            <h5>Sales Transaction Log</h5>
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
                        <div class="card-header">Filter By Custom Dates</div>
                        <div class="card-body">
                            <div class="trasaction-wrap">
                                <h5>Custom Date Range</h5>
                                <div class="transaction-date">
                                    <div class="input-group input-daterange">
                                        <div class="input-group-addon">From</div>
                                        <input class="form-control" id="custom-start-date"
                                               value="{{isset($_GET['start']) ? $_GET['start'] : ''}}"
                                               type="text">
                                        <div class="input-group-addon">To</div>
                                        <input class="form-control" id="custom-to-date"
                                               value="{{isset($_GET['end']) ? $_GET['end'] : ''}}"
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
                        <div class="card-header">Filter By Screen</div>
                        <div class="card-body">
                            <div class="trasaction-wrap">
                                <h5>Screens</h5>
                                <div class="screen-btn">
                                    @if(isset($screens) && $screens->count() > 0)
                                        @foreach($screens as $screen)
                                            <a href="#"
                                               class="{{isset($_GET['screen']) && $_GET['screen'] == $screen->id ? 'active' : ''}} screen-tabs"
                                               data-screenid="{{$screen->id}}">{{$screen->name}}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
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
                        <div class="card-header">Sales Transaction Log <a href="#"
                                                                          class="btn btn-primary export-to-excel">Export</a>
                            @if(isset($_GET['start']) || isset($_GET['screen']))
                                <a href="{{url('admin/sales-management/transaction-log')}}" class="btn btn-danger cancel-all-filters">Cancel All FIlters</a>
                            @endif
                        </div>
                        <div class="card-body table-responsive">
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
                                <tbody>
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
            <!-- Row end -->
        </div>
        <!-- END: .main-content -->
    </div>
@stop

@section('scripts')

    <script>
        $(document).on('click', '.screen-tabs', function (e) {
            e.preventDefault();
            if (!$(this).hasClass('active')) {
                var screenId = $(this).data('screenid');
                @if (isset($_GET['start']) && isset($_GET['end']))
                    var startDate = "{{$_GET['start']}}";
                    var endDate = "{{$_GET['end']}}";
                    if (endDate < startDate) {
                        alertify.alert('End Date Cannot Be Greater Than Start Date');
                    } else if (endDate == startDate) {
                        window.location = baseurl + '/admin/sales-management/transaction-log?screen=' + screenId + '&start=' + startDate + '&end=' + endDate;
                    } else {
                        window.location = baseurl + '/admin/sales-management/transaction-log?screen=' + screenId + '&start=' + startDate + '&end=' + endDate;
                    }
                @else
                    window.location = baseurl + '/admin/sales-management/transaction-log?screen=' + screenId;
                @endif
            }
        });

        $(document).on('click', '.submit-custom-date', function (e) {
            e.preventDefault();
            var screenId = $(document).find('.screen-tabs.active').data('screenid');
            if (screenId == undefined) {
                var startDate = $('#custom-start-date').val();
                var endDate = $('#custom-to-date').val();
                if (startDate != '' && endDate != '') {
                    if (endDate < startDate) {
                        alertify.alert('End Date Cannot Be Greater Than Start Date');
                    } else if (endDate == startDate) {
                        window.location = baseurl + '/admin/sales-management/transaction-log?start=' + startDate + '&end=' + endDate;
                    } else {
                        window.location = baseurl + '/admin/sales-management/transaction-log?start=' + startDate + '&end=' + endDate;
                    }
                }
            } else {
                var startDate = $('#custom-start-date').val();
                var endDate = $('#custom-to-date').val();
                if (startDate != '' && endDate != '') {
                    if (endDate < startDate) {
                        alertify.alert('End Date Cannot Be Greater Than Start Date');
                    } else if (endDate == startDate) {
                        window.location = baseurl + '/admin/sales-management/transaction-log?screen=' + screenId + '&start=' + startDate + '&end=' + endDate;
                    } else {
                        window.location = baseurl + '/admin/sales-management/transaction-log?screen=' + screenId + '&start=' + startDate + '&end=' + endDate;
                    }
                }
            }

        });

        $('#custom-start-date').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('#custom-to-date').datepicker({
            format: 'yyyy-mm-dd'
        });

        $(document).on('click', '.export-to-excel', function (e) {
            e.preventDefault();
            var url = window.location.href;
            if (url.indexOf('?') > -1) {
                url = url + '&action=export';
            } else {
                url = url + '?action=export';
            }

            window.location = url;
        });
    </script>
@stop