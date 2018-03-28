<?php

namespace App\Http\Controllers\CounterManagement;

use App\MovieModel;
use App\ProgrammingModel\ScheduledMovie;
use App\Screen\Screen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if(!isset($request->movie))
        {
            if(!isset($request->screen) && !isset($request->date))
            {
                $movies = MovieModel::where('status', 'active')->orderBy('displaysequence', 'ASC')->get();
                $screens = Screen::orderBy('screen_number', 'ASC')->get();
                $todayCollection = \App\ProgrammingModel\ScheduledMovie::where('show_date', date('Y-m-d'))->orderBy('id', 'ASC')->get();
                $todaySchedules = collect();
                $arrayForTimeAndId = collect();
                foreach ($todayCollection as $tc)
                {
                    $arrayForTimeAndId->push(['start_show_time' => date('H:i', strtotime($tc->show_time_start)), 'id' => $tc->id]);
                }
                $arrayForTimeAndId = $arrayForTimeAndId->sortBy('start_show_time');
                foreach($arrayForTimeAndId as $afti)
                {
                    $todaySchedules->push(ScheduledMovie::find($afti['id']));
                }
                return view('counter-management.dashboard', compact('screens', 'todaySchedules', 'movies'));
            }else{
                $movies = MovieModel::where('status', 'active')->orderBy('displaysequence', 'ASC')->get();
                if($request->screen == 'all')
                {
                    $screens = Screen::orderBy('screen_number', 'ASC')->get();
                    $todayCollection = \App\ProgrammingModel\ScheduledMovie::where('show_date', $request->date)->orderBy('show_time_start', 'ASC')->get();
                    $todaySchedules = collect();
                    $arrayForTimeAndId = collect();
                    foreach ($todayCollection as $tc)
                    {
                        $arrayForTimeAndId->push(['start_show_time' => date('H:i', strtotime($tc->show_time_start)), 'id' => $tc->id]);
                    }
                    $arrayForTimeAndId = $arrayForTimeAndId->sortBy('start_show_time');
                    foreach($arrayForTimeAndId as $afti)
                    {
                        $todaySchedules->push(ScheduledMovie::find($afti['id']));
                    }

                    return view('counter-management.dashboard', compact('screens', 'todaySchedules', 'movies'));
                }else{
                    $screens = Screen::orderBy('screen_number', 'ASC')->get();
                    $todayCollection = \App\ProgrammingModel\ScheduledMovie::where('show_date', $request->date)->where('screen_id', $request->screen)->orderBy('id', 'ASC')->get();
                    $todaySchedules = collect();
                    $arrayForTimeAndId = collect();
                    foreach ($todayCollection as $tc)
                    {
                        $arrayForTimeAndId->push(['start_show_time' => date('H:i', strtotime($tc->show_time_start)), 'id' => $tc->id]);
                    }
                    $arrayForTimeAndId = $arrayForTimeAndId->sortBy('start_show_time');
                    foreach($arrayForTimeAndId as $afti)
                    {
                        $todaySchedules->push(ScheduledMovie::find($afti['id']));
                    }
                    return view('counter-management.dashboard', compact('screens', 'todaySchedules', 'movies'));
                }

            }
        }else{
            $movies = MovieModel::where('status', 'active')->orderBy('displaysequence', 'ASC')->get();
            if($request->screen == 'all')
            {
                $screens = Screen::orderBy('screen_number', 'ASC')->get();
                $todayCollection = \App\ProgrammingModel\ScheduledMovie::where('show_date', $request->date)->where('movie_id', $request->movie)->orderBy('show_time_start', 'ASC')->get();
                $todaySchedules = collect();
                $arrayForTimeAndId = collect();
                foreach ($todayCollection as $tc)
                {
                    $arrayForTimeAndId->push(['start_show_time' => date('H:i', strtotime($tc->show_time_start)), 'id' => $tc->id]);
                }
                $arrayForTimeAndId = $arrayForTimeAndId->sortBy('start_show_time');
                foreach($arrayForTimeAndId as $afti)
                {
                    $todaySchedules->push(ScheduledMovie::find($afti['id']));
                }

                return view('counter-management.dashboard', compact('screens', 'todaySchedules', 'movies'));
            }else{
                $screens = Screen::orderBy('screen_number', 'ASC')->get();
                $todayCollection = \App\ProgrammingModel\ScheduledMovie::where('show_date', $request->date)->where('screen_id', $request->screen)->where('movie_id', $request->movie)->orderBy('id', 'ASC')->get();
                $todaySchedules = collect();
                $arrayForTimeAndId = collect();
                foreach ($todayCollection as $tc)
                {
                    $arrayForTimeAndId->push(['start_show_time' => date('H:i', strtotime($tc->show_time_start)), 'id' => $tc->id]);
                }
                $arrayForTimeAndId = $arrayForTimeAndId->sortBy('start_show_time');
                foreach($arrayForTimeAndId as $afti)
                {
                    $todaySchedules->push(ScheduledMovie::find($afti['id']));
                }
                return view('counter-management.dashboard', compact('screens', 'todaySchedules', 'movies'));
            }
        }
    }
}
