@extends('admin.layout.master1')

<!--Page specific css-->
@section('page_css')

@endsection
<!--/-->

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
            <div class="">
                <div class="box" style="border-top: 5px solid green;">
                    <div class="box-header">
                        <button class="btn btn-success" id="filter_btn"><i class="fa fa-filter"></i> Filter</button>
                        <div class="dateForm">
                            <form class="form-inline" style="margin-top: 10px;" id="filterDateForm">
                                <div class="input-group date" id="datepicker1">
                                    <input required type="text" id="start_date" name="start_date" placeholder="From"
                                           class="form-control" value="{{app('request')->input('start_date')}}">
                                    <span class="input-group-addon" id="calendarIconAddon"><i
                                                class="fa fa-calendar"></i></span>
                                </div>

                                <div class="input-group date" id="datepicker2">
                                    <input required type="text" id="end_date" name="end_date" placeholder="To"
                                           class="form-control" value="{{app('request')->input('end_date')}}">
                                    <span class="input-group-addon" id="secondCalendarIconAddon"><i
                                                class="fa fa-calendar"></i></span>
                                </div>
                                <div class="input-group">
                                    <select name="delivery_status" id="status">
                                        <option value="" disabled selected>Delivery Status</option>
                                        <option value="queued">Queued</option>
                                        <option value="pending">Pending</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="failed">Failed</option>
                                    </select>

                                </div>
                                <div class="input-group">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>

                            </form>
                        </div>
                        <h4><strong>List of SMS Log</strong></h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 10px;">
                        <table class="table table-striped table-bordered table-hover no-footer">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Receiver</th>
                                <th>Message</th>
                                <th>Network</th>
                                <th>Delivery Status</th>
                                <th>Send On</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if ($histories)
                                @foreach($histories as $key => $item)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$item->recipient}}</td>
                                        <td style="width: 45%;">{{$item->body}}</td>
                                        <td>{{$item->network}}</td>
                                        <td>{{$item->status}}</td>
                                        <td>{{$item->created_at}}</td>

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <?php use Illuminate\Support\Facades\Input;echo $histories->appends(Input::query())->render();?>
                    </div>
                {{$histories->appends(['start_date' =>app('request')->input('start_date'),'end_date' =>app('request')->input('end_date'),'delivery_status' =>app('request')->input('delivery_status')])->links()}}
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- END: .main-content -->
        </div>
        <!-- END: .main-content -->
    </div>

@stop

@section('scripts')
    <script src="{{URL::to('/custom/js/sms-log-filter.js')}}"></script>

    <script type="text/javascript">
        $("#status").val("{{app('request')->input('delivery_status')}}");
    </script>
@endsection
