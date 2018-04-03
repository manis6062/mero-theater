<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\ForgotPassword;
use Carbon\Carbon;
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

   public function generateUniqueToken($adminEmail){
    $characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomtoken = str_shuffle($characters);
    $check = ForgotPassword::where('token', $randomtoken)->count();
    if($check > 0)
    {
        $this->generateUniqueToken($adminEmail);
    }else{
        return $randomtoken;
    }

}
public function resetPassword(Request $request)
{
    $baseurl = URL('/');
    $adminEmail = $request->email;
    $adminId = Admin::where('email',$adminEmail)->first()->id;
    
    if(isset($adminEmail)){
       $newToken = $this->generateUniqueToken($adminEmail);
       $newPasswordResetToken = new ForgotPassword;
       $newPasswordResetToken->token=$newToken;
       $newPasswordResetToken->admin_id=$adminId;
       $newPasswordResetToken->save();   
   }
   $urlLifespan=ForgotPassword::where('token',$newToken)->first()->created_at->format('H:i:s');
   $data = [
    'message'       => '<H2>password Reset Link</H2></br><h3>click this link to reset you password</h3></br><a href="'.$baseurl.'/forgot-password/password-reset?token='.$newToken.'">Click Here</a>',
    'subject'       => 'Password Reset',
    'from'          => $adminEmail,
    'from_name'     => 'Mero Threater',
    'reply_to'      => $adminEmail,
    'reply_to_name' => 'Threater Admin',
    'category'      => 'category',
];
$a=Mail::to($adminEmail)->send(new TheaterMail($data));
return redirect('admin')->with('message','your password reset link has sent to your email');
}

public function verifyURL(Request $request){
    $passwordToken = $request->token;
    $urlTime = ForgotPassword::where('token',$passwordToken)->first()->created_at;
    $current =Carbon::now();
    $urlDateTime=Carbon::parse($urlTime);
    //dd($current->diffIndays($urlDateTime));
    if($current->diffInminutes($urlDateTime)<30 && $current->diffIndays($urlDateTime)==0 ){
        // $this->getNewPassword($passwordToken);
        return view('admin.newpassword',compact('passwordToken'));
    }else{
       return redirect('admin')->with('message','your link has been expired. Please request for new url');
   }

}

public function getNewPassword(Request $request){
    $urlToken=$request->urltoken;
    $adminId = ForgotPassword::where('token',$urlToken)->first()->admin_id;
    $this->validate($request,[
        'password'=> 'required|min:8',
        'confirm_password'=>'required | same:password|min:8',
    ]);
    $newpassword=bcrypt($request->password);
    $newpass= Admin::find($adminId);
    if($newpass) {
        $newpass->password = $newpassword;
        $newpass->save();
    }
    if(isset($newpass)){
        return redirect('admin')->with('message','Admin password Sucessfully reset');
    }
else{
    return redirect('admin')->with('message','Admin password Cannot reset.');;
}
}

}
