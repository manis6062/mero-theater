<?php

namespace App\Http\Controllers\CounterManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('counter-management.dashboard');
    }
}
