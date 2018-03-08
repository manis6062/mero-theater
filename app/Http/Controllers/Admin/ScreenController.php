<?php

namespace App\Http\Controllers\Admin;

use App\Screen\Screen;
use App\Screen\ScreenSeat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ScreenController extends Controller
{
    protected $count = 0;

    public function create()
    {
        return view('admin.screen.create');
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
            'available_seat' => 'required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'reserved_seat' => 'required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'selected_seat' => 'required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'sold_seat' => 'required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
        ]);

        $dataToStore = [
            'admin_id' => Auth::guard('admin')->user()->id,
            'name' => $request->name
        ];

        if($request->hasFile('available_seat'))
        {
            $image = $request->file('available_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/available-seat-image');
            $image->move($path, $filename);
            $dataToStore['available_seat'] = $filename;
        }

        if($request->hasFile('reserved_seat'))
        {
            $image = $request->file('reserved_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/reserved-seat-image');
            $image->move($path, $filename);
            $dataToStore['reserved_seat'] = $filename;
        }

        if($request->hasFile('selected_seat'))
        {
            $image = $request->file('selected_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/selected-seat-image');
            $image->move($path, $filename);
            $dataToStore['selected_seat'] = $filename;
        }


        if($request->hasFile('sold_seat'))
        {
            $image = $request->file('sold_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/sold-seat-image');
            $image->move($path, $filename);
            $dataToStore['sold_seat'] = $filename;
        }

        $slug = $this->createUniqueSlug($request->name);
        $dataToStore['slug'] = $slug;

        Screen::create($dataToStore);

        return redirect('admin/screens');
    }

    public function lists()
    {
        $screens = Screen::orderBy('id', 'DESC')->get();
        return view('admin.screen.list', compact('screens'));
    }

    public function delete(Request $request)
    {
        $screenId = $request->screenId;
        $detail = Screen::find($screenId);

        if(file_exists(public_path('screen/available-seat-image/'.$detail->available_seat)))
            unlink(public_path('screen/available-seat-image/'.$detail->available_seat));

        if(file_exists(public_path('screen/reserved-seat-image/'.$detail->reserved_seat)))
            unlink(public_path('screen/reserved-seat-image/'.$detail->reserved_seat));

        if(file_exists(public_path('screen/selected-seat-image/'.$detail->selected_seat)))
            unlink(public_path('screen/selected-seat-image/'.$detail->selected_seat));

        if(file_exists(public_path('screen/sold-seat-image/'.$detail->sold_seat)))
            unlink(public_path('screen/sold-seat-image/'.$detail->sold_seat));

        if(Screen::find($screenId)->delete())
            return 'true';

        return 'false';
    }


    public function createUniqueSlug($slug)
    {
        $createdSlug = str_slug($slug, "-");
        $check = Screen::where('slug', $createdSlug)->first();

        if($check)
        {
            $this->count += 1;
            if($this->count > 1)
                $slug = substr($slug, 0, -2);
            return $this->createUniqueSlug($slug.' '.$this->count);
        }
        return $createdSlug;
    }

    public function edit($slug)
    {
        $screen = Screen::where('slug', $slug)->first();
        return view('admin.screen.edit', compact('screen'));
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'name' => 'required',
            'available_seat' => 'sometimes|required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'reserved_seat' => 'sometimes|required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'selected_seat' => 'sometimes|required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'sold_seat' => 'sometimes|required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
        ]);

        $dataToStore = [
            'admin_id' => Auth::guard('admin')->user()->id,
            'name' => $request->name
        ];

        $detail = Screen::where('slug', $slug)->first();

        if($request->hasFile('available_seat'))
        {
            if(file_exists(public_path('screen/available-seat-image/'.$detail->available_seat)))
                unlink(public_path('screen/available-seat-image/'.$detail->available_seat));
            $image = $request->file('available_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/available-seat-image');
            $image->move($path, $filename);
            $dataToStore['available_seat'] = $filename;
        }

        if($request->hasFile('reserved_seat'))
        {
            if(file_exists(public_path('screen/reserved-seat-image/'.$detail->reserved_seat)))
                unlink(public_path('screen/reserved-seat-image/'.$detail->reserved_seat));
            $image = $request->file('reserved_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/reserved-seat-image');
            $image->move($path, $filename);
            $dataToStore['reserved_seat'] = $filename;
        }

        if($request->hasFile('selected_seat'))
        {
            if(file_exists(public_path('screen/selected-seat-image/'.$detail->selected_seat)))
                unlink(public_path('screen/selected-seat-image/'.$detail->selected_seat));

            $image = $request->file('selected_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/selected-seat-image');
            $image->move($path, $filename);
            $dataToStore['selected_seat'] = $filename;
        }


        if($request->hasFile('sold_seat'))
        {
            if(file_exists(public_path('screen/sold-seat-image/'.$detail->sold_seat)))
                unlink(public_path('screen/sold-seat-image/'.$detail->sold_seat));
            $image = $request->file('sold_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/sold-seat-image');
            $image->move($path, $filename);
            $dataToStore['sold_seat'] = $filename;
        }

        if($detail->name != $request->name)
        {
            $slug = $this->createUniqueSlug($request->name);
            $dataToStore['slug'] = $slug;
        }


        Screen::find($detail->id)->update($dataToStore);

        return redirect('admin/screens');
    }

    public function seat($slug)
    {
        $screen = Screen::where('slug', $slug)->first();
        $seatData =ScreenSeat::where('admin_id', Auth::guard('admin')->user()->id)->where('screen_id', $screen->id)->first();
        return view('admin.screen.seat', compact('seatData', 'screen'));
    }

    public function createSeat($slug)
    {
        $screen = Screen::where('slug', $slug)->first();
        return view('admin.screen.create-seat', compact('screen'));
    }
}
