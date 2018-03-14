<?php

namespace App\Http\Controllers\Admin;

use App\MovieModel;
use App\Screen\Screen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProgrammingController extends Controller
{
    public function index(){
        return view('admin.programming.index');
    }

    public function addShow()
    {
        $films = MovieModel::where('status', 'active')->get();
        $screens = Screen::where('admin_id', Auth::guard('admin')->user()->id)->orderBy('screen_number', 'ASC')->get();
        return view('admin.programming.add-show', compact('films', 'screens'));
    }
}
