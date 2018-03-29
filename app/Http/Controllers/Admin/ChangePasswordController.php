<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function index()
    {
        $id=\Auth::guard('admin')->id();
        return view('admin.settings.cpassword',compact('id'));
    }

    public function VerifyPassword(Request $request){
       $enteredPassword = $request->op;
       $oldPassword = Admin::find($request->aid)->password;
         //dd(bcrypt($enteredPassword)==$oldPassword);

       if(Hash::check($enteredPassword, $oldPassword)){
        return "true";
    }
    else{
        return "false";
    }
}

public function changePassword(Request $request){
   
   $this->validate($request,[
    'old_password'=> 'required',
    'password'=>'required|min:8',
    'password_confirmation'=>'required|same:password|min:8'
]);

   $enteredPassword = $request->old_password;
   $oldPassword = Admin::find($request->admin_id)->password;
   if(Hash::check($enteredPassword, $oldPassword)){
       $id = $request->admin_id;
       $npass= bcrypt($request->password);
       $upass= Admin::find($id);
       if($upass) {
            $upass->password = $npass;
            $upass->save();
    }
     if(isset($upass)){
            return redirect('admin/change_password')->with('message','Admin password Sucessfully Changed');
        }
}
else{
    return redirect('admin/change_password')->with('message','Admin password Cannot Changed.');;
} 



}
}
