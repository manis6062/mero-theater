<?php

namespace App\Http\Controllers\Admin\smsCampaign;
use App\Http\Controllers\Controller;
class OverViewController extends Controller
{	
    function index()
    {
    	return view('admin.smsCampaign.overview');
    }
}
