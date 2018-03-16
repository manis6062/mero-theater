<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
    public function index(Request $request)
    {
    	$this->validate($request,[
    		'username'=>'required',
    		'password'=>'required'
    	]);

    	$data = $request->all();

    	$check  = Auth::guard('admin')->attempt([
    		'email'=>$data['username'],
    		'password'=>$data['password']
    	]);

    	if($check)
    	{
    	    Admin::find(Auth::guard('admin')->user()->id)->update(['login_time' => Carbon::now()]);
    		return redirect('admin/dashboard');
    	}
    	return redirect('admin')->with('error','Invalid Credential  !')->withInput();
 
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin');
    }
}
