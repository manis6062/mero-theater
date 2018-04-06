<?php

namespace App\Http\Controllers\Admin\SalesManagement;

use App\BookingModel\CounetrReservation;
use App\BookingModel\CounterSell;
use App\BookingModel\TemporaryReservedSeats;
use App\MovieModel;
use App\ProgrammingModel\ScheduledMovie;
use App\Screen\Screen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->action)) {

            if (!isset($request->screen)) {
                $screens = Screen::orderBy('screen_number', 'ASC')->get();
                $activeScreen = Screen::orderBy('screen_number', 'ASC')->first();
                $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->get();
                $schedules = $schedules->sortBy('converted_time');

                $scheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->pluck('movie_id');
                $scheduledMovies = $scheduledMovies->unique();
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

                $totalCounterReservation = CounetrReservation::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();
                $totalOverallReservation = CounetrReservation::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();

            } else {
                if (isset($request->range)) {
                    $range = $request->range;
                    if ($range == 'daily') {
                        $screens = Screen::orderBy('screen_number', 'ASC')->get();
                        $activeScreen = Screen::find($request->screen);
                        $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->get();
                        $schedules = $schedules->sortBy('converted_time');
                        $scheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->pluck('movie_id');
                        $scheduledMovies = $scheduledMovies->unique();
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
                        $totalCounterReservation = CounetrReservation::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();
                        $totalOverallReservation = CounetrReservation::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();

                    } elseif ($range == 'custom-date') {
                        $reqData = $request->all();
                        $startDate = $reqData['start-date'];
                        $endDate = $reqData['end-date'];
                        $screens = Screen::orderBy('screen_number', 'ASC')->get();
                        $activeScreen = Screen::find($request->screen);
                        $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->get();
                        $schedules = $schedules->sortBy('converted_time');
                        $scheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->pluck('movie_id');
                        $scheduledMovies = $scheduledMovies->unique();
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
                        $totalCounterReservation = CounetrReservation::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->count();
                        $totalOverallReservation = CounetrReservation::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->count();


                    } else {
                        $reqData = $request->all();
                        $startDate = $reqData['start-date'];
                        $endDate = $reqData['end-date'];
                        $screens = Screen::orderBy('screen_number', 'ASC')->get();
                        $activeScreen = Screen::find($request->screen);
                        $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->get();
                        $schedules = $schedules->sortBy('converted_time');
                        $scheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->pluck('movie_id');
                        $scheduledMovies = $scheduledMovies->unique();
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
                        $totalCounterReservation = CounetrReservation::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->count();
                        $totalOverallReservation = CounetrReservation::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->count();

                    }
                } else {
                    $screens = Screen::orderBy('screen_number', 'ASC')->get();
                    $activeScreen = Screen::orderBy('screen_number', 'ASC')->first();
                    $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->get();
                    $schedules = $schedules->sortBy('converted_time');

                    $scheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->pluck('movie_id');
                    $scheduledMovies = $scheduledMovies->unique();
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

                    $totalCounterReservation = CounetrReservation::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();
                    $totalOverallReservation = CounetrReservation::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->count();
                }
            }


            $chartData['q1'] = CounetrReservation::where('screen_id', $activeScreen->id)->whereBetween('show_date', [new Carbon('first day of this month'), new Carbon('last day of this month')])->count();
            $chartData['q2'] = CounetrReservation::where('screen_id', $activeScreen->id)->whereBetween('show_date', [new Carbon('first day of -1 month'), new Carbon('last day of -1 month')])->count();
            $chartData['q3'] = CounetrReservation::where('screen_id', $activeScreen->id)->whereBetween('show_date', [new Carbon('first day of -2 month'), new Carbon('last day of -2 month')])->count();
            $chartData['q4'] = CounetrReservation::where('screen_id', $activeScreen->id)->whereBetween('show_date', [new Carbon('first day of -3 month'), new Carbon('last day of -3 month')])->count();

            return view('admin.sales-management.reservation-report', compact('screens', 'scheduledMovies', 'activeScreen', 'schedules', 'seatCategoryData', 'totalOverallReservation', 'totalCounterReservation', 'chartData'));

        } else {
            $reportingArray = [];
            $array = [];
            if (!isset($request->screen)) {
                $activeScreen = Screen::orderBy('screen_number', 'ASC')->first();
                $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->get();
                $schedules = $schedules->sortBy('converted_time');
                $scheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->pluck('movie_id');
                $scheduledMovies = $scheduledMovies->unique();
            } else {
                $activeScreen = Screen::find($request->screen);
                if (isset($request->range)) {
                    $range = $request->range;
                    if ($range == 'daily') {
                        $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->get();
                        $schedules = $schedules->sortBy('converted_time');
                        $scheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->pluck('movie_id');
                        $scheduledMovies = $scheduledMovies->unique();
                    } elseif ($range == 'custom-date') {
                        $reqData = $request->all();
                        $startDate = $reqData['start-date'];
                        $endDate = $reqData['end-date'];
                        $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->get();
                        $schedules = $schedules->sortBy('converted_time');
                        $scheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->pluck('movie_id');
                        $scheduledMovies = $scheduledMovies->unique();
                    } else {
                        $reqData = $request->all();
                        $startDate = $reqData['start-date'];
                        $endDate = $reqData['end-date'];
                        $screens = Screen::orderBy('screen_number', 'ASC')->get();
                        $activeScreen = Screen::find($request->screen);
                        $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->get();
                        $schedules = $schedules->sortBy('converted_time');
                        $scheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->whereBetween('show_date', [$startDate, $endDate])->pluck('movie_id');
                        $scheduledMovies = $scheduledMovies->unique();
                    }
                } else {
                    $activeScreen = Screen::orderBy('screen_number', 'ASC')->first();
                    $schedules = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->get();
                    $schedules = $schedules->sortBy('converted_time');

                    $scheduledMovies = ScheduledMovie::where('screen_id', $activeScreen->id)->where('show_date', date('Y-m-d'))->pluck('movie_id');
                    $scheduledMovies = $scheduledMovies->unique();
                }
            }

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


            $sn = 0;
            if (isset($scheduledMovies) && $scheduledMovies->count() > 0) {
                foreach ($scheduledMovies as $scheduledMovie) {
                    foreach ($schedules as $schedule) {
                        if ($scheduledMovie == $schedule->movie_id) {
                            $sn += 1;
                            $array['S.N.'] = $sn;
                            $array['Show'] = \App\MovieModel::find($scheduledMovie)->movie_title;
                            $array['Screen'] = $activeScreen->name . ' (' . $schedule->show_time_start . ')';
                            $array['Show Date'] = $schedule->show_date;
                            if (count($seatCategoryData) != 0) {
                                foreach ($seatCategoryData as $seatCategoryDatum) {
                                    if (!isset($request->range) || (isset($request->range) && $request->range == 'daily')) {
                                        $array[$seatCategoryDatum['category_name']] = \App\BookingModel\CounetrReservation::where('screen_id', $activeScreen->id)->where('schedule_id', $schedule->id)->where('seat_category', $seatCategoryDatum['category_name'])->whereDate('show_date', date('Y-m-d'))->count() . ' ( ' . $seatCategoryDatum['category_total_seats'] . ' )';
                                    } else {
                                        $dates = $request->all();
                                        $array[$seatCategoryDatum['category_name']] = \App\BookingModel\CounetrReservation::where('screen_id', $activeScreen->id)->where('schedule_id', $schedule->id)->where('seat_category', $seatCategoryDatum['category_name'])->whereBetween('show_date', [$dates['start-date'], $dates['end-date']])->count() . ' ( ' . $seatCategoryDatum['category_total_seats'] . ' )';
                                    }
                                }
                            }
                            $reportingArray[] = $array;
                        }
                    }
                }
            }

            \Excel::create($activeScreen->name . ' - Reservation Report', function ($excel) use ($reportingArray, $activeScreen, $seatCategoryData) {

                $excel->setTitle($activeScreen->name . ' - Reservation Report');
                $excel->setDescription($activeScreen->name . ' - Reservation Report');

                $excel->sheet('Excel Sheet', function ($sheet) use ($reportingArray, $seatCategoryData) {
                    foreach ($reportingArray as $array) {
                        $sheet->appendRow($array);
                    }
                    $style = array(
                        'alignment' => array(
                            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        )
                    );
                    $categories = [];
                    $categories[] = 'S.N.';
                    $categories[] = 'Show';
                    $categories[] = 'Screen';
                    $categories[] = 'Show Date';
                    foreach ($seatCategoryData as $categoryDatum) {
                        $categories[] = $categoryDatum['category_name'];
                    }
                    $sheet->prependRow($categories);
                    $sheet->row(1, function ($row) {
                        $row->setFontFamily('Roboto Sans Serif');
                        $row->setFontSize(20);
                    });
                    $sheet->getStyle()->applyFromArray($style);
                });

            })->export('xls');
        }
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
