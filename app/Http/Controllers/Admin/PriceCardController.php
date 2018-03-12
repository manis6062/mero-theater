<?php

namespace App\Http\Controllers\Admin;

use App\PriceCardModel\PriceCard;
use App\Screen\Screen;
use App\TicketTypeModel\TicketType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PriceCardController extends Controller
{
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
       $ds['selected_days'] = json_encode($data['days']);
       $ds['time_range'] = $data['time_range'];
       $ds['ticket_types_ids'] = json_encode($data['ticket_types_id']);
       $ds['sequences'] = json_encode($data['ticket_types_sequence']);
       $ds['prices'] = json_encode($data['ticket_types_price']);
       $ds['status'] = $data['status'];

       $result = PriceCard::create($ds);
       if($result)
           return redirect('admin/box-office/price-card-management')->with('message', 'Price card created successfully !');

        return redirect('admin/box-office/price-card-management')->with('message', 'Oops ! something went wrong. Please try again.');
    }
}
