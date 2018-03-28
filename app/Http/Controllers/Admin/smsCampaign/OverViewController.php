<?php

namespace App\Http\Controllers\Admin\smsCampaign;
use App\Http\Controllers\Admin\smsCampaign\sms\CampaignController;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class OverViewController extends Controller
{	
    function index()
    {
        $campaign=new CampaignController();
        $client = new \GuzzleHttp\Client();
        $output = $client->post(
            'http://aakashsms.com/admin/public/sms/v1/credit',
            array(
                'form_params' => array(
                    'auth_token' =>$campaign->tokenValue(),
                )
            )
        )->getBody();
        $obj = json_decode($output);

        $available_credit= $obj->available_credit;
        $sms_sent= $obj->total_sms_sent;
        $total_contact=Contact::where('admin_id',Auth::guard('admin')->user()->id)->count();
    	return view('admin.smsCampaign.overview',compact('available_credit','sms_sent','total_contact'));
    }
}
