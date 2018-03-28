<?php

namespace App\Http\Controllers\CounterManagement;

use App\MovieModel;
use App\ProgrammingModel\ScheduledMovie;
use App\Screen\Screen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        return view('counter-management.booking', compact('screen', 'movie', 'date', 'time', 'seatData', 'schedule', 'seatCategories'));
    }
}
