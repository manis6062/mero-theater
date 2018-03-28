<?php

namespace App\Http\Controllers\CounterManagement;

use App\CounterModel;
use App\Screen\Screen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function Sodium\compare;

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
            'email' => $data['username'],
            'password' => $data['password']
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
