<?php

namespace App\Http\Controllers\Admin\SalesManagement;

use App\BookingModel\CounterSell;
use App\BookingModel\CounterSellInvoice;
use App\Screen\Screen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionLogController extends Controller
{
    public function index(Request $request)
    {
        $screens = Screen::orderBy('screen_number')->get();
        if(!isset($request->screen) && !isset($request->start))
        {
            $transactionData = CounterSell::orderBy('id', 'DESC')->paginate('10');
        }elseif(isset($request->screen) && !isset($request->start)){
            $transactionData = CounterSell::where('screen_id', $request->screen)->orderBy('id', 'DESC')->paginate('10');
        }elseif(!isset($request->screen) && isset($request->start)){
            $transactionData = CounterSell::whereBetween('created_at', [$request->start.' 00:00:00', $request->end.' 23:59:59'])->orderBy('id', 'DESC')->paginate('10');
        }else{
            $transactionData = CounterSell::where('screen_id', $request->screen)->whereBetween('created_at', [$request->start.' 00:00:00', $request->end.' 23:59:59'])->orderBy('id', 'DESC')->paginate('10');
        }

        return view('admin.sales-management.transaction-log', compact('transactionData', 'screens'));
    }
}
