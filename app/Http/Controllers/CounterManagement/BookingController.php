<?php

namespace App\Http\Controllers\CounterManagement;

use App\BookingModel\TemporaryReservedSeats;
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
        $temporaryReservedSeats = TemporaryReservedSeats::where('screen_id', $screen->id)->where('movie_id', $movie->id)->where('show_date', $date)->where('show_time', $time)->pluck('seat')->toArray();
        return view('counter-management.booking', compact('screen', 'movie', 'date', 'time', 'seatData', 'schedule', 'seatCategories', 'temporaryReservedSeats'));
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
        if($check->count() > 0)
        {
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
        }

        else{
            $number = mt_rand(10000, 99999);
            $data['unique_hold_id'] = $number.uniqid();
            TemporaryReservedSeats::create($data);
            $ret = [
                'status' => 'all good',
                'unique_hold_id' => $data['unique_hold_id']
            ];
            return $ret;
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
        foreach ($dataIds as $id)
        {
            TemporaryReservedSeats::find($id)->delete();
        }

        return 'true';
    }
}
