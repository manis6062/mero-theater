<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CrmModel;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
class CrmController extends Controller
{

    public function index()
    {
        $data = CrmModel::paginate(10);
        return view('admin.crm.list',compact('data'));
    }

    
    public function create()
    {
       return view('admin.crm.create');
   }

   public function store(Request $request)
   {
    $this->validate($request,[
        'name'=> 'required',
        'email'=>'required | unique:user_tbl',
        'mobile'=>'unique:user_tbl'
    ]);

    $data = array(
        'name'=>$request->name,
        'email'=>$request->email,
        'mobile'=>$request->mobile,
        'registered_type' => 'by admin'
    );        
    CrmModel::create($data);

    return redirect('admin/crm');
}

public function importExcel()
{
    if(Input::hasFile('name_list')){
        $path = Input::file('name_list')->getRealPath();
        $data = Excel::load($path, function($reader){ })->get();
        dd(($data));
        $sheetZeroValue = $data[0];
        dd(count($data[0]));
        if(count($data)==1){


            if(!empty($data) && count($data) > 0){
                $cnt = 0;
                $testArr = [];
                foreach ($data as $key => $value) {
                    $testArr[] = $value;
                }

                foreach ($testArr[0] as $value) {
                    if(isset($value['name']) && isset($value['email']) && isset($value['mobile']))
                    {
                        $insert['name'] = $value['name'];
                        $insert['email'] = $value['email'];
                        $insert['mobile'] = $value['mobile'];
                        $insert['registered_type'] = 'from excel';
                        $result = CrmModel::create($insert);
                    }
                    if(isset($result)){
                        dd('Insert Record successfully.');
                    }
                }

            }
        }
        else{
            dd('test');
        }
    }
    return back();
}

    // public function show($id)
    // {
    //     //
    // }

public function edit($id)
{
    $editdata = CrmModel::where('id',$id)->first();
    return view('admin.crm.edit',compact('editdata'));
}

public function update(Request $request, $id)
{
    $existingEmail = CrmModel::find($id)->email;
    $newEmail = $request->email;
    // echo $existingEmail;
    // echo $newEmail;

    $existingMobile = CrmModel::find($id)->mobile;
    // echo 'existing is :'.$existingMobile;
    $newMobile = $request->mobile;
    // echo 'new is :'.$newMobile;
    if($existingEmail == $newEmail && $existingMobile == $newMobile)
    {
        // dd('1');
        $this->validate($request,[
            'name'=> 'required',
            'email'=>'required',
            'mobile'=>'required'
        ]);
    }elseif($existingEmail != $newEmail && $existingMobile == $newMobile){
        // dd('2');
        $this->validate($request,[
            'name'=> 'required',
            'email'=>'required|unique:user_tbl',
            'mobile'=>'required'
        ]);
    }elseif($existingEmail == $newEmail && $existingMobile != $newMobile){
        // dd('3');
        $this->validate($request,[
            'name'=> 'required',
            'email'=>'required',
            'mobile'=>'required|unique:user_tbl'
        ]);
    }

    // dd('test');
    $data = array(
        'name'=>$request->name,
        'email'=>$request->email,
        'mobile'=>$request->mobile,
    );        
    

    CrmModel::find($id)->update($data);

     return redirect('admin/crm');
}

    public function destroy(Request $request)
    {
         $result = CrmModel::find($request->uid)->delete();
         if ($result) {
            return 'true';
         }
        return 'false';
    }
    public function suspend(Request $request)
    {
        $currentStatus = CrmModel::find($request->uid)->suspend;

        if($currentStatus == 'no')
        {
            $result = CrmModel::find($request->uid)->update(['suspend' => 'yes']);
        }else{
            $result = CrmModel::find($request->uid)->update(['suspend' => 'no']);
        }
        
         if ($result) {
            return 'true';
         }
        return 'false';
    }
}
