<?php

namespace App\Http\Controllers\CounterManagement;

use App\CounterModel;
use App\Screen\Screen;
use Carbon\Carbon;
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
            if(Auth::guard('counter')->user()->suspend == 'Yes')
            {
                Auth::guard('counter')->logout();
                return redirect('counter-management')->with('error','You have been suspended  !')->withInput();
            }
            return redirect('counter-management/dashboard');
        }
        return redirect('counter-management')->with('error','Invalid Credential  !')->withInput();

    }

    public function logout()
    {
        CounterModel::find(Auth::guard('counter')->user()->id)->update(['last_login_time' => Carbon::now()]);
        Auth::guard('counter')->logout();
        return redirect('counter-management');
    }
}
