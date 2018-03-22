<?php

namespace App\Http\Controllers\Admin\smsCampaign;
use App\Http\Controllers\Controller;
class ContactController extends Controller
{	
    function index()
    {
        return 'testContact';
    	return view('admin.smsCampaign.overview');
    }
}
