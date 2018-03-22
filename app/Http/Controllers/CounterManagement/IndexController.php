<?php

namespace App\Http\Controllers\CounterManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        return view('counter-management.login');
    }

    public function validation(Request $request)
    {
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);

        $data = $request->all();

        $check  = Auth::guard('counter')->attempt([
            'email'=>$data['username'],
            'password'=>$data['password']
        ]);

        if($check)
        {
            return redirect('counter-management/dashboard');
        }
        return redirect('counter-management')->with('error','Invalid Credential  !')->withInput();

    }

    public function logout()
    {
        Auth::guard('counter')->logout();
        return redirect('counter-management');
    }
}
