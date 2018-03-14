<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InquiryModel;

class InquiryController extends Controller
{
    public function index()
    {
    	$inquires = InquiryModel::orderBy('created_at','desc')->get();
    	return view('admin.inquiry.view',compact('inquires'));
    }

    public function delete(Request $request)
    {
    	$Id = $request->Id;
    	InquiryModel::find($Id)->delete();
    	return 'true';
    }
}
