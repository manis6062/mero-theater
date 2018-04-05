<?php

namespace App\Http\Controllers\Admin\SalesManagement;

use App\BookingModel\CounetrReservation;
use App\BookingModel\CounterSell;
use App\BookingModel\TemporaryReservedSeats;
use App\CompanyModel;
use App\MovieModel;
use App\ProgrammingModel\ScheduledMovie;
use App\Screen\Screen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SoldController extends Controller
{
    public function index(Request $request)
    {
        if(!isset($request->screen))
        {
            $screens = Screen::orderBy('screen_number', 'ASC')->get();
            $activeScreen = Screen::orderBy('screen_number', 'ASC')->first();
            $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->get();
            $schedules = $schedules->sortBy('converted_time');

            $soldReports = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->pluck('movie_id');
            $soldReports = $soldReports->unique();
            $seatCategoryData = [];
            $alphabets = range('A','Z');
            $screenSeatCategories = $activeScreen->screenSeatCategories;
            foreach ($screenSeatCategories as $screenSeatCategory)
            {
                $putData['category_name'] = $screenSeatCategory->category_name;
                $startingRow = array_search($screenSeatCategory->category_from_row, $alphabets);
                $endingRow = array_search($screenSeatCategory->category_to_row, $alphabets);
                $inactiveSeatArray = json_decode($activeScreen->screenSeats->path, true);
                $count = 0;
                if($startingRow < $endingRow)
                {
                    for($i = ($startingRow+1); $i <= ($endingRow+1); $i++)
                    {
                        for($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++)
                        {
                            if(!in_array($i.'-'.$j, $inactiveSeatArray))
                            {
                                $count++;
                            }
                        }
                    }
                }else{
                    for($i = ($endingRow+1); $i <= ($startingRow+1); $i++)
                    {
                        for($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++)
                        {
                            if(!in_array($i.'-'.$j, $inactiveSeatArray))
                            {
                                $count++;
                            }
                        }
                    }
                }

                $putData['category_total_seats'] = $count;
                $seatCategoryData[] = $putData;
            }

            $totalCounterSell = CounterSell::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();
            $totalOverallSell = CounterSell::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();

        }else{
            if(isset($request->range))
            {
                $range = $request->range;
                if($range == 'daily')
                {
                    $screens = Screen::orderBy('screen_number', 'ASC')->get();
                    $activeScreen = Screen::find($request->screen);
                    $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->get();
                    $schedules = $schedules->sortBy('converted_time');
                    $soldReports = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->pluck('movie_id');
                    $soldReports = $soldReports->unique();
                    $seatCategoryData = [];
                    $alphabets = range('A','Z');
                    $screenSeatCategories = $activeScreen->screenSeatCategories;
                    foreach ($screenSeatCategories as $screenSeatCategory)
                    {
                        $putData['category_name'] = $screenSeatCategory->category_name;
                        $startingRow = array_search($screenSeatCategory->category_from_row, $alphabets);
                        $endingRow = array_search($screenSeatCategory->category_to_row, $alphabets);
                        $inactiveSeatArray = json_decode($activeScreen->screenSeats->path, true);
                        $count = 0;
                        if($startingRow < $endingRow)
                        {
                            for($i = ($startingRow+1); $i <= ($endingRow+1); $i++)
                            {
                                for($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++)
                                {
                                    if(!in_array($i.'-'.$j, $inactiveSeatArray))
                                    {
                                        $count++;
                                    }
                                }
                            }
                        }else{
                            for($i = ($endingRow+1); $i <= ($startingRow+1); $i++)
                            {
                                for($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++)
                                {
                                    if(!in_array($i.'-'.$j, $inactiveSeatArray))
                                    {
                                        $count++;
                                    }
                                }
                            }
                        }

                        $putData['category_total_seats'] = $count;
                        $seatCategoryData[] = $putData;
                    }
                    $totalCounterSell = CounterSell::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();
                    $totalOverallSell = CounterSell::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();

                }elseif($range == 'custom-date'){
                    $reqData = $request->all();
                    $startDate = $reqData['start-date'];
                    $endDate = $reqData['end-date'];
                    $screens = Screen::orderBy('screen_number', 'ASC')->get();
                    $activeScreen = Screen::find($request->screen);
                    $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->get();
                    $schedules = $schedules->sortBy('converted_time');
                    $soldReports = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->pluck('movie_id');
                    $soldReports = $soldReports->unique();
                    $seatCategoryData = [];
                    $alphabets = range('A','Z');
                    $screenSeatCategories = $activeScreen->screenSeatCategories;
                    foreach ($screenSeatCategories as $screenSeatCategory)
                    {
                        $putData['category_name'] = $screenSeatCategory->category_name;
                        $startingRow = array_search($screenSeatCategory->category_from_row, $alphabets);
                        $endingRow = array_search($screenSeatCategory->category_to_row, $alphabets);
                        $inactiveSeatArray = json_decode($activeScreen->screenSeats->path, true);
                        $count = 0;
                        if($startingRow < $endingRow)
                        {
                            for($i = ($startingRow+1); $i <= ($endingRow+1); $i++)
                            {
                                for($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++)
                                {
                                    if(!in_array($i.'-'.$j, $inactiveSeatArray))
                                    {
                                        $count++;
                                    }
                                }
                            }
                        }else{
                            for($i = ($endingRow+1); $i <= ($startingRow+1); $i++)
                            {
                                for($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++)
                                {
                                    if(!in_array($i.'-'.$j, $inactiveSeatArray))
                                    {
                                        $count++;
                                    }
                                }
                            }
                        }

                        $putData['category_total_seats'] = $count;
                        $seatCategoryData[] = $putData;
                    }
                    $totalCounterSell = CounterSell::where('screen_id', $activeScreen->id)->whereBetween('show_date',[$startDate, $endDate])->count();
                    $totalOverallSell = CounterSell::where('screen_id', $activeScreen->id)->whereBetween('show_date',[$startDate, $endDate])->count();


                }else{
                    $reqData = $request->all();
                    $startDate = $reqData['start-date'];
                    $endDate = $reqData['end-date'];
                    $screens = Screen::orderBy('screen_number', 'ASC')->get();
                    $activeScreen = Screen::find($request->screen);
                    $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->get();
                    $schedules = $schedules->sortBy('converted_time');
                    $soldReports = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->pluck('movie_id');
                    $soldReports = $soldReports->unique();
                    $seatCategoryData = [];
                    $alphabets = range('A','Z');
                    $screenSeatCategories = $activeScreen->screenSeatCategories;
                    foreach ($screenSeatCategories as $screenSeatCategory)
                    {
                        $putData['category_name'] = $screenSeatCategory->category_name;
                        $startingRow = array_search($screenSeatCategory->category_from_row, $alphabets);
                        $endingRow = array_search($screenSeatCategory->category_to_row, $alphabets);
                        $inactiveSeatArray = json_decode($activeScreen->screenSeats->path, true);
                        $count = 0;
                        if($startingRow < $endingRow)
                        {
                            for($i = ($startingRow+1); $i <= ($endingRow+1); $i++)
                            {
                                for($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++)
                                {
                                    if(!in_array($i.'-'.$j, $inactiveSeatArray))
                                    {
                                        $count++;
                                    }
                                }
                            }
                        }else{
                            for($i = ($endingRow+1); $i <= ($startingRow+1); $i++)
                            {
                                for($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++)
                                {
                                    if(!in_array($i.'-'.$j, $inactiveSeatArray))
                                    {
                                        $count++;
                                    }
                                }
                            }
                        }

                        $putData['category_total_seats'] = $count;
                        $seatCategoryData[] = $putData;
                    }
                    $totalCounterSell = CounterSell::where('screen_id', $activeScreen->id)->whereBetween('show_date',[$startDate, $endDate])->count();
                    $totalOverallSell = CounterSell::where('screen_id', $activeScreen->id)->whereBetween('show_date',[$startDate, $endDate])->count();

                }
            }else{
                $screens = Screen::orderBy('screen_number', 'ASC')->get();
                $activeScreen = Screen::orderBy('screen_number', 'ASC')->first();
                $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->get();
                $schedules = $schedules->sortBy('converted_time');

                $soldReports = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->pluck('movie_id');
                $soldReports = $soldReports->unique();
                $seatCategoryData = [];
                $alphabets = range('A','Z');
                $screenSeatCategories = $activeScreen->screenSeatCategories;
                foreach ($screenSeatCategories as $screenSeatCategory)
                {
                    $putData['category_name'] = $screenSeatCategory->category_name;
                    $startingRow = array_search($screenSeatCategory->category_from_row, $alphabets);
                    $endingRow = array_search($screenSeatCategory->category_to_row, $alphabets);
                    $inactiveSeatArray = json_decode($activeScreen->screenSeats->path, true);
                    $count = 0;
                    if($startingRow < $endingRow)
                    {
                        for($i = ($startingRow+1); $i <= ($endingRow+1); $i++)
                        {
                            for($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++)
                            {
                                if(!in_array($i.'-'.$j, $inactiveSeatArray))
                                {
                                    $count++;
                                }
                            }
                        }
                    }else{
                        for($i = ($endingRow+1); $i <= ($startingRow+1); $i++)
                        {
                            for($j = 1; $j <= $activeScreen->screenSeats->num_columns; $j++)
                            {
                                if(!in_array($i.'-'.$j, $inactiveSeatArray))
                                {
                                    $count++;
                                }
                            }
                        }
                    }

                    $putData['category_total_seats'] = $count;
                    $seatCategoryData[] = $putData;
                }

                $totalCounterSell = CounterSell::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();
                $totalOverallSell = CounterSell::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();
            }
        }


        $chartData['q1'] = CounterSell::where('screen_id', $activeScreen->id)->whereBetween('show_date', [new Carbon('first day of this month'), new Carbon('last day of this month')])->count();
        $chartData['q2'] = CounterSell::where('screen_id', $activeScreen->id)->whereBetween('show_date', [new Carbon('first day of -1 month'), new Carbon('last day of -1 month')])->count();
        $chartData['q3'] = CounterSell::where('screen_id', $activeScreen->id)->whereBetween('show_date', [new Carbon('first day of -2 month'), new Carbon('last day of -2 month')])->count();
        $chartData['q4'] = CounterSell::where('screen_id', $activeScreen->id)->whereBetween('show_date', [new Carbon('first day of -3 month'), new Carbon('last day of -3 month')])->count();

        return view('admin.sales-management.sold-report', compact('screens', 'soldReports', 'activeScreen', 'schedules', 'seatCategoryData', 'totalOverallSell', 'totalCounterSell', 'chartData'));
    }


    public function viewSeat(Request $request)
    {
        $data = $request->all();
        $screen = Screen::find($data['screen']);
        $movie = MovieModel::find($data['movie']);
        $date = $data['date'];
        $time = $data['time'];
        $seatData = $screen->screenSeats;
        $schedule = ScheduledMovie::find($data['schedule']);
        $seatCategories = $screen->screenSeatCategories;
        $temporaryReservedSeats = TemporaryReservedSeats::where('screen_id', $screen->id)->where('movie_id', $movie->id)->where('show_date', $date)->where('show_time', $time)->pluck('seat')->toArray();
        $soldSeats = CounterSell::where('screen_id', $screen->id)->where('movie_id', $movie->id)->where('show_date', $date)->where('show_time', $time)->pluck('seat_name')->toArray();
        $reservedSeats = CounetrReservation::where('screen_id', $screen->id)->where('movie_id', $movie->id)->where('show_date', $date)->where('show_time', $time)->pluck('seat_name')->toArray();
        return view('admin.sales-management.view-seat', compact('screen', 'movie', 'date', 'time', 'seatData', 'schedule', 'seatCategories', 'temporaryReservedSeats', 'soldSeats', 'reservedSeats'));
    }
}
