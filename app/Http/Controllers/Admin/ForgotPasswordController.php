<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Mail\TheaterMail;
use Mail;
class ForgotPasswordController extends Controller
{

    public function verifyEmail(Request $request)
    {
        $adminEmail = $request->adminEmail;
        $getEmails = Admin::pluck('email');
        foreach ($getEmails as $getEmail) {
            if($adminEmail==$getEmail){
                return "true";
            }
            else{
           return "false";
        }
        } 
    }
    public function resetPassword(Request $request){
        $adminEmail = $request->email;
         $data = [
            'message'       => '<H2>Hello test message</H2>',
            'custom_args'   => ['theater_id' => 112],
            'subject'       => 'Test Subject',
            'from'          => 'admin@gmail.com',
            'from_name'     => 'Mero Threater',
            'reply_to'      => 'es.binod.paneru@gmail.com',
            'reply_to_name' => 'Threater Admin',
            'category'      => 'category',
        ];
        $a=Mail::to($adminEmail)->send(new TheaterMail($data));
        dd($a);
    }
}
