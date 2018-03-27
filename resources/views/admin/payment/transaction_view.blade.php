@extends('admin.layout.master1')

@section('main-body')
    <!-- BEGIN .app-main -->
    <div class="app-main">
        <!-- BEGIN .main-heading -->
        <header class="main-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="page-icon">
                            <i class="icon-border_outer"></i>
                        </div>
                        <div class="page-title">
                            <h5>Transaction Log</h5>
                            <h6 class="sub-heading">Welcome to Merotheatre Admin</h6>
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
                <div class=" col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="filter-div">
                                            <div class="crm-title filter-transaction-title">
                                                <div class="row">
                                                    <div class="col-md-11">  <form action="{{url('admin/payments/transactionlog/transactionType')}}" method="POST" id="transactionLive">
                                                    {{csrf_field()}}
                                                    <input type="button" id="transaction_type_button_live" class="btn btn-primary" value="Live">
                                                    <input type="hidden" name="transaction_type" value="live">
                                            </form></div>
                                                     <div class="col-md-1">
                                                          <form action="{{url('admin/payments/transactionlog/transactionType')}}" method="POST" id="transactionTest">
                                                    {{csrf_field()}}
                                                     <input type="button" class="btn btn-primary" value="Test" id="transaction_type_button_test">
                                                      <input type="hidden" name="transaction_type" value="test">
                                            </form>
                                                     </div>
                                                </div>
                                              

                                           
                                            <div class="clearfix"></div>
                                            
                                            </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                         <form class="form" role="form" autocomplete="off" action="{{url('admin/payments/transactionlog/searchByUser')}}"  method="post">
                                                            {{csrf_field()}}
                                                        <div class="input-group">
                                                          <input type="text" class="form-control" placeholder="Search by name, email & phone" name="search">
                                                           <input type="hidden" id="transaction_default_type" value="{{$transactionType}}" name="transaction_default_type">
                                                          <button type="submit" class="input-group-addon">
                                                          <i class="icon-search"></i>
                                                      </button>
                                                        </div>


                                                    </form>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group date">
                                                          <input type="text" class="form-control" placeholder="Start Date" id="start_date">
                                                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group date">
                                                          <input type="text" class="form-control" placeholder="End Date" id="end_date">
                                                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                            <div class="filter-select">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select id = "searchByPaymentType" name="searchByPaymentType" class="custom-select form-contorl">
                                                            <option value="" class="selected">Transaction Types</option>
                                                            @if(!empty($payment_types))
                                                            @foreach($payment_types as $pt)
                                                            <option value="{{$pt->id}}">{{$pt->name}}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="searchByState" id = "searchByState"  class="custom-select form-control">
                                                            <option value="" class="selected">Transaction states</option>
                                                            <option value="initiated">Initiated</option>
                                                            <option value="completed">Completed</option>
                                                            <option value="confirmed">Confirmed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <div class="table-responsive">
        <table class="table m-0 table-bordered common-table" id="old_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Amount(Rs)</th>
                                    <th>Fee(Rs)</th>
                                    <th>Date</th>
                                     <th>Type</th>
                                    <th>State</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($payment_transactions))
                                @foreach($payment_transactions as $pt)
                                <tr>
                                <th>{{$pt->transaction_id}}</th>
                                @php 
                                if(!empty(App\TransactionLog::where('user_id' , $pt->user_id)->first())){
                                $users = App\TransactionLog::where('user_id' , $pt->user_id)->first()->users;
                                         }

                                         if(!empty(App\TransactionLog::where('payment_type_id' , $pt->payment_type_id)->first())){
                                $paymentTypes = App\TransactionLog::where('payment_type_id' , $pt->payment_type_id)->first()->payment_types;
                                         }
                              
                                
                                 @endphp
                                @if(!empty($users))
                                <td>{{$users->name}}</td>
                                @endif
                                 <td>{{$pt->amount}}</td>
                                  <td>{{$pt->fee}}</td>
                                   <td>{{$pt->created_at}}</td>
                                    @if(!empty($paymentTypes))
                                    <td>{{$paymentTypes->name}}</td>
                                      @endif
                                     <td>{{$pt->state}}</td>
                                 </tr>
                                  @endforeach
                                  @endif
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

        </div>
        <!-- END: .main-content -->
    </div>
    <!-- END: .app-main -->
@stop
@section('scripts')
    <script>
     var today = new Date();
    $("#start_date , #end_date").datepicker({
        format:'yyyy-mm-dd',
    });

 var transaction_type = $("#transaction_default_type").val();


$('#searchByPaymentType').on('change', function(e) {
     e.preventDefault();
    var payment_type_id = $(this).find(":selected").val();
     $.ajax({
            url: baseurl + '/admin/payments/transactionlog/searchByPaymentType',
                        type: 'post',
                        data:{ 
                               'payment_type_id': payment_type_id,
                               '_token': $('#token').val(),
                               'transaction_type' : transaction_type,
                    },
                        success: function (data) {
                            $("#old_table").html(data);

                        }, error: function (data) {

                        }
                    });

});


$('#searchByState').on('change', function(e) {
     e.preventDefault();
    var payment_state = $(this).find(":selected").val();
     $.ajax({
            url: baseurl + '/admin/payments/transactionlog/searchByState',
                        type: 'post',
                        data:{ 
                               'payment_state': payment_state,
                               '_token': $('#token').val(),
                                'transaction_type' : transaction_type,
                    },
                        success: function (data) {
                            $("#old_table").html(data);

                        }, error: function (data) {

                        }
                    });

});

$('#start_date , #end_date').on('change', function(e) {
     e.preventDefault();
   var start_date = $("#start_date").datepicker().val();
   var end_date = $("#end_date").datepicker().val()
     $.ajax({
            url: baseurl + '/admin/payments/transactionlog/searchByStartdate',
                        type: 'post',
                        data:{ 
                               'start_date': start_date,
                               'end_date': end_date,
                               '_token': $('#token').val(),
                                'transaction_type' : transaction_type,
                    },
                        success: function (data) {
                            $("#old_table").html(data);

                        }, error: function (data) {

                        }
                    });

});


$('#transaction_type_button_live').on('click', function(e) {
    $("#transactionLive").submit();
});

$('#transaction_type_button_test').on('click', function(e) {
    $("#transactionTest").submit();
});



    </script>
@stop

