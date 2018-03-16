<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MovieModel;
use App\PriceCardModel\PriceCard;
use App\Screen\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgrammingController extends Controller
{
    public function index()
    {
        $films = MovieModel::where('status', 'active')->get();
        $screens = Screen::where('admin_id', Auth::guard('admin')->user()->id)->orderBy('screen_number', 'ASC')->get();
        $priceCards = PriceCard::orderBy('sequences', 'ASC')->get();
        return view('admin.programming.index', compact('films', 'screens', 'priceCards'));
    }

    public function addShow()
    {
        $films = MovieModel::where('status', 'active')->get();
        $screens = Screen::where('admin_id', Auth::guard('admin')->user()->id)->orderBy('screen_number', 'ASC')->get();
        $priceCards = PriceCard::orderBy('sequences', 'ASC')->get();
        return view('admin.programming.add-show', compact('films', 'screens', 'priceCards'));
    }

    public function getPriceCards(Request $request)
    {
        $params = json_decode($request->screenIds, true);
        $pcArr = [];
        $sendPcArr = [];

        foreach (PriceCard::all() as $pc) {
            $priceCardScreenArr = json_decode($pc->screen_ids, true);
            if (count($priceCardScreenArr) > 0) {
                if(count($params) == 1)
                {
                    if(in_array($params[0], $priceCardScreenArr))
                    {
                        $pcArr[] = $pc->name;
                    }
                }else{
                    $check = 0;
                    foreach ($params as $param)
                    {
                        if(!in_array($param, $priceCardScreenArr))
                        {
                            $check = 1;
                        }
                    }
                    if ($check == 0) {
                        $pcArr[] = $pc->name;
                    }
                }

            }

        }

        return array_unique($pcArr);
    }

}
