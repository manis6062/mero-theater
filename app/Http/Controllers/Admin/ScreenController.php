<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Screen\Screen;
use App\Screen\ScreenSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

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
            'screen_number' => 'required',
            'available_seat' => 'required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'reserved_seat' => 'required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'selected_seat' => 'required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'sold_seat' => 'required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
        ]);

        $dataToStore = [
            'admin_id' => Auth::guard('admin')->user()->id,
            'name' => $request->name,
            'screen_number' => $request->screen_number,
            'house_seats' => $request->house_seats == null ? 0 : $request->house_seats,
            'wheel_chair_seats' => $request->wheel_chair_seats == null ? 0 : $request->wheel_chair_seats,
        ];

        if ($request->hasFile('available_seat')) {
            $image = $request->file('available_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/available-seat-image');
            $image->move($path, $filename);
            $dataToStore['available_seat'] = $filename;
        }

        if ($request->hasFile('reserved_seat')) {
            $image = $request->file('reserved_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/reserved-seat-image');
            $image->move($path, $filename);
            $dataToStore['reserved_seat'] = $filename;
        }

        if ($request->hasFile('selected_seat')) {
            $image = $request->file('selected_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/selected-seat-image');
            $image->move($path, $filename);
            $dataToStore['selected_seat'] = $filename;
        }


        if ($request->hasFile('sold_seat')) {
            $image = $request->file('sold_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/sold-seat-image');
            $image->move($path, $filename);
            $dataToStore['sold_seat'] = $filename;
        }

        $slug = $this->createUniqueSlug($request->name);
        $dataToStore['slug'] = $slug;

        Screen::create($dataToStore);

        return redirect('admin/seat-management/screens');
    }

    public function lists()
    {
        $screens = Screen::orderBy('id', 'ASC')->get();
        return view('admin.screen.list', compact('screens'));
    }

    public function delete(Request $request)
    {
        $screenId = $request->screenId;
        $detail = Screen::find($screenId);

        if (file_exists(public_path('screen/available-seat-image/' . $detail->available_seat)))
            unlink(public_path('screen/available-seat-image/' . $detail->available_seat));

        if (file_exists(public_path('screen/reserved-seat-image/' . $detail->reserved_seat)))
            unlink(public_path('screen/reserved-seat-image/' . $detail->reserved_seat));

        if (file_exists(public_path('screen/selected-seat-image/' . $detail->selected_seat)))
            unlink(public_path('screen/selected-seat-image/' . $detail->selected_seat));

        if (file_exists(public_path('screen/sold-seat-image/' . $detail->sold_seat)))
            unlink(public_path('screen/sold-seat-image/' . $detail->sold_seat));

        if (Screen::find($screenId)->delete())
        {
            ScreenSeat::where('screen_id', $screenId)->delete();
            return 'true';
        }


        return 'false';
    }


    public function createUniqueSlug($slug)
    {
        $createdSlug = str_slug($slug, "-");
        $check = Screen::where('slug', $createdSlug)->first();

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
        $screen = Screen::where('slug', $slug)->first();
        return view('admin.screen.edit', compact('screen'));
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'name' => 'required',
            'screen_number' => 'required',
            'available_seat' => 'sometimes|required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'reserved_seat' => 'sometimes|required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'selected_seat' => 'sometimes|required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
            'sold_seat' => 'sometimes|required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg',
        ]);

        $dataToStore = [
            'admin_id' => Auth::guard('admin')->user()->id,
            'name' => $request->name,
            'screen_number' => $request->screen_number,
            'house_seats' => $request->house_seats == null ? 0 : $request->house_seats,
            'wheel_chair_seats' => $request->wheel_chair_seats == null ? 0 : $request->wheel_chair_seats,
        ];

        $detail = Screen::where('slug', $slug)->first();

        if ($request->hasFile('available_seat')) {
            if (file_exists(public_path('screen/available-seat-image/' . $detail->available_seat)))
                unlink(public_path('screen/available-seat-image/' . $detail->available_seat));
            $image = $request->file('available_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/available-seat-image');
            $image->move($path, $filename);
            $dataToStore['available_seat'] = $filename;
        }

        if ($request->hasFile('reserved_seat')) {
            if (file_exists(public_path('screen/reserved-seat-image/' . $detail->reserved_seat)))
                unlink(public_path('screen/reserved-seat-image/' . $detail->reserved_seat));
            $image = $request->file('reserved_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/reserved-seat-image');
            $image->move($path, $filename);
            $dataToStore['reserved_seat'] = $filename;
        }

        if ($request->hasFile('selected_seat')) {
            if (file_exists(public_path('screen/selected-seat-image/' . $detail->selected_seat)))
                unlink(public_path('screen/selected-seat-image/' . $detail->selected_seat));

            $image = $request->file('selected_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/selected-seat-image');
            $image->move($path, $filename);
            $dataToStore['selected_seat'] = $filename;
        }


        if ($request->hasFile('sold_seat')) {
            if (file_exists(public_path('screen/sold-seat-image/' . $detail->sold_seat)))
                unlink(public_path('screen/sold-seat-image/' . $detail->sold_seat));
            $image = $request->file('sold_seat');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('screen/sold-seat-image');
            $image->move($path, $filename);
            $dataToStore['sold_seat'] = $filename;
        }

        if ($detail->name != $request->name) {
            $slug = $this->createUniqueSlug($request->name);
            $dataToStore['slug'] = $slug;
        }


        Screen::find($detail->id)->update($dataToStore);

        return redirect('admin/seat-management/screens');
    }

    public function seat($slug)
    {
        $screen = Screen::where('slug', $slug)->first();
        $seatData = ScreenSeat::where('admin_id', Auth::guard('admin')->user()->id)->where('screen_id', $screen->id)->first();
        return view('admin.screen.seat', compact('seatData', 'screen'));
    }

    public function createSeat($slug)
    {
        $screen = Screen::where('slug', $slug)->first();
        return view('admin.screen.create-seat', compact('screen'));
    }

    public function ajaxCall(Request $request)
    {
        $data = $request->except('_token');
        $screen = Screen::find($data['screenId']);
        return View::make('admin.screen.seat-structure')->with('data', $data)->with('screen', $screen)->render();
    }

    public function submitSeat(Request $request, $slug)
    {
        $data = $request->except('_token');
        $screen = Screen::where('slug', $slug)->first();
        $alphas = range('A', 'Z');
        $dataToStore = [
            'admin_id' => Auth::guard('admin')->user()->id,
            'screen_id' => $screen->id,
            'num_rows' => $data['numOfRows'],
            'num_columns' => $data['numOfColumns'],
            'seat_direction' => $data['seatDirection'],
            'alphabet_direction' => $data['alphabetDirection'],
        ];

        $activeSeat = [];
        $alphabets = [];
        if (isset($data['inactiveSeat'])) {
            $dataToStore['path'] = json_encode($data['inactiveSeat']);
            for ($i = 1; $i <= $data['numOfRows']; $i++) {
                $alphabets[] = $alphas[$i - 1];
                for ($j = 1; $j <= $data['numOfColumns']; $j++) {
                    if (!in_array($i . '-' . $j, $data['inactiveSeat'])) {
                        $activeSeat[] = $i . '-' . $j;
                    }
                }
            }
        } else {
            $dataToStore['path'] = 0;
            for ($i = 1; $i <= $data['numOfRows']; $i++) {
                $alphabets[] = $alphas[$i - 1];
                for ($j = 1; $j <= $data['numOfColumns']; $j++) {
                    $activeSeat[] = $i . '-' . $j;
                }
            }
        }

        $dataToStore['active_seats'] = json_encode($activeSeat);
        $dataToStore['alphabets'] = json_encode($alphabets);
        $dataToStore['total_seats'] = count($activeSeat);

        $result = ScreenSeat::create($dataToStore);
        if ($result)
        {
            $hs = $screen->house_seats;
            $wcs = $screen->wheel_chair_seats;
            $ss = $dataToStore['total_seats'] - $hs - $wcs;
            Screen::find($screen->id)->update(['standard_seats' => $ss]);
            return redirect('admin/seat-management/screens/' . $screen->slug . '/seat')->with('status', 'success');
        }


        return redirect('admin/seat-management/screens/' . $screen->slug . '/seat')->with('status', 'unsuccess');
    }

    public function updateSeat(Request $request, $slug)
    {
        $data = $request->except('_token');
        $screen = Screen::where('slug', $slug)->first();
        $alphas = range('A', 'Z');
        $dataToStore = [
            'admin_id' => Auth::guard('admin')->user()->id,
            'screen_id' => $screen->id,
            'num_rows' => $data['numOfRows'],
            'num_columns' => $data['numOfColumns'],
            'seat_direction' => $data['seatDirection'],
            'alphabet_direction' => $data['alphabetDirection'],
        ];

        $activeSeat = [];
        $alphabets = [];
        if (isset($data['inactiveSeat'])) {
            $dataToStore['path'] = json_encode($data['inactiveSeat']);
            for ($i = 1; $i <= $data['numOfRows']; $i++) {
                $alphabets[] = $alphas[$i - 1];
                for ($j = 1; $j <= $data['numOfColumns']; $j++) {
                    if (!in_array($i . '-' . $j, $data['inactiveSeat'])) {
                        $activeSeat[] = $i . '-' . $j;
                    }
                }
            }
        } else {
            $dataToStore['path'] = 0;
            for ($i = 1; $i <= $data['numOfRows']; $i++) {
                $alphabets[] = $alphas[$i - 1];
                for ($j = 1; $j <= $data['numOfColumns']; $j++) {
                    $activeSeat[] = $i . '-' . $j;
                }
            }
        }

        $dataToStore['active_seats'] = json_encode($activeSeat);
        $dataToStore['alphabets'] = json_encode($alphabets);
        $dataToStore['total_seats'] = count($activeSeat);

        $result = ScreenSeat::find($data['screenSeatDataId'])->update($dataToStore);
        if ($result)
        {
            $hs = $screen->house_seats;
            $wcs = $screen->wheel_chair_seats;
            $ss = $dataToStore['total_seats'] - $hs - $wcs;
            Screen::find($screen->id)->update(['standard_seats' => $ss]);
            return redirect('admin/seat-management/screens/' . $screen->slug . '/seat')->with('status', 'success-update');
        }

        return redirect('admin/seat-management/screens/' . $screen->slug . '/seat')->with('status', 'unsuccess-update');
    }

    public function editSeat($slug)
    {
        $screen = Screen::where('slug', $slug)->first();
        $screenSeatData = ScreenSeat::where('screen_id', $screen->id)->first();
        return view('admin.screen.edit-seat', compact('screen', 'screenSeatData'));
    }
}
