<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CounterModel;
use Hash;
class CounterController extends Controller
{

    public function index()
    {
        $data = CounterModel::paginate(10);
        return view('admin.counter.list',compact('data'));
    }

    
    public function create()
    {
       return view('admin.counter.create');
   }

   public function store(Request $request)
   {
    $password = $request->password;
    $passwordenc = bcrypt('password');
    $this->validate($request,[
        'counter_number'=> 'required | unique:counter_tbl',
        'fname'=> 'required',
        'lname'=> 'required',
        'designation'=> 'required',
        'username'=> 'required',
        'password'=> 'required',
        'email'=>'required | unique:counter_tbl',
        'mobile'=>'unique:counter_tbl'
    ]);

    $data = array(
        'counter_number'=> $request->counter_number,
        'first_name'=> $request->fname,
        'last_name'=> $request->lname,
        'designation'=> $request->designation,
        'username'=> $request->username,
        'password'=>  $passwordenc,
        'email'=>$request->email,
        'mobile'=>$request->mobile
    );        
    CounterModel::create($data);

    return redirect('admin/counter');
}

public function edit($id)
{
    $editdata = CounterModel::where('id',$id)->first();
    $counterNumbers = CounterModel::pluck('counter_number')->toArray();
    $usernames = CounterModel::pluck('username')->toArray();
    $emails = CounterModel::pluck('email')->toArray();
    $mobiles = CounterModel::pluck('mobile')->toArray();
    return view('admin.counter.edit',compact('editdata','counterNumbers','usernames','mobiles','emails'));
}

public function update(Request $request, $id)
{
    $this->validate($request,[
        'counter_number'=> 'required',
        'fname'=> 'required',
        'lname'=> 'required',
        'designation'=> 'required',
        'username'=> 'required',
        'password'=>'min:8',
        'email'=>'required'
    ]);
    $password = $request->password;
    if($password==''){
         $data = array(
        'counter_number'=> $request->counter_number,
        'first_name'=> $request->fname,
        'last_name'=> $request->lname,
        'designation'=> $request->designation,
        'username'=> $request->username,
        'email'=>$request->email,
        'mobile'=>$request->mobile
    );
        CounterModel::find($id)->update($data);
    }else{
         $passwordenc = Hash::make('password');
         $data = array(
        'counter_number'=> $request->counter_number,
        'first_name'=> $request->fname,
        'last_name'=> $request->lname,
        'designation'=> $request->designation,
        'username'=> $request->username,
        'password'=>  $passwordenc,
        'email'=>$request->email,
        'mobile'=>$request->mobile
    );
          CounterModel::find($id)->update($data);
    }
    return redirect('admin/counter');
}

    public function destroy(Request $request)
    {
         $result = CounterModel::find($request->uid)->delete();
         if ($result) {
            return 'true';
         }
        return 'false';
    }

    public function suspend(Request $request)
    {
        $currentStatus = CounterModel::find($request->uid)->suspend;

        if($currentStatus == 'no')
        {
            $result = CounterModel::find($request->uid)->update(['suspend' => 'yes']);
        }else{
            $result = CounterModel::find($request->uid)->update(['suspend' => 'no']);
        }
        
         if ($result) {
            return 'true';
         }
        return 'false';
    }
}
