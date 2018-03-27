<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MovieModel;
use App\PriceCardModel\PriceCard;
use App\ProgrammingModel\Program;
use App\ProgrammingModel\ScheduledMovie;
use App\Screen\Screen;
use App\Screen\ScreenSeatCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgrammingController extends Controller
{
    public function index()
    {
        $films = MovieModel::where('status', 'active')->get();
        $screens = Screen::where('admin_id', Auth::guard('admin')->user()->id)->orderBy('screen_number', 'ASC')->get();
        $sendScreeObject = collect();
        foreach ($screens as $screen) {
            if ($screen->screenSeats != null) {
                $alphabetsOfScreen = json_decode($screen->screenSeats->alphabets, true);
                $screenSeatCategories = $screen->screenSeatCategories;
                $screenSeatCategoriesAlphabets = [];

                foreach ($screenSeatCategories as $ssc) {
                    foreach (range($ssc->category_from_row, $ssc->category_to_row) as $alpha) {
                        $screenSeatCategoriesAlphabets[] = $alpha;
                    }
                }
                if (count($screenSeatCategoriesAlphabets) == count($alphabetsOfScreen)) {
                    $sendScreeObject->push($screen);
                }
            }
        }
        $screens = $sendScreeObject;
        if (ScheduledMovie::count() > 0) {
            $today = date('Y-m-d');
            $scheduleData = ScheduledMovie::all();
            $events = [];
            $count = 0;
            foreach ($scheduleData as $sd) {
                $count++;
                $events[] = array(
                    'id' => $count,
                    'title' => MovieModel::find($sd->movie_id)->movie_title,
                    'start' => $sd->show_date . 'T' . date('G:i', strtotime($sd->show_time_start)),
                    'end' => $sd->show_date . 'T' . date('G:i', strtotime($sd->show_time_end)),
                    'unique_id' => $sd->id
                );

            }
        } else {
            $events = null;
        }

        return view('admin.programming.index', compact('films', 'screens', 'events'));
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
            foreach ($params as $param) {
                foreach (PriceCard::where('admin_id', Auth::guard('admin')->user()->id)->where('screen_ids', $param)->get() as $pc) {
                    if ($cnt == 0)
                        array_push($pcArr, $pc->name);
                    else {
                        array_push($pcArr, $pc->name);
                    }
                }
                $cnt++;
            }


            foreach ($pcArr as $pc) {
                $flag = 0;
                foreach ($params as $param) {
                    if (PriceCard::where('admin_id', Auth::guard('admin')->user()->id)->where('screen_ids', $param)->where('name', $pc)->first() == null) {
                        $flag = 1;
                    }
                }
                if ($flag == 0) {
                    array_push($sendPcArr, $pc);
                }
            }
            return array_values(array_unique($sendPcArr, SORT_REGULAR));
        }
    }

    public function submit(Request $request)
    {
        $data = $request->except('_token');
        $movieDuration = MovieModel::find($data['film'])->duration;
        $conflict = 0;
        $conflictedTime = [];

        foreach ($data['choosed_show_dates'] as $csd) {
            foreach ($data['screen_id'] as $sid) {
                foreach (ScheduledMovie::all() as $sd)
                {
                    if($sd->show_date == $csd && $sd->screen_id == $sid)
                    {
                        $conflict = 1;
                        $conflictedTime[] = $sd->total_occupied_time;
                    }
                }
            }
        }

        if($conflict == 0)
        {
            foreach ($data['choosed_show_dates'] as $csd) {
                foreach ($data['show_time'] as $st) {
                    foreach ($data['screen_id'] as $sid) {
                        $totalDuration = MovieModel::find($data['film'])->duration;
                        $shStTi = date('h:i A', strtotime($st));
                        $shEnTi = date("h:i A", strtotime('+' . $totalDuration . ' minutes', strtotime($shStTi)));
                        $totatShowDuration = $shStTi . '-' . date("h:i A", strtotime('+' . $data['clean_up_time'] . ' minutes', strtotime($shEnTi)));
                        $dayOfWeek = strtotime($csd);
                        $dayOfWeek = date("l", $dayOfWeek);
                        $seatCategories = ScreenSeatCategories::where('screen_id', $sid)->get();
                        $catWithPrice = [];
                        foreach ($seatCategories as $seCa) {
                            $arrForSc['category_name'] = $seCa->category_name;
                            $arrForSc['category_price'] = PriceCard::where('name', $data['price_card'])->where('screen_ids', $sid)->where('seat_categories', $arrForSc['category_name'])->first()->prices;
                            $catWithPrice[] = $arrForSc;
                        }


                        $dataToStore['admin_id'] = Auth::guard('admin')->user()->id;
                        $dataToStore['movie_id'] = $data['film'];
                        $dataToStore['screen_id'] = $sid;
                        $dataToStore['show_time_start'] = $shStTi;
                        $dataToStore['show_time_end'] = $shEnTi;
                        $dataToStore['clean_up_time'] = $data['clean_up_time'];
                        $dataToStore['total_occupied_time'] = $totatShowDuration;
                        $dataToStore['show_date'] = $csd;
                        $dataToStore['show_day'] = $dayOfWeek;
                        $dataToStore['price_card_name'] = $data['price_card'];
                        $dataToStore['seat_categories_with_price'] = json_encode($catWithPrice);
                        $dataToStore['sales_via'] = json_encode($data['sales_via']);
                        $dataToStore['seating'] = $data['seating'];
                        $dataToStore['comps'] = $data['comps'];
                        $dataToStore['status'] = $data['status'];
                        $dataToStore['show_type'] = $data['show_type'];

                        $result = ScheduledMovie::create($dataToStore);
                    }
                }
            }

            if ($result)
                return 'success';

            return 'unsuccess';
        }else{
            $timeConflict = 0;
            foreach ($data['show_time'] as $choosedShowTime) {
                $movieDuration = MovieModel::find($data['film'])->duration;
                $choosedShowTimeStart = date('h:i A', strtotime($choosedShowTime));
                $choosedShowTimeEnd = date("h:i A", strtotime('+' . $movieDuration . ' minutes', strtotime($choosedShowTimeStart)));
                $choosedShowTimeEnd = date("h:i A", strtotime('+' . $data['clean_up_time'] . ' minutes', strtotime($choosedShowTimeEnd)));
                foreach ($conflictedTime as $ct)
                {
                    $confictTimeArray = array_map('trim', explode('-', $ct));
                    $conflictTimeStart = $confictTimeArray[0];
                    $conflictTimeEnd = $confictTimeArray[1];

                    $choosedShowStartingTime = \DateTime::createFromFormat('h:i A', $choosedShowTimeStart);
                    $choosedShowEndingTime = \DateTime::createFromFormat('h:i A', $choosedShowTimeEnd);
                    $conflictStartingTime = \DateTime::createFromFormat('h:i A', $conflictTimeStart);
                    $conflictEndingTime = \DateTime::createFromFormat('h:i A', $conflictTimeEnd);
                    if ($choosedShowStartingTime >= $conflictStartingTime && $choosedShowStartingTime <= $conflictEndingTime) {
                        $timeConflict = 1;
                    }

                    if ($choosedShowEndingTime >= $conflictStartingTime && $choosedShowEndingTime <= $conflictEndingTime) {
                        $timeConflict = 1;
                    }
                }
            }

            if($timeConflict == 0)
            {
                foreach ($data['choosed_show_dates'] as $csd) {
                    foreach ($data['show_time'] as $st) {
                        foreach ($data['screen_id'] as $sid) {
                            $totalDuration = MovieModel::find($data['film'])->duration;
                            $shStTi = date('h:i A', strtotime($st));
                            $shEnTi = date("h:i A", strtotime('+' . $totalDuration . ' minutes', strtotime($shStTi)));
                            $totatShowDuration = $shStTi . '-' . date("h:i A", strtotime('+' . $data['clean_up_time'] . ' minutes', strtotime($shEnTi)));
                            $dayOfWeek = strtotime($csd);
                            $dayOfWeek = date("l", $dayOfWeek);
                            $seatCategories = ScreenSeatCategories::where('screen_id', $sid)->get();
                            $catWithPrice = [];
                            foreach ($seatCategories as $seCa) {
                                $arrForSc['category_name'] = $seCa->category_name;
                                $arrForSc['category_price'] = PriceCard::where('name', $data['price_card'])->where('screen_ids', $sid)->where('seat_categories', $arrForSc['category_name'])->first()->prices;
                                $catWithPrice[] = $arrForSc;
                            }


                            $dataToStore['admin_id'] = Auth::guard('admin')->user()->id;
                            $dataToStore['movie_id'] = $data['film'];
                            $dataToStore['screen_id'] = $sid;
                            $dataToStore['show_time_start'] = $shStTi;
                            $dataToStore['show_time_end'] = $shEnTi;
                            $dataToStore['clean_up_time'] = $data['clean_up_time'];
                            $dataToStore['total_occupied_time'] = $totatShowDuration;
                            $dataToStore['show_date'] = $csd;
                            $dataToStore['show_day'] = $dayOfWeek;
                            $dataToStore['price_card_name'] = $data['price_card'];
                            $dataToStore['seat_categories_with_price'] = json_encode($catWithPrice);
                            $dataToStore['sales_via'] = json_encode($data['sales_via']);
                            $dataToStore['seating'] = $data['seating'];
                            $dataToStore['comps'] = $data['comps'];
                            $dataToStore['status'] = $data['status'];
                            $dataToStore['show_type'] = $data['show_type'];

                            $result = ScheduledMovie::create($dataToStore);
                        }
                    }
                }

                if ($result)
                    return 'success';

                return 'unsuccess';
            }else{
                return 'conflict';
            }
        }
    }


    public function getPriceCardTime(Request $request)
    {
        $pcChoosed = $request->pc;
        $timeRange = PriceCard::where('name', $pcChoosed)->first()->time_range;
        $days = PriceCard::where('name', $pcChoosed)->first()->selected_days;
        $days = json_decode($days, true);
        $days = implode(',', $days);
        $timeRangeArr = array_map('trim', explode('-', $timeRange));
//        $returnData['start_time'] = $timeRangeArr[0];
//        $returnData['end_time'] = $timeRangeArr[1];
//        $returnData['time']
        $returnData = [
            'start_time' => $timeRangeArr[0],
            'end_time' => $timeRangeArr[1],
            'days' => $days
        ];
        return array_values(array_unique($returnData, SORT_REGULAR));
    }

    public function events(Request $request)
    {
        $data = $request->all();
        $showDateStart = array_map('trim', explode('T', $data['start']));
        $showDateStart = $showDateStart[0];
        $showDateEnd = array_map('trim', explode('T', $data['end']));
        $showDateEnd = $showDateEnd[0];

        $returnData = ScheduledMovie::where('show_date','>=',$showDateStart)
            ->where('show_date','<=',$showDateEnd)->get();
        $count = 0;
        $events = [];
        foreach ($returnData as $rd) {
            $count++;
            $events[] = array(
                'id' => (string)$count,
                'title' => MovieModel::find($rd->movie_id)->movie_title,
                'start' => $rd->show_date . 'T' . date('H:i', strtotime($rd->show_time_start)),
                'end' => $rd->show_date . 'T' . date('H:i', strtotime($rd->show_time_end)),
                'unique_id' => $rd->id,
                'resourceId' => $rd->screen_id,
                'className' => 'event-style'
            );
        }

        return response()->json($events);

    }

    public function getScheduleData(Request $request)
    {
        $sid = $request->sid;
        $sd = ScheduledMovie::find($sid);
        $pcArr = [];
        foreach (PriceCard::where('admin_id', Auth::guard('admin')->user()->id)->where('screen_ids', $sd->screen_id)->get() as $pc) {
            array_push($pcArr, $pc->name);
        }

        $returnData = [
          'scheduleData' =>  $sd,
            'priceCardData' => array_values(array_unique($pcArr, SORT_REGULAR)),
            'showTime' => date('H:i', strtotime($sd->show_time_start)),
            'salesVia' => json_decode($sd->sales_via, true)
        ];

        return $returnData;
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');
        $schedueIdToEdit = $data['scheduleIdToEdit'];
        $movieDuration = MovieModel::find($data['film'])->duration;
        $conflict = 0;
        $conflictedTime = [];

        foreach ($data['choosed_show_dates'] as $csd) {
            foreach ($data['screen_id'] as $sid) {
                foreach (ScheduledMovie::where('id', '<>', $schedueIdToEdit)->get() as $sd)
                {
                    if($sd->show_date == $csd && $sd->screen_id == $sid)
                    {
                        $conflict = 1;
                        $conflictedTime[] = $sd->total_occupied_time;
                    }
                }
            }
        }


        if($conflict == 0)
        {
            foreach ($data['choosed_show_dates'] as $csd) {
                foreach ($data['show_time'] as $st) {
                    foreach ($data['screen_id'] as $sid) {
                        $totalDuration = MovieModel::find($data['film'])->duration;
                        $shStTi = date('h:i A', strtotime($st));
                        $shEnTi = date("h:i A", strtotime('+' . $totalDuration . ' minutes', strtotime($shStTi)));
                        $totatShowDuration = $shStTi . '-' . date("h:i A", strtotime('+' . $data['clean_up_time'] . ' minutes', strtotime($shEnTi)));
                        $dayOfWeek = strtotime($csd);
                        $dayOfWeek = date("l", $dayOfWeek);
                        $seatCategories = ScreenSeatCategories::where('screen_id', $sid)->get();
                        $catWithPrice = [];
                        foreach ($seatCategories as $seCa) {
                            $arrForSc['category_name'] = $seCa->category_name;
                            $arrForSc['category_price'] = PriceCard::where('name', $data['price_card'])->where('screen_ids', $sid)->where('seat_categories', $arrForSc['category_name'])->first()->prices;
                            $catWithPrice[] = $arrForSc;
                        }


                        $dataToStore['admin_id'] = Auth::guard('admin')->user()->id;
                        $dataToStore['movie_id'] = $data['film'];
                        $dataToStore['screen_id'] = $sid;
                        $dataToStore['show_time_start'] = $shStTi;
                        $dataToStore['show_time_end'] = $shEnTi;
                        $dataToStore['clean_up_time'] = $data['clean_up_time'];
                        $dataToStore['total_occupied_time'] = $totatShowDuration;
                        $dataToStore['show_date'] = $csd;
                        $dataToStore['show_day'] = $dayOfWeek;
                        $dataToStore['price_card_name'] = $data['price_card'];
                        $dataToStore['seat_categories_with_price'] = json_encode($catWithPrice);
                        $dataToStore['sales_via'] = json_encode($data['sales_via']);
                        $dataToStore['seating'] = $data['seating'];
                        $dataToStore['comps'] = $data['comps'];
                        $dataToStore['status'] = $data['status'];
                        $dataToStore['show_type'] = $data['show_type'];

                        $result = ScheduledMovie::find($schedueIdToEdit)->update($dataToStore);
                    }
                }
            }

            if ($result)
                return 'success';

            return 'unsuccess';
        }else{
            $timeConflict = 0;
            foreach ($data['show_time'] as $choosedShowTime) {
                $movieDuration = MovieModel::find($data['film'])->duration;
                $choosedShowTimeStart = date('h:i A', strtotime($choosedShowTime));
                $choosedShowTimeEnd = date("h:i A", strtotime('+' . $movieDuration . ' minutes', strtotime($choosedShowTimeStart)));
                $choosedShowTimeEnd = date("h:i A", strtotime('+' . $data['clean_up_time'] . ' minutes', strtotime($choosedShowTimeEnd)));
                foreach ($conflictedTime as $ct)
                {
                    $confictTimeArray = array_map('trim', explode('-', $ct));
                    $conflictTimeStart = $confictTimeArray[0];
                    $conflictTimeEnd = $confictTimeArray[1];

                    $choosedShowStartingTime = \DateTime::createFromFormat('h:i A', $choosedShowTimeStart);
                    $choosedShowEndingTime = \DateTime::createFromFormat('h:i A', $choosedShowTimeEnd);
                    $conflictStartingTime = \DateTime::createFromFormat('h:i A', $conflictTimeStart);
                    $conflictEndingTime = \DateTime::createFromFormat('h:i A', $conflictTimeEnd);
                    if ($choosedShowStartingTime >= $conflictStartingTime && $choosedShowStartingTime <= $conflictEndingTime) {
                        $timeConflict = 1;
                    }

                    if ($choosedShowEndingTime >= $conflictStartingTime && $choosedShowEndingTime <= $conflictEndingTime) {
                        $timeConflict = 1;
                    }
                }
            }

            if($timeConflict == 0)
            {
                foreach ($data['choosed_show_dates'] as $csd) {
                    foreach ($data['show_time'] as $st) {
                        foreach ($data['screen_id'] as $sid) {
                            $totalDuration = MovieModel::find($data['film'])->duration;
                            $shStTi = date('h:i A', strtotime($st));
                            $shEnTi = date("h:i A", strtotime('+' . $totalDuration . ' minutes', strtotime($shStTi)));
                            $totatShowDuration = $shStTi . '-' . date("h:i A", strtotime('+' . $data['clean_up_time'] . ' minutes', strtotime($shEnTi)));
                            $dayOfWeek = strtotime($csd);
                            $dayOfWeek = date("l", $dayOfWeek);
                            $seatCategories = ScreenSeatCategories::where('screen_id', $sid)->get();
                            $catWithPrice = [];
                            foreach ($seatCategories as $seCa) {
                                $arrForSc['category_name'] = $seCa->category_name;
                                $arrForSc['category_price'] = PriceCard::where('name', $data['price_card'])->where('screen_ids', $sid)->where('seat_categories', $arrForSc['category_name'])->first()->prices;
                                $catWithPrice[] = $arrForSc;
                            }


                            $dataToStore['admin_id'] = Auth::guard('admin')->user()->id;
                            $dataToStore['movie_id'] = $data['film'];
                            $dataToStore['screen_id'] = $sid;
                            $dataToStore['show_time_start'] = $shStTi;
                            $dataToStore['show_time_end'] = $shEnTi;
                            $dataToStore['clean_up_time'] = $data['clean_up_time'];
                            $dataToStore['total_occupied_time'] = $totatShowDuration;
                            $dataToStore['show_date'] = $csd;
                            $dataToStore['show_day'] = $dayOfWeek;
                            $dataToStore['price_card_name'] = $data['price_card'];
                            $dataToStore['seat_categories_with_price'] = json_encode($catWithPrice);
                            $dataToStore['sales_via'] = json_encode($data['sales_via']);
                            $dataToStore['seating'] = $data['seating'];
                            $dataToStore['comps'] = $data['comps'];
                            $dataToStore['status'] = $data['status'];
                            $dataToStore['show_type'] = $data['show_type'];

                            $result = ScheduledMovie::find($schedueIdToEdit)->update($dataToStore);
                        }
                    }
                }

                if ($result)
                    return 'success';

                return 'unsuccess';
            }else{
                return 'conflict';
            }
        }
    }

    public function deleteSchedule(Request $request)
    {
        $scheduleId = $request->scheduleId;
        $result = ScheduledMovie::find($scheduleId)->delete();
        if($result)
            return 'true';

        return 'false';
    }

}


