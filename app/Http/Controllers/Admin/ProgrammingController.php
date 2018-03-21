<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MovieModel;
use App\PriceCardModel\PriceCard;
use App\ProgrammingModel\Program;
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
        $pcArrTime = [];
        $pcr1 = [];
        $sendPcArr = [];

        if (count($params) == 1) {
            foreach (PriceCard::where('admin_id', Auth::guard('admin')->user()->id)->where('screen_ids', $params[0])->get() as $pc) {
                array_push($pcArr, $pc->name);
            }

            return array_values(array_unique($pcArr, SORT_REGULAR));
        } else {
            $cnt = 0;
            foreach ($params as $param)
            {
                foreach (PriceCard::where('admin_id', Auth::guard('admin')->user()->id)->where('screen_ids', $param)->get() as $pc) {
                    if($cnt == 0)
                        array_push($pcArr, $pc->name);
                    else{
                        array_push($pcr1, $pc->name);
                    }
                }
                $sendPcArr = array_intersect($pcArr, $pcr1);
                $cnt++;
            }
            return array_values(array_unique($sendPcArr, SORT_REGULAR));
        }
    }

    public function submit(Request $request)
    {
        $data = $request->except('_token');
        $showDatesArr = [];

        $scheduledData = Program::all();
        foreach ($scheduledData as $sd)
        {
            $decodeDatesArr = json_decode($sd->show_dates, true);

            foreach ($decodeDatesArr as $sda)
            {
                $showDatesArr[] = $sda;
            }
        }

        $choosedDateArray = $data['choosed_show_dates'];
        $check = array_intersect($showDatesArr, $choosedDateArray);
        if (count($check) > 0) {
            $screensArr = [];
            foreach ($scheduledData as $sd)
            {
                $decodeDatesArr = json_decode($sd->show_dates, true);
                $choosedDateArray = $data['choosed_show_dates'];
                $check = array_intersect($showDatesArr, $choosedDateArray);
                if (count($check) > 0) {
                    $decodeScreenArr = json_decode($sd->screen_ids, true);
                    foreach ($decodeScreenArr as $dsa)
                    {
                        $screensArr[] = $dsa;
                    }
                }
            }
            $choosedScreenArr = $data['screen_id'];
            $checkScreen = array_intersect($screensArr, $choosedScreenArr);
            if (count($checkScreen) > 0) {
                foreach ($scheduledData as $sd)
                {
                    $shDt = json_decode($sd->show_dates, true);
                    $scDt = json_decode($sd->screen_ids, true);
                    $choosedScrArr = $data['screen_id'];
                    $choosedDtArray = $data['choosed_show_dates'];

                    $checkDat = array_intersect($shDt, $choosedDtArray);
                    $checkScr = array_intersect($scDt, $choosedScrArr);

                    if (count($checkDat) > 0 && count($checkScr) > 0) {
                        $existingTimeSlots = [];
                        $clnTime = $sd->clean_up_time;
                        $mdur = MovieModel::find($sd->movie_id)->duration;
                        $tdura = ($clnTime+$mdur);
                        $decodeShowTimeArr = json_decode($sd->show_time, true);
                        $conflict = 0;
                        foreach ($decodeShowTimeArr as $dsta)
                        {
                            $alreadyExistingShowTimesStart = $dsta;
                            $alreadyExistingShowTimesEnd = date("G:i", strtotime('+'.$tdura.' minutes', strtotime($alreadyExistingShowTimesStart)));
                            $formChoosedShowTimes = $data['show_time'];
                            $movieDurations = MovieModel::find($data['film'])->duration;
                            $cleanUpDurations = $data['clean_up_time'];
                            $totalDuration = ($movieDurations+$cleanUpDurations);

                            foreach ($formChoosedShowTimes as $fcst)
                            {
                                $stTime = $fcst;
                                $endTime = date("G:i", strtotime('+'.$totalDuration.' minutes', strtotime($stTime)));
                                $date1 = \DateTime::createFromFormat('G:i', $stTime);
                                $date2 = \DateTime::createFromFormat('G:i', $endTime);
                                $date3 = \DateTime::createFromFormat('G:i', $alreadyExistingShowTimesStart);
                                $date4 = \DateTime::createFromFormat('G:i', $alreadyExistingShowTimesEnd);
                                if ($date1 > $date3 && $date1 < $date4)
                                {
                                    $conflict = 1;
                                }

                                if($date2 > $date3 && $date2 < $date4){
                                    $conflict = 1;
                                }
                            }
                        }

                        if($conflict == 1)
                        {
                            dd($conflict);
                        }else{
                            $dataToSave['movie_id'] = $data['film'];
                            $dataToSave['screen_ids'] = json_encode($data['screen_id']);
                            $dataToSave['price_card'] = $data['price_card'];
                            $dataToSave['days'] = json_encode($data['days']);
                            $dataToSave['clean_up_time'] = $data['clean_up_time'];
                            $dataToSave['show_time'] = json_encode($data['show_time']);
                            $dataToSave['sales_via'] = json_encode($data['sales_via']);
                            $dataToSave['show_dates'] = json_encode($data['choosed_show_dates']);
                            $dataToSave['seating'] = $data['seating'];
                            $dataToSave['comps'] = $data['comps'];
                            $dataToSave['status'] = $data['status'];
                            $dataToSave['show_type'] = $data['show_type'];

                            $result = Program::create($dataToSave);
                            if($result)
                            {
                                return redirect()->back()->with('message', 'success');
                            }

                            return redirect()->back()->with('message', 'unsuccess');
                        }
                    }else{
                        $dataToSave['movie_id'] = $data['film'];
                        $dataToSave['screen_ids'] = json_encode($data['screen_id']);
                        $dataToSave['price_card'] = $data['price_card'];
                        $dataToSave['days'] = json_encode($data['days']);
                        $dataToSave['clean_up_time'] = $data['clean_up_time'];
                        $dataToSave['show_time'] = json_encode($data['show_time']);
                        $dataToSave['sales_via'] = json_encode($data['sales_via']);
                        $dataToSave['show_dates'] = json_encode($data['choosed_show_dates']);
                        $dataToSave['seating'] = $data['seating'];
                        $dataToSave['comps'] = $data['comps'];
                        $dataToSave['status'] = $data['status'];
                        $dataToSave['show_type'] = $data['show_type'];

                        $result = Program::create($dataToSave);
                        if($result)
                        {
                            return redirect()->back()->with('message', 'success');
                        }

                        return redirect()->back()->with('message', 'unsuccess');
                    }
                }
            }else{
                $dataToSave['movie_id'] = $data['film'];
                $dataToSave['screen_ids'] = json_encode($data['screen_id']);
                $dataToSave['price_card'] = $data['price_card'];
                $dataToSave['days'] = json_encode($data['days']);
                $dataToSave['clean_up_time'] = $data['clean_up_time'];
                $dataToSave['show_time'] = json_encode($data['show_time']);
                $dataToSave['sales_via'] = json_encode($data['sales_via']);
                $dataToSave['show_dates'] = json_encode($data['choosed_show_dates']);
                $dataToSave['seating'] = $data['seating'];
                $dataToSave['comps'] = $data['comps'];
                $dataToSave['status'] = $data['status'];
                $dataToSave['show_type'] = $data['show_type'];

                $result = Program::create($dataToSave);
                if($result)
                {
                    return redirect()->back()->with('message', 'success');
                }

                return redirect()->back()->with('message', 'unsuccess');
            }
        }else{
            $dataToSave['movie_id'] = $data['film'];
            $dataToSave['screen_ids'] = json_encode($data['screen_id']);
            $dataToSave['price_card'] = $data['price_card'];
            $dataToSave['days'] = json_encode($data['days']);
            $dataToSave['clean_up_time'] = $data['clean_up_time'];
            $dataToSave['show_time'] = json_encode($data['show_time']);
            $dataToSave['sales_via'] = json_encode($data['sales_via']);
            $dataToSave['show_dates'] = json_encode($data['choosed_show_dates']);
            $dataToSave['seating'] = $data['seating'];
            $dataToSave['comps'] = $data['comps'];
            $dataToSave['status'] = $data['status'];
            $dataToSave['show_type'] = $data['show_type'];

            $result = Program::create($dataToSave);
            if($result)
            {
                return redirect()->back()->with('message', 'success');
            }

            return redirect()->back()->with('message', 'unsuccess');
        }

        foreach ($scheduledData as $sd)
        {
            $showDatesArr = json_decode($sd->show_date, true);
            $choosedDateArray = $data['choosed_show_dates'];
            $check = array_intersect($showDatesArr, $choosedDateArray);
            if (count($check) > 0) {
                $screenArr = json_decode($sd->screen_ids, true);
                $choosedScreenArr = json_decode($sd->screen_ids, true);
                $checkScreen = array_intersect($screenArr, $choosedScreenArr);
                if (count($checkScreen) > 0) {

                }else{

                }
            }else{
                $dataToSave['movie_id'] = $data['film'];
                $dataToSave['screen_ids'] = json_encode($data['screen_id']);
                $dataToSave['price_card'] = $data['price_card'];
                $dataToSave['days'] = json_encode($data['days']);
                $dataToSave['clean_up_time'] = $data['clean_up_time'];
                $dataToSave['show_time'] = json_encode($data['show_time']);
                $dataToSave['sales_via'] = json_encode($data['sales_via']);
                $dataToSave['show_dates'] = json_encode($data['choosed_show_dates']);
                $dataToSave['seating'] = $data['seating'];
                $dataToSave['comps'] = $data['comps'];
                $dataToSave['status'] = $data['status'];
                $dataToSave['show_type'] = $data['show_type'];

                $result = Program::create($dataToSave);
                if($result)
                {
                    return redirect()->back()->with('message', 'success');
                }

                return redirect()->back()->with('message', 'unsuccess');
            }

        }

    }


    public function getPriceCardTime(Request $request)
    {
        $pcChoosed = $request->pc;
        $timeRange = PriceCard::where('name', $pcChoosed)->first()->time_range;
        $timeRangeArr = array_map('trim', explode('-', $timeRange));
        $returnData['start_time'] = $timeRangeArr[0];
        $returnData['end_time'] = $timeRangeArr[1];
        return array_values(array_unique($returnData, SORT_REGULAR));
    }

}
