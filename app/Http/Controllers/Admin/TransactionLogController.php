<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TransactionLog;
use App\PaymentModel;
use App\PaymentApi;
use App\CrmModel;


class TransactionLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactionType = 'live';
        $payment_types = PaymentModel::orderBy('created_at','desc')->get();
        $payment_transactions = TransactionLog::where('transaction_type', $transactionType)->orderBy('created_at','desc')->get();
        return view('admin.payment.transaction_view',compact('payment_types' , 'payment_transactions', 'transactionType'));
    }

    public function searchByUser(Request $request)
        {
            $transactionType = $request->transaction_default_type;
            $search = $request->search;
            $users = CrmModel::where('name','LIKE',"%{$search}%")->orWhere('email' , $search)->orWhere('mobile' , $search)->get();
            if(!empty($users)){
                 foreach ($users as $key => $value) {
                $user_ids[] = $value->id;
             }
             if(!empty($user_ids)){
                  $payment_transactions = TransactionLog::whereIn('user_id', $user_ids)->where('transaction_type', $transactionType)->orderBy('created_at','desc')->get();
             }
            }else{
                $payment_transactions = NULL;
            }
           $payment_types = PaymentModel::orderBy('created_at','desc')->get();
        
        return view('admin.payment.transaction_view',compact('payment_types' , 'payment_transactions' , 'transactionType'));
        }


         public function searchByPaymentType(Request $request)
        {
            $id = $request->payment_type_id;
            $transaction_type = $request->transaction_type;
            $payment_transactions = TransactionLog::where('payment_type_id', $id)->where('transaction_type', $transaction_type)->orderBy('created_at','desc')->get();
          $html_table = '<table class="table m-0 table-bordered common-table">
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
                            </thead><tbody>'; 

    foreach($payment_transactions as $pt) 
      { 
        $users = TransactionLog::where('user_id' , $pt->user_id)->first()->users;
        $paymentTypes = TransactionLog::where('payment_type_id' , $pt->payment_type_id)->first()->payment_types;
        $html_table .= "<tr><td>". $pt->transaction_id."</td>"; 
        $html_table .= "<td>". $users->name."</td>"; 
        $html_table .= "<td>". $pt->amount."</td>"; 
        $html_table .= "<td>". $pt->fee."</td>"; 
        $html_table .= "<td>". $pt->created_at."</td>"; 
        $html_table .= "<td>". $paymentTypes->name."</td>"; 
        $html_table .= "<td>". $pt->state."</td></tr>"; 
      }
     $html_table .= '</tbody></table>';
      return $html_table;
        }

          public function searchByState(Request $request)
        {
            $payment_state = $request->payment_state;
             $transaction_type = $request->transaction_type;
            $payment_transactions = TransactionLog::where('state', $payment_state)->where('transaction_type', $transaction_type)->orderBy('created_at','desc')->get();
          $html_table = '<table class="table m-0 table-bordered common-table">
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
                            </thead><tbody>'; 

    foreach($payment_transactions as $pt) 
      { 
        $users = TransactionLog::where('user_id' , $pt->user_id)->first()->users;
        $paymentTypes = TransactionLog::where('payment_type_id' , $pt->payment_type_id)->first()->payment_types;
        $html_table .= "<tr><td>". $pt->transaction_id."</td>"; 
        $html_table .= "<td>". $users->name."</td>"; 
        $html_table .= "<td>". $pt->amount."</td>"; 
        $html_table .= "<td>". $pt->fee."</td>"; 
        $html_table .= "<td>". $pt->created_at."</td>"; 
        $html_table .= "<td>". $paymentTypes->name."</td>"; 
        $html_table .= "<td>". $pt->state."</td></tr>"; 
      }
     $html_table .= '</tbody></table>';
      return $html_table;
        }

            public function searchByStartdate(Request $request)
        {
            $start_date = $request->start_date;
            if($request->end_date){
                  $end_date = $request->end_date;
            }else{
                $end_date = date('Y-m-d', strtotime('+5 years'));
            }
                         $transaction_type = $request->transaction_type;
            $payment_transactions = TransactionLog::whereBetween('created_at', [$start_date, $end_date])->where('transaction_type', $transaction_type)->orderBy('created_at','desc')->get();
          $html_table = '<table class="table m-0 table-bordered common-table">
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
                            </thead><tbody>'; 

    foreach($payment_transactions as $pt) 
      { 
        $users = TransactionLog::where('user_id' , $pt->user_id)->first()->users;
        $paymentTypes = TransactionLog::where('payment_type_id' , $pt->payment_type_id)->first()->payment_types;
        $html_table .= "<tr><td>". $pt->transaction_id."</td>"; 
        $html_table .= "<td>". $users->name."</td>"; 
        $html_table .= "<td>". $pt->amount."</td>"; 
        $html_table .= "<td>". $pt->fee."</td>"; 
        $html_table .= "<td>". $pt->created_at."</td>"; 
        $html_table .= "<td>". $paymentTypes->name."</td>"; 
        $html_table .= "<td>". $pt->state."</td></tr>"; 
      }
     $html_table .= '</tbody></table>';
      return $html_table;
        }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransactionLog  $transactionLog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $transactionType = $request->transaction_type;
        $payment_types = PaymentModel::orderBy('created_at','desc')->get();
        $payment_transactions = TransactionLog::where('transaction_type' , $transactionType)->orderBy('created_at','desc')->get();
        return view('admin.payment.transaction_view',compact('payment_types' , 'payment_transactions','transactionType' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransactionLog  $transactionLog
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionLog $transactionLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransactionLog  $transactionLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionLog $transactionLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransactionLog  $transactionLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionLog $transactionLog)
    {
        //
    }
}
