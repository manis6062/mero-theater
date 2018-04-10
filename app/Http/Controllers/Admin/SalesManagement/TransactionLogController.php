<?php

namespace App\Http\Controllers\Admin\SalesManagement;

use App\BookingModel\CounterSell;
use App\Http\Controllers\Controller;
use App\Screen\Screen;
use Illuminate\Http\Request;

class TransactionLogController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->action)) {
            $screens = Screen::orderBy('screen_number')->get();
            if (!isset($request->screen) && !isset($request->start)) {
                $transactionData = CounterSell::orderBy('id', 'DESC')->paginate('10');
            } elseif (isset($request->screen) && !isset($request->start)) {
                $transactionData = CounterSell::where('screen_id', $request->screen)->orderBy('id', 'DESC')->paginate('10');
            } elseif (!isset($request->screen) && isset($request->start)) {
                $transactionData = CounterSell::whereBetween('created_at', [$request->start . ' 00:00:00', $request->end . ' 23:59:59'])->orderBy('id', 'DESC')->paginate('10');
            } else {
                $transactionData = CounterSell::where('screen_id', $request->screen)->whereBetween('created_at', [$request->start . ' 00:00:00', $request->end . ' 23:59:59'])->orderBy('id', 'DESC')->paginate('10');
            }

            return view('admin.sales-management.transaction-log', compact('transactionData', 'screens'));
        } else {
            if (!isset($request->screen) && !isset($request->start)) {
                $exportedScreen = 'all';
                $exportedDateRange = 'all';
                $transactionData = CounterSell::orderBy('id', 'DESC')->get();
            } elseif (isset($request->screen) && !isset($request->start)) {
                $exportedScreen = Screen::find($request->screen)->name;
                $exportedDateRange = 'all';
                $transactionData = CounterSell::where('screen_id', $request->screen)->orderBy('id', 'DESC')->get();
            } elseif (!isset($request->screen) && isset($request->start)) {
                $exportedDateRange = $request->start.' - '.$request->end;
                $exportedScreen = 'All';
                $transactionData = CounterSell::whereBetween('created_at', [$request->start . ' 00:00:00', $request->end . ' 23:59:59'])->orderBy('id', 'DESC')->get();
            } else {
                $exportedDateRange = $request->start.' - '.$request->end;
                $exportedScreen = Screen::find($request->screen)->name;
                $transactionData = CounterSell::where('screen_id', $request->screen)->whereBetween('created_at', [$request->start . ' 00:00:00', $request->end . ' 23:59:59'])->orderBy('id', 'DESC')->get();
            }

            $reportingArray = [];
            $array = [];

            $sn = 0;
            foreach ($transactionData as $transactionDatum) {
                $sn += 1;
                $array['S.N.'] = $sn;
                $array['Customer Name'] = \App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->customer_name != null ? \App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->customer_name : 'N/A';
                $array['Invoice Number'] = $transactionDatum->invoice_number;
                $array['Payment Mode'] = \App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->payment_mode != null ? \App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->payment_mode : 'N/A';
                $array['Screen'] = \App\Screen\Screen::find($transactionDatum->screen_id)->name;
                $array['Category'] = $transactionDatum->seat_category;
                $array['Seat'] = $transactionDatum->seat_name;
                $array['Price'] = $transactionDatum->seat_price;
                $array['Movie'] = \App\MovieModel::find($transactionDatum->movie_id)->movie_title;
                $array['Show Date'] = $transactionDatum->show_date;
                $array['Show Time'] = $transactionDatum->show_time;
                $array['Show Day'] = $transactionDatum->show_day;
                $array['Sold At'] = date('d M, Y', strtotime($transactionDatum->created_at));
                $reportingArray[] = $array;
            }

            \Excel::create('Sales Transaction Log', function ($excel) use ($reportingArray, $exportedScreen, $exportedDateRange) {


                $excel->setTitle('Sales Transaction Log');
                $excel->setDescription('Sales Transaction Log');

                $excel->sheet('Excel Sheet', function ($sheet) use ($reportingArray, $exportedScreen, $exportedDateRange) {
                    //                for row 1
                    $sheet->mergeCells('A1:M1');
                    $style = array(
                        'alignment' => array(
                            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        )
                    );
                    $sheet->getStyle("A1:M1")->applyFromArray($style);
                    $sheet->row(1, function ($row) {
                        $row->setFontFamily('Roboto Sans Serif');
                        $row->setFontSize(15);
                    });
                    $sheet->row(1, array('Screen : '.strtoupper($exportedScreen)));


                    //                for row 2
                    $sheet->mergeCells('A2:M2');
                    $style = array(
                        'alignment' => array(
                            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        )
                    );
                    $sheet->getStyle("A1:M2")->applyFromArray($style);
                    $sheet->row(2, function ($row) {
                        $row->setFontFamily('Roboto Sans Serif');
                        $row->setFontSize(15);
                    });
                    $sheet->row(2, array('Date Range : '.strtoupper($exportedDateRange)));

                    $categories = [];
                    $categories[] = 'S.N.';
                    $categories[] = 'Customer Name';
                    $categories[] = 'Invoice Number';
                    $categories[] = 'Payment Mode';
                    $categories[] = 'Screen';
                    $categories[] = 'Category';
                    $categories[] = 'Seat';
                    $categories[] = 'Price';
                    $categories[] = 'Movie';
                    $categories[] = 'Show Date';
                    $categories[] = 'Show Time';
                    $categories[] = 'Show Day';
                    $categories[] = 'Sold At';

                    $sheet->appendRow($categories);

                    foreach ($reportingArray as $array) {
                        $sheet->appendRow($array);
                    }
                });

            })->export('xls');
        }

    }
}
