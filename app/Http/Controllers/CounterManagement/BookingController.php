<?php

namespace App\Http\Controllers\CounterManagement;

use App\BookingModel\CounterSell;
use App\BookingModel\CounterSellInvoice;
use App\BookingModel\TemporaryReservedSeats;
use App\CompanyModel;
use App\Http\Controllers\Controller;
use App\MovieModel;
use App\ProgrammingModel\ScheduledMovie;
use App\Screen\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use View;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $screen = Screen::find($data['screen']);
        $movie = MovieModel::find($data['movie']);
        $date = $data['date'];
        $time = $data['time'];
        $seatData = $screen->screenSeats;
        $schedule = ScheduledMovie::find($data['schedule']);
        $seatCategories = $screen->screenSeatCategories;
        $myTemporaryReservedSeats = TemporaryReservedSeats::where('screen_id', $screen->id)->where('movie_id', $movie->id)->where('show_date', $date)->where('show_time', $time)->where('processed_by', 'counter')->where('counter_id', Auth::guard('counter')->id())->pluck('id')->toArray();
        foreach ($myTemporaryReservedSeats as $trs) {
            TemporaryReservedSeats::find($trs)->delete();
        }
        $temporaryReservedSeats = TemporaryReservedSeats::where('screen_id', $screen->id)->where('movie_id', $movie->id)->where('show_date', $date)->where('show_time', $time)->where('counter_id', '<>', Auth::guard('counter')->id())->pluck('seat')->toArray();
        $soldSeats = CounterSell::where('screen_id', $screen->id)->where('movie_id', $movie->id)->where('show_date', $date)->where('show_time', $time)->pluck('seat_name')->toArray();
        $companyName = CompanyModel::where('admin_id', Auth::guard('counter')->id())->first()->company_name;
        $companyDisplayName = CompanyModel::where('admin_id', Auth::guard('counter')->id())->first()->company_display_name;
        $companyAddress = CompanyModel::where('admin_id', Auth::guard('counter')->id())->first()->address1;
        return view('counter-management.booking', compact('screen', 'movie', 'date', 'time', 'seatData', 'schedule', 'seatCategories', 'temporaryReservedSeats', 'soldSeats', 'companyName', 'companyAddress', 'companyDisplayName'));
    }


    public function checkBooking(Request $request)
    {
        $data = $request->except('_token');
        $check = TemporaryReservedSeats::where('screen_id', $data['screen_id'])
            ->where('movie_id', $data['movie_id'])
            ->where('show_date', $data['show_date'])
            ->where('show_time', $data['show_time'])
            ->where('seat', $data['seat'])
            ->get();
        if ($check->count() > 0) {
            $seats = TemporaryReservedSeats::where('screen_id', $data['screen_id'])
                ->where('movie_id', $data['movie_id'])
                ->where('show_date', $data['show_date'])
                ->where('show_time', $data['show_time'])
                ->pluck('seat')->toArray();
            $ret = [
                'status' => 'blocked',
                'seats' => $seats
            ];
            return $ret;
        } else {

            $check = CounterSell::where('screen_id', $data['screen_id'])
                ->where('movie_id', $data['movie_id'])
                ->where('show_date', $data['show_date'])
                ->where('show_time', $data['show_time'])
                ->where('seat_name', $data['seat'])
                ->get();

            if ($check->count() > 0) {
                $soldSeats = CounterSell::where('screen_id', $data['screen_id'])
                    ->where('movie_id', $data['movie_id'])
                    ->where('show_date', $data['show_date'])
                    ->where('show_time', $data['show_time'])
                    ->pluck('seat_name')->toArray();
                $ret = [
                    'status' => 'sold',
                    'soldSeats' => $soldSeats
                ];
                return $ret;
            } else {
                $number = mt_rand(10000, 99999);
                $data['unique_hold_id'] = $number . uniqid();
                TemporaryReservedSeats::create($data);
                $ret = [
                    'status' => 'all good',
                    'unique_hold_id' => $data['unique_hold_id']
                ];
                return $ret;
            }
        }
    }


    public function removeBooking(Request $request)
    {
        $data = $request->except('_token');
        $uniqueHoldId = TemporaryReservedSeats::where('screen_id', $data['screen_id'])
            ->where('movie_id', $data['movie_id'])
            ->where('show_date', $data['show_date'])
            ->where('show_time', $data['show_time'])
            ->where('seat', $data['seat'])
            ->first();
        $dataId = $uniqueHoldId->id;
        $holdId = $uniqueHoldId->unique_hold_id;
        TemporaryReservedSeats::find($dataId)->delete();

        return $holdId;
    }

    public function removeHoldData(Request $request)
    {
        $data = $request->all();
        $holdIds = json_decode($data['holdIds'], true);
        $dataIds = TemporaryReservedSeats::whereIn('unique_hold_id', $holdIds)->pluck('id');
        foreach ($dataIds as $id) {
            TemporaryReservedSeats::find($id)->delete();
        }

        return 'true';
    }

    function generateRandomTicketId()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 10; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }
        $checkUniqueQuery = CounterSell::where('ticket_id', $string)->get();
        $countResult = $checkUniqueQuery->count();
        if ($countResult == 0) {
            return strtoupper($string);
        } else {
            $this->generateRandomTicketId();
        }
    }

    function generateUniqueInvoiceNumber()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $index1 = rand(0, 25);
        $index2 = rand(0, 25);
        $stringPartOfInvoice = $characters[$index1] . $characters[$index2];


        $nd = new DateConverter();
        $cal = $nd->eng_to_nep(date('Y'), date('m'), date('d'));
        $nepali_year = $cal['year'];
        $nepali_next_year = ($nepali_year + 1);
        $year1 = substr($nepali_year, -2);
        $year2 = substr($nepali_next_year, -2);
        $yearPartOfInvoice = $year1 . '/' . $year2;


        $randomNumberPartOfInvoice = '';
        for ($i = 0; $i <= 5; $i++) {
            $randomNumberPartOfInvoice .= mt_rand(0, 9);
        }

        $invoice = $stringPartOfInvoice . '-' . $yearPartOfInvoice . '-' . $randomNumberPartOfInvoice;

        $checkUniqueQuery = CounterSellInvoice::where('invoice_number', $invoice)->get();
        $countResult = $checkUniqueQuery->count();
        if ($countResult == 0) {
            return $invoice;
        } else {
            $this->generateUniqueInvoiceNumber();
        }
    }

    function generateUniqueQrCode()
    {
        $code = '';
        for ($i = 0; $i <= 11; $i++) {
            $code .= mt_rand(0, 9);
        }
        $checkUniqueQuery = CounterSell::where('qr_code', $code)->get();
        $countResult = $checkUniqueQuery->count();
        if ($countResult == 0) {
            return $code;
        } else {
            $this->generateUniqueQrCode();
        }
    }

    public function confirmBooking(Request $request)
    {
        $data = $request->except('_token');

        $cnt = 0;
        $html = '';
        $html .= View::make('counter-management.ticket-header')->render();
        $dateConverter = new DateConverter();
        $ticketId = $this->generateRandomTicketId();
        $invoiceNumber = $this->generateUniqueInvoiceNumber();


        for ($i = 0; $i < $data['noOfSeatsChoosed']; $i++) {
            $qrCode = $this->generateUniqueQrCode();

//            data for db
            $dataToDb['ticket_id'] = $ticketId;
            $dataToDb['screen_id'] = $data['screen_id'];
            $dataToDb['movie_id'] = $data['movie_id'];
            $dataToDb['schedule_id'] = $data['schedule_id'];
            $dataToDb['counter_id'] = Auth::guard('counter')->user()->id;
            $dataToDb['show_date'] = $data['show_date'];
            $dataToDb['show_time'] = $data['show_time'];
            $dataToDb['show_day'] = ScheduledMovie::find($data['schedule_id'])->show_day;
            $dataToDb['seat_name'] = $data['seatChoosedName'][$i];
            $dataToDb['seat_category'] = $data['seatChoosedCategory'][$i];
            $dataToDb['seat_price'] = $data['seatChoosedPrice'][$i];
            $dataToDb['invoice_number'] = $invoiceNumber;
            $dataToDb['qr_code'] = $qrCode;

            CounterSell::create($dataToDb);


//            data for tickets


            $cnt++;
            $dataToTicket['ad-date'] = date('d/m/Y h:i A');
            $cal = $dateConverter->eng_to_nep(date('Y'), date('m'), date('d'));
            $nepali_conversion = $cal['year'] . '/' . $cal['month'] . '/' . $cal['date'];
            $dataToTicket['bs-date'] = $nepali_conversion;
            $dataToTicket['payment_mode'] = 'Counter ' . Auth::guard('counter')->user()->counter_number;
            $dataToTicket['sales-person'] = Auth::guard('counter')->user()->username;
            $dataToTicket['seat_category'] = $data['seatChoosedCategory'][$i];
            $dataToTicket['seat_name'] = $data['seatChoosedName'][$i];
            $dataToTicket['show_day'] = ScheduledMovie::find($data['schedule_id'])->show_day;
            $dataToTicket['show_time'] = $data['show_time'];
            $dataToTicket['movie_name'] = MovieModel::find($data['movie_id'])->movie_title;
            $dataToTicket['screen_name'] = Screen::find($data['screen_id'])->name;
            $dataToTicket['show_date'] = $data['show_date'];
            $dataToTicket['seat_price'] = $data['seatChoosedPrice'][$i];
            $dataToTicket['processed_by'] = 'counter';
            $dataToTicket['ticket_id'] = $ticketId;
            $dataToTicket['company_name'] = $data['company_name'];
            $dataToTicket['company_display_name'] = $data['company_display_name'];
            $dataToTicket['company_address'] = $data['company_address'];
            $dataToTicket['movie-genre'] = MovieModel::find($data['movie_id'])->genre;
            $dataToTicket['qr_code'] = $qrCode;
            $html .= View::make('counter-management.ticket', compact('cnt', 'dataToTicket'))->render();
        }

        $invoiceData['counter_id'] = Auth::guard('counter')->id();
        $invoiceData['invoice_number'] = $invoiceNumber;
        $invoiceData['customer_name'] = $data['customer_name'];
        $invoiceData['customer_pan_num'] = $data['customer_pan_num'];
        $invoiceData['gross_total'] = $data['totalPriceOfTic'];
        $invoiceData['payment_mode'] = $data['payment_method'];
        CounterSellInvoice::create($invoiceData);

        $dataToInvoice['company_name'] = $data['company_name'];
        $dataToInvoice['company_address'] = $data['company_address'];
        $dataToInvoice['pan_number'] = CompanyModel::where('admin_id', Auth::guard('counter')->user()->admin_id)->first()->vat_number;
        $dataToInvoice['invoice_number'] = $invoiceNumber;
        $dataToInvoice['invoice_date'] = date('d/m/Y h:i A');
        $dataToInvoice['payment_method'] = $data['payment_method'];
        $cal = $dateConverter->eng_to_nep(date('Y'), date('m'), date('d'));
        $nepali_conversion = $cal['year'] . '/' . $cal['month'] . '/' . $cal['date'];
        $dataToInvoice['invoice_miti'] = $nepali_conversion;
        $dataToInvoice['customer_name'] = $data['customer_name'];
        $dataToInvoice['customer_pan_num'] = $data['customer_pan_num'];
        $dataToInvoice['movie_name'] = MovieModel::find($data['movie_id'])->movie_title;
        $dataToInvoice['seat_categories'] = $data['seatChoosedCategory'];
        $dataToInvoice['seat_prices'] = $data['seatChoosedPrice'];
        $dataToInvoice['gross_total'] = $data['totalPriceOfTic'];

        $dataToInvoice['sales_point'] = $ticketId;

        $dataToInvoice['sales-person'] = Auth::guard('counter')->user()->username;
        $html .= View::make('counter-management.ticket-invoice', compact('dataToInvoice'))->render();


        $html .= View::make('counter-management.ticket-footer')->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0, 0, 226.772, 290.504], 'portrait');
        $pdf->loadHtml($html);
        return $pdf->stream();
    }
}
