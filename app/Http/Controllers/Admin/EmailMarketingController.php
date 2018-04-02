<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TheaterMail;
use Mail;

class EmailMarketingController extends Controller
{
    public function index()
    {
        return view('admin.email-marketing.index');
    }

    public function campaignCreate()
    {
        return view('admin.email-marketing.campaign-create');
    }

    public function sendMail()
    {
        $data = [
            'message'       => '<H2>Hello test message</H2>',
            'custom_args'   => ['theater_id' => 112],
            'subject'       => 'Test Subject',
            'from'          => 'raznpra@gmail.com',
            'from_name'     => 'Mero Threater',
            'reply_to'      => 'raznpra@gmail.com',
            'reply_to_name' => 'Threater Admin',
            'category'      => 'category',
        ];

        Mail::to('es.rajendra.prajapati@gmail.com')->send(new TheaterMail($data));
    }
}
