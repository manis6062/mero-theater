<?php

namespace App\Http\Controllers\Admin;

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

    	$check  = Auth::guard('theatre_admin')->attempt([
    		'email'=>$data['username'],
    		'password'=>$data['password']
    	]);

    	if($check)
    	{  
    		return redirect('theatre_admin/dashboard');
    	}
    	return redirect('theatre_admin')->with('error','Invalid Credential  !')->withInput();
 
    }

    public function logout()
    {
        Auth::guard('theatre_admin')->logout();
        return redirect('theatre_admin');
    }
}
