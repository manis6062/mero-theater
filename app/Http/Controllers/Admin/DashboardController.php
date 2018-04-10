<?php

namespace App\Http\Controllers\Admin;

use App\BookingModel\CounetrReservation;
use App\BookingModel\CounterSell;
use App\ProgrammingModel\ScheduledMovie;
use App\Screen\Screen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use View;

class DashboardController extends Controller
{	
    function index(Request $request)
    {
        if($request->ajax())
        {
            $screens = Screen::orderBy('screen_number', 'ASC')->get();

            if(!isset($request->screen))
                $activeScreen = Screen::orderBy('screen_number', 'ASC')->first();
            else{
                $activeScreen = Screen::find($request->screen);
            }
            $transactionData = CounterSell::where('screen_id', $activeScreen->id)->orderBy('id', 'DESC')->paginate('10');

            return View::make('admin.dashboard.transaction-log', compact('transactionData'))->render();
        }else{
            $screens = Screen::orderBy('screen_number', 'ASC')->get();

            if(!isset($request->screen))
                $activeScreen = Screen::orderBy('screen_number', 'ASC')->first();
            else{
                $activeScreen = Screen::find($request->screen);
            }

            $startDateOfMonth = new Carbon('first day of this month');
            $lastDateOfMonth = new Carbon('last day of this month');
            $totalVisitorsSell = CounterSell::where('screen_id', $activeScreen->id)->whereBetween('created_at', [$startDateOfMonth, $lastDateOfMonth])->count();
            $totalVisitorsReserve = CounetrReservation::where('screen_id', $activeScreen->id)->whereBetween('created_at', [$startDateOfMonth, $lastDateOfMonth])->count();
            $totalVisitors = $totalVisitorsSell + $totalVisitorsReserve;




            $startDateOfLastMonth = new Carbon('first day of -1 month');
            $lastDateOfLastMonth = new Carbon('last day of -1 month');
            $totalVisitorsSellLastMonth = CounterSell::where('screen_id', $activeScreen->id)->whereBetween('created_at', [$startDateOfLastMonth, $lastDateOfLastMonth])->count();
            $totalVisitorsReserveLastMonth = CounetrReservation::where('screen_id', $activeScreen->id)->whereBetween('created_at', [$startDateOfLastMonth, $lastDateOfLastMonth])->count();
            $totalVisitorsLastMonth = $totalVisitorsSellLastMonth + $totalVisitorsReserveLastMonth;


            if($totalVisitorsLastMonth > 0)
            {
                if($totalVisitors > $totalVisitorsLastMonth)
                {
                    $increasedRateOfVisitors = (($totalVisitors - $totalVisitorsLastMonth) * 100) / $totalVisitorsLastMonth;
                    $increasedRateOfVisitors = $increasedRateOfVisitors.'%';
                    $visitorStatus = 'increased';
                }elseif($totalVisitors < $totalVisitorsLastMonth){
                    $increasedRateOfVisitors = (($totalVisitorsLastMonth - $totalVisitors) / $totalVisitorsLastMonth) * 100;
                    $increasedRateOfVisitors = $increasedRateOfVisitors.'%';
                    $visitorStatus = 'decreased';
                }else{
                    $visitorStatus = 'equal';
                }
            }else{
                if($totalVisitors > $totalVisitorsLastMonth)
                {
                    $increasedRateOfVisitors = $totalVisitors - $totalVisitorsLastMonth;
                    $visitorStatus = 'increased';
                }elseif($totalVisitors < $totalVisitorsLastMonth){
                    $increasedRateOfVisitors = $totalVisitorsLastMonth - $totalVisitors;
                    $visitorStatus = 'decreased';
                }else{
                    $visitorStatus = 'equal';
                }
            }


            if($totalVisitorsSellLastMonth > 0)
            {
                if($totalVisitorsSell > $totalVisitorsSellLastMonth)
                {
                    $increasedRateOfOrders = (($totalVisitorsSell - $totalVisitorsSellLastMonth) * 100) / $totalVisitorsSellLastMonth;
                    $increasedRateOfOrders = $increasedRateOfOrders.'%';
                    $orderStatus = 'increased';
                }elseif($totalVisitorsSell < $totalVisitorsSellLastMonth){
                    $increasedRateOfOrders = (($totalVisitorsSellLastMonth - $totalVisitorsSell) / $totalVisitorsSellLastMonth) * 100;
                    $increasedRateOfOrders = $increasedRateOfOrders.'%';
                    $orderStatus = 'decreased';
                }else{
                    $orderStatus = 'equal';
                }

            }else{
                if($totalVisitorsSell > $totalVisitorsSellLastMonth)
                {
                    $increasedRateOfOrders = $totalVisitorsSell - $totalVisitorsSellLastMonth;
                    $orderStatus = 'increased';
                }elseif($totalVisitorsSell < $totalVisitorsSellLastMonth){
                    $increasedRateOfOrders = $totalVisitorsSellLastMonth - $totalVisitorsSell;
                    $orderStatus = 'decreased';
                }else{
                    $orderStatus = 'equal';
                }

            }


            $totalSoldPrice = \DB::table('counter_sells')->where('screen_id', $activeScreen->id)->whereBetween('created_at', [$startDateOfMonth, $lastDateOfMonth])->sum('seat_price');
            $totalSoldAndReservedPrice = $totalSoldPrice + \DB::table('counter_reservations')->where('screen_id', $activeScreen->id)->whereBetween('created_at', [$startDateOfMonth, $lastDateOfMonth])->sum('seat_price');

            $dailySale = \DB::table('counter_sells')->where('screen_id', $activeScreen->id)->whereBetween('created_at', [date('Y-m-d').' 00:00:00', date('Y-m-d').' 23:59:59'])->sum('seat_price');

            $startDateOfThisWeek = new Carbon('first day of this week');
            $lastDateOfThisWeek = new Carbon('last day of this week');
            $weeklySale = \DB::table('counter_sells')->where('screen_id', $activeScreen->id)->whereBetween('created_at', [$startDateOfThisWeek, $lastDateOfThisWeek])->sum('seat_price');


            $monthlySale = \DB::table('counter_sells')->where('screen_id', $activeScreen->id)->whereBetween('created_at', [$startDateOfMonth, $lastDateOfMonth])->sum('seat_price');
            $monthlySaleLastMonth = \DB::table('counter_sells')->where('screen_id', $activeScreen->id)->whereBetween('created_at', [$startDateOfLastMonth, $lastDateOfLastMonth])->sum('seat_price');

            if($monthlySaleLastMonth > 0)
            {
                if($monthlySale > $monthlySaleLastMonth)
                {
                    $increasedMonthlySale = (($monthlySale - $monthlySaleLastMonth) * 100) / $monthlySaleLastMonth;
                    $increasedMonthlySale = $increasedMonthlySale.'%';
                    $monthlySaleStatus = 'increased';
                }elseif($monthlySale < $monthlySaleLastMonth){
                    $increasedMonthlySale = (($monthlySaleLastMonth - $monthlySale) / $monthlySaleLastMonth) * 100;
                    $increasedMonthlySale = $increasedMonthlySale.'%';
                    $monthlySaleStatus = 'decreased';
                }else{
                    $monthlySaleStatus = 'equal';
                }
            }else{
                if($monthlySale > $monthlySaleLastMonth)
                {
                    $increasedMonthlySale = $monthlySale - $monthlySaleLastMonth;
                    $increasedMonthlySale = 'NPR. '.$increasedMonthlySale;
                    $monthlySaleStatus = 'increased';
                }elseif($monthlySale < $monthlySaleLastMonth){
                    $increasedMonthlySale = $monthlySaleLastMonth - $monthlySale;
                    $increasedMonthlySale = 'NPR. '.$increasedMonthlySale;
                    $monthlySaleStatus = 'decreased';
                }else{
                    $monthlySaleStatus = 'equal';
                }
            }

            $totalSchedules = ScheduledMovie::whereDate('show_date', date('Y-m-d'))->where('screen_id', $activeScreen->id)->count();
            $totalSeatOfScreen = $activeScreen->screenSeats->total_seats;
            $totalValueForCounterPieChart = $totalSeatOfScreen * $totalSchedules;

            $sellValueForCounterPieChart = CounterSell::where('screen_id', $activeScreen->id)->whereDate('show_date', date('Y-m-d'))->count();
            $reservationValueForCounterPieChart = CounetrReservation::where('screen_id', $activeScreen->id)->whereDate('show_date', date('Y-m-d'))->count();
            $totalValueForCounterPieChart = $totalValueForCounterPieChart - $sellValueForCounterPieChart - $reservationValueForCounterPieChart;



            $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->get();
            $schedules = $schedules->sortBy('converted_time');
            $todayScheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->pluck('movie_id');
            $todayScheduledMovies = $todayScheduledMovies->unique();
            $seatCategoryData = [];
            $alphabets = range('A', 'Z');
            $screenSeatCategories = $activeScreen->screenSeatCategories;
            foreach ($screenSeatCategories as $screenSeatCategory) {
                $putData['category_name'] = $screenSeatCategory->category_name;
                $startingRow = array_search($screenSeatCategory->category_from_row, $alphabets);
                $endingRow = array_search($screenSeatCategory->category_to_row, $alphabets);
                $inactiveSeatArray = json_decode($activeScreen->screenSeats->path, true);
                $count = 0;
                if ($startingRow < $endingRow) {
                    for ($i = ($startingRow + 1); $i <= ($endingRow + 1); $i++) {
                        for ($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++) {
                            if (!in_array($i . '-' . $j, $inactiveSeatArray)) {
                                $count++;
                            }
                        }
                    }
                } else {
                    for ($i = ($endingRow + 1); $i <= ($startingRow + 1); $i++) {
                        for ($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++) {
                            if (!in_array($i . '-' . $j, $inactiveSeatArray)) {
                                $count++;
                            }
                        }
                    }
                }

                $putData['category_total_seats'] = $count;
                $seatCategoryData[] = $putData;
            }


            $transactionData = CounterSell::where('screen_id', $activeScreen->id)->orderBy('id', 'DESC')->paginate('10');

            return view('admin.dashboard.index', compact('screens', 'totalVisitors', 'totalVisitorsLastMonth', 'increasedRateOfVisitors', 'totalVisitorsSell', 'totalVisitorsSellLastMonth', 'increasedRateOfOrders', 'totalSoldPrice', 'totalSoldAndReservedPrice', 'dailySale', 'weeklySale', 'monthlySale', 'visitorStatus', 'orderStatus', 'increasedMonthlySale', 'monthlySaleStatus', 'totalValueForCounterPieChart', 'sellValueForCounterPieChart', 'reservationValueForCounterPieChart', 'schedules', 'todayScheduledMovies', 'seatCategoryData', 'activeScreen', 'transactionData'));
        }
    }
}
