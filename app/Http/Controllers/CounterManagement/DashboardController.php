<?php

namespace App\Http\Controllers\CounterManagement;

use App\ProgrammingModel\ScheduledMovie;
use App\Screen\Screen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if(!isset($request->screen) && !isset($request->date))
        {
            $screens = Screen::orderBy('screen_number', 'ASC')->get();
            $todaySchedules = \App\ProgrammingModel\ScheduledMovie::where('show_date', date('Y-m-d'))->orderBy('show_time_start', 'DESC')->get();
            return view('counter-management.dashboard', compact('screens', 'todaySchedules'));
        }else{
            if($request->screen == 'all')
            {
                $screens = Screen::orderBy('screen_number', 'ASC')->get();
                $todaySchedules = \App\ProgrammingModel\ScheduledMovie::where('show_date', $request->date)->orderBy('show_time_start', 'DESC')->get();
                return view('counter-management.dashboard', compact('screens', 'todaySchedules'));
            }else{
                $screens = Screen::orderBy('screen_number', 'ASC')->get();
                $todaySchedules = \App\ProgrammingModel\ScheduledMovie::where('show_date', $request->date)->where('screen_id', $request->screen)->orderBy('show_time_start', 'DESC')->get();
                return view('counter-management.dashboard', compact('screens', 'todaySchedules'));
            }

        }

    }
}
