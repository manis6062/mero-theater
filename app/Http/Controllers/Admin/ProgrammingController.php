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

        if (count($params) == 1) {
            foreach (PriceCard::where('admin_id', Auth::guard('admin')->user()->id)->get() as $pc) {
                $priceCardScreenArr = json_decode($pc->screen_ids, true);
                if (in_array($params[0], $priceCardScreenArr)) {
                    array_push($pcArr, $pc->name);
                }
            }

            return array_values(array_unique($pcArr, SORT_REGULAR));
        } else {
            foreach (PriceCard::where('admin_id', Auth::guard('admin')->user()->id)->get() as $pc) {
                $priceCardScreenArr = json_decode($pc->screen_ids, true);

                array_push($pcArr, $pc->name);
            }
            return array_values(array_unique($pcArr, SORT_REGULAR));
        }


//        foreach (PriceCard::where('admin_id', Auth::guard('admin')->user()->id)->get() as $pc) {
//            $priceCardScreenArr = json_decode($pc->screen_ids, true);
//            if (count($priceCardScreenArr) > 0) {
//                if(count($params) == 1)
//                {
//                    if(in_array($params[0], $priceCardScreenArr))
//                    {
//                        $pcArr[] = $pc->name;
//                    }
//                }else{
//                    $check = 0;
//                    for($i = 0; $i < count($params); $i++)
//                    {
//
//                    }
//                    foreach ($params as $param)
//                    {
//                        if(!in_array($param, $priceCardScreenArr))
//                        {
//                            $check = 1;
//                            break;
//                        }
//                    }
//                    if ($check == 0) {
//                        $pcArr[] = $pc->name;
//                    }
//                }
//
//            }
//
//        }

        return array_unique($pcArr);
    }

    public function submit(Request $request)
    {
        $data = $request->except('_token');
        $screenIdArray = [];
        foreach ($data['screen_id'] as $sid)
        {
            if($sid != 'all')
            {
                $screenIdArray[] = $sid;
            }
        }

        if(count($screenIdArray) > 0)
        {
            $screenIdEncoded = json_encode($screenIdArray);
            $priceCardData = PriceCard::where('name', $data['price_card'])->where('admin_id', Auth::guard('admin')->user()->id)->where('screen_ids', $screenIdEncoded)->get();
            dd($priceCardData);
        }
    }

}
