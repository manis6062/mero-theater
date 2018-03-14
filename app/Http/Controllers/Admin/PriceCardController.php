<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PriceCardModel\PriceCard;
use App\Screen\Screen;
use App\Screen\ScreenSeatCategories;
use App\TicketTypeModel\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriceCardController extends Controller
{
    protected $count = 0;
    protected $f = 0;

    public function index()
    {
        $priceCards = PriceCard::where('admin_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.price-card.list', compact('priceCards'));
    }

    public function create()
    {
        $screens = Screen::where('admin_id', Auth::guard('admin')->user()->id)->orderBy('id', 'ASC')->get();
        $ticketTypes = TicketType::where('admin_id', Auth::guard('admin')->user()->id)->orderBy('display_sequence', 'ASC')->get();
        return view('admin.price-card.create', compact('screens', 'ticketTypes'));
    }

    public function submit(Request $request)
    {
        $data = $request->except('_token');
        $ds['admin_id'] = Auth::guard('admin')->user()->id;
        $ds['name'] = $data['name'];
        $ds['screen_ids'] = json_encode($data['screen_id']);
        $ds['seat_categories'] = json_encode($data['seat_categories']);
        $ds['selected_days'] = json_encode($data['days']);
        $ds['time_range'] = $data['time_range'];
        $ds['min_time_range'] = $data['min_time_range'];
        $ds['max_time_range'] = $data['max_time_range'];
        $ds['ticket_types_ids'] = json_encode($data['ticket_types_id']);
        $ds['sequences'] = json_encode($data['ticket_types_sequence']);
        $ds['prices'] = json_encode($data['ticket_types_price']);
        $ds['status'] = $data['status'];
        $ds['slug'] = $this->createUniqueSlug($ds['name']);

        $result = PriceCard::create($ds);
        if ($result)
            return redirect('admin/box-office/price-card-management')->with('message', 'Price card created successfully !');

        return redirect('admin/box-office/price-card-management')->with('message', 'Oops ! something went wrong. Please try again.');
    }


    public function update(Request $request, $slug)
    {
        $data = $request->except('_token');
        $pc = PriceCard::where('slug', $slug)->first();
        $ds['admin_id'] = Auth::guard('admin')->user()->id;
        $ds['name'] = $data['name'];
        $ds['screen_ids'] = json_encode($data['screen_id']);
        $ds['seat_categories'] = json_encode($data['seat_categories']);
        $ds['selected_days'] = json_encode($data['days']);
        $ds['time_range'] = $data['time_range'];
        $ds['min_time_range'] = $data['min_time_range'];
        $ds['max_time_range'] = $data['max_time_range'];
        $ds['ticket_types_ids'] = json_encode($data['ticket_types_id']);
        $ds['sequences'] = json_encode($data['ticket_types_sequence']);
        $ds['prices'] = json_encode($data['ticket_types_price']);
        $ds['status'] = $data['status'];

        if ($pc->name != $ds['name'])
            $ds['slug'] = $this->createUniqueSlug($ds['name']);

        $result = PriceCard::find($pc->id)->update($ds);

        if ($result)
            return redirect('admin/box-office/price-card-management')->with('message', 'Price card updated successfully !');

        return redirect('admin/box-office/price-card-management')->with('message', 'Oops ! something went wrong. Please try again.');
    }

    public function createUniqueSlug($slug)
    {
        $createdSlug = str_slug($slug, "-");
        $check = PriceCard::where('slug', $createdSlug)->first();

        if ($check) {
            $this->count += 1;
            if ($this->count > 1)
                $slug = substr($slug, 0, -2);
            return $this->createUniqueSlug($slug . ' ' . $this->count);
        }
        return $createdSlug;
    }

    public function edit($slug)
    {
        $priceCard = PriceCard::where('slug', $slug)->first();
        $screens = Screen::where('admin_id', Auth::guard('admin')->user()->id)->orderBy('id', 'ASC')->get();
        $ticketTypes = TicketType::where('admin_id', Auth::guard('admin')->user()->id)->orderBy('display_sequence', 'ASC')->get();
        $params = json_decode($priceCard->screen_ids, true);
        $returnData = [];
        $sendData = [];
        $ret = '';

        foreach ($params as $param) {
            $categories = ScreenSeatCategories::where('screen_id', $param)->get();
            foreach ($categories as $cat) {
                $returnData[] = $cat->category_name;
            }
        }

        if(count($params) > 1)
        {
            foreach ($returnData as $dat)
            {
                $check = 0;
                foreach ($params as $param) {
                    if($param != 'all')
                    {
                        if(ScreenSeatCategories::where('screen_id', $param)->where('category_name', $dat)->first() != null)
                        {
                            $check ++;
                        }
                    }else{
                        $check ++;
                    }
                }

                if($check == count($params))
                {
                    $sendData[] = $dat;
                }
            }
        }else{
            $sendData = $returnData;
        }


        $sendData = array_unique($sendData);

        $seatCategoriesArr = json_decode($priceCard->seat_categories, true);

        return view('admin.price-card.edit', compact('priceCard', 'slug', 'screens', 'ticketTypes', 'sendData', 'seatCategoriesArr'));
    }

    public function delete(Request $request)
    {
        $pcid = $request->pcid;
        if (PriceCard::find($pcid)->delete()) {
            return 'true';
        }

        return 'error';
    }

    public function getSeatCategories(Request $request)
    {
        $params = json_decode($request->params, true);
        $flag = $request->flag;
        $returnData = [];
        $sendData = [];
        $ret = '';

        foreach ($params as $param) {
            $categories = ScreenSeatCategories::where('screen_id', $param)->get();
            foreach ($categories as $cat) {
                $returnData[] = $cat->category_name;
            }
        }

        if(count($params) > 1)
        {
            foreach ($returnData as $dat)
            {
                $check = 0;
                foreach ($params as $param) {
                    if($param != 'all')
                    {
                        if(ScreenSeatCategories::where('screen_id', $param)->where('category_name', $dat)->first() != null)
                        {
                            $check ++;
                        }
                    }else{
                        $check ++;
                    }
                }

                if($check == count($params))
                {
                    $sendData[] = $dat;
                }
            }
        }else{
            $sendData = $returnData;
        }


        if(count($sendData) > 0)
            return array_unique($sendData);

        return 'empty';
    }
}
