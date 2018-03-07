<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\MovieTheatreScreens;

class DashboardController extends Controller
{	
    function index()
    {
    		
    	return view('admin.dashboard.index');
    }
}
