<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PriceCardModel\PriceCard;
use App\Screen\Screen;
use App\Screen\ScreenSeat;
use App\TicketTypeModel\TicketClass;
use App\TicketTypeModel\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketTypesController extends Controller
{
    protected $count = 1;

    public function index()
    {
        $ticketTypes = TicketType::all();
        return view('admin.ticket-types.list', compact('ticketTypes'));
    }

    public function create()
    {
        if (TicketClass::count() == 0) {
            return redirect('admin/box-office/ticket-types/classes/create')->with('message', 'ticket-class-not-found');
        }

        $sequenceNumbers = TicketType::where('admin_id', Auth::guard('admin')->user()->id)->pluck('display_sequence');
        $screens = Screen::where('admin_id', Auth::guard('admin')->user()->id)->get();
        $ticketClasses = TicketClass::orderBy('id', 'DESC')->get();
        return view('admin.ticket-types.create', compact('ticketClasses', 'screens', 'sequenceNumbers'));
    }

    public function createTicketClass()
    {
        return view('admin.ticket-types.create-ticket-class');
    }

    public function ticketClass()
    {
        $ticketClasses = TicketClass::orderBy('id', 'DESC')->get();
        return view('admin.ticket-types.list-ticket-class', compact('ticketClasses'));
    }

    public function submitTicketClass(Request $request)
    {
        $data = $request->except('_token');
        for ($i = 0; $i < count($data['class_name']); $i++) {
            $slug = $this->createUniqueSlugForTicketClass($data['class_name'][$i]);
            $ds = [
                'class_name' => $data['class_name'][$i],
                'class_description' => $data['class_description'][$i],
                'slug' => $slug
            ];

            $result = TicketClass::create($ds);
        }

        if (isset($result))
            return redirect('admin/box-office/ticket-types/classes')->with('message', 'Ticket Class Successfully Created !');

        return redirect('admin/box-office/ticket-types/classes')->with('message', 'Oops ! something went wrong. Please try again !');
    }

    public function createUniqueSlugForTicketClass($slug)
    {
        $createdSlug = str_slug($slug, "-");
        $check = TicketClass::where('slug', $createdSlug)->first();

        if ($check) {
            $this->count += 1;
            if ($this->count > 1)
                $slug = substr($slug, 0, -2);
            return $this->createUniqueSlugForTicketClass($slug . ' ' . $this->count);
        }
        return $createdSlug;
    }


    public function createUniqueSlugForTicketType($slug)
    {
        $createdSlug = str_slug($slug, "-");
        $check = TicketType::where('slug', $createdSlug)->first();

        if ($check) {
            $this->count += 1;
            if ($this->count > 1)
                $slug = substr($slug, 0, -2);
            return $this->createUniqueSlugForTicketType($slug . ' ' . $this->count);
        }
        return $createdSlug;
    }


    public function editTicketClass($slug)
    {
        $ticketClass = TicketClass::where('slug', $slug)->first();
        return view('admin.ticket-types.edit-ticket-class', compact('ticketClass'));
    }

    public function updateTicketClass(Request $request, $slug)
    {
        $tc = TicketClass::where('slug', $slug)->first();
        $du = [
            'class_name' => $request->class_name,
            'class_description' => $request->class_description,
        ];

        if (TicketClass::find($tc->id)->update($du)) {
            return redirect('admin/box-office/ticket-types/classes')->with('message', 'Ticket Class Successfully Updated !');
        }

        return redirect('admin/box-office/ticket-types/classes')->with('message', 'Oops ! something went wrong. Please try again !');
    }

    public function deleteTicketClass(Request $request)
    {
        $result = TicketClass::find($request->classId)->delete();
        if ($result) {
            return 'true';
        }

        return 'error';
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'label' => 'required',
            'ticket_class_id' => 'required',
            'default_price' => 'required',
            'display_sequence' => 'required',
        ]);

        $data = $request->except('_token');

        $slug = $this->createUniqueSlugForTicketType($data['label']);
        $data['slug'] = $slug;
        $data['admin_id'] = Auth::guard('admin')->user()->id;

        $result = TicketType::create($data);
        if ($result)
            return redirect('admin/box-office/ticket-types')->with('message', 'Ticket Type Successfully Created !');

        return redirect('admin/box-office/ticket-types')->with('message', 'Oops ! something went wrong. Please try again !');
    }

    public function getScreenRows(Request $request)
    {
        $sid = $request->screenId;
        $checkSeat = ScreenSeat::where('screen_id', $sid)->first();
        if ($checkSeat == null) {
            return 'no seat design';
        } else {
            $alphabets = json_decode($checkSeat->alphabets, true);
            $ret = '';
            $ret .= '<div class="form-group">';
            $ret .= '<span>Choose Starting And End Row <small>*</small></small></span>';
            $ret .= '<div class="clearfix"></div>';
            $ret .= '<select style="width: 48%; float: left; margin-right: 2%;" class="form-control" name="from_row" id="from-row-select">';
            $ret .= '<option value="">-- Select Starting Row --</option>';
            foreach ($alphabets as $alpha) {
                $ret .= '<option value="' . $alpha . '">' . $alpha . '</option>';
            }
            $ret .= '</select>';
            $ret .= '<select style="width: 48%; float: left; margin-left: 2%;" class="form-control" name="to_row" id="to-row-select">';
            $ret .= '<option value="">-- Select End Row --</option>';
            foreach ($alphabets as $alpha) {
                $ret .= '<option value="' . $alpha . '">' . $alpha . '</option>';
            }
            $ret .= '</select>';
            $ret .= '<span class="help-block error starting-row-error"></span>';
            $ret .= '</div>';

            return $ret;
        }
    }

    public function editTicketType($slug)
    {
        $ticketType = TicketType::where('slug', $slug)->first();
        $sequenceNumbers = TicketType::where('admin_id', Auth::guard('admin')->user()->id)->pluck('display_sequence');
        $ticketClasses = TicketClass::orderBy('id', 'DESC')->get();
        return view('admin.ticket-types.edit', compact('ticketType', 'sequenceNumbers', 'ticketClasses'));
    }

    public function updateTicketType(Request $request, $slug)
    {
        $tt = TicketType::where('slug', $slug)->first();
        $dataToUpdate = $request->except('_token');
        $result = TicketType::find($tt->id)->update($dataToUpdate);
        if ($result)
            return redirect('admin/box-office/ticket-types')->with('message', 'Ticket Type Successfully Updated !');

        return redirect('admin/box-office/ticket-types')->with('message', 'Oops ! something went wrong. Please try again !');
    }

    public function deleteTicketType(Request $request)
    {
        $ttid = $request->ttid;
        if(TicketType::find($ttid)->delete())
        {
            foreach (PriceCard::all() as $pc)
            {
                $ttArray = json_decode($pc->ticket_types_ids, true);
                if(in_array($ttid, $ttArray))
                {
                    $arr = array_diff($ttArray, [$ttid]);
                    PriceCard::find($pc->id)->update(['ticket_types_ids' => json_encode($arr)]);
                }
            }
            return 'true';
        }

        return 'error';
    }

}
