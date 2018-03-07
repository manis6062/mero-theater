<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScreenController extends Controller
{
    public function create()
    {

    }

    public function lists()
    {
        return view('admin.screen.list');
    }
}
