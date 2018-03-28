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

    public function filter(Request $request)
    {
     $date = $request->date;
     $type = $request->registered_type;
     if($date!='' || $type!=''){
       $data = CrmModel::whereDate('created_at', '=', date('Y-m-d', strtotime($date)))
       ->orwhere('registered_type',$type)
       ->paginate(10)->appends(['date','registered_type']);
       return view('admin.crm.list',compact('data'));
   }
   else{
    $data = CrmModel::paginate(10);
    return view('admin.crm.list',compact('data'));
}
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
        'mobile'=>'required |unique:user_tbl | max:10'
    ]);

    $data = array(
        'name'=>$request->name,
        'email'=>$request->email,
        'mobile'=>$request->mobile,
        'registered_type' => 'by admin'
    );        
    CrmModel::create($data);

    return redirect('admin/crm')->with('message','User has successfully added.');
}

public function importExcel(Request $request)
{
      $this->validate($request,[
        'name_list'=> 'required',
    ]);

    if(Input::hasFile('name_list')){
     $path = Input::file('name_list')->getRealPath();
     $data = Excel::load($path, function($reader){ })->get();
     $dataToImport = [];
     $count = 0;
     foreach ($data as $value) {
        if($value->getTitle() == 'Sheet1')
        {
            foreach ($value as $val) {
                $dataToImport[] = $val->toArray();
            }
        }

        if($value->getTitle() == null)
        {

            foreach ($data as $value) {
                $count++;
                if($count <= $data->count())
                {
                    $dataToImport[] = $value->toArray();
                }else{
                    break;
                }

            }
        }
    }
    
    $mobielValidationData = [];
    $emailValidationData = [];

    if($dataToImport != null){
        foreach ($dataToImport as $values) {
            if(isset($values['name']) && isset($values['email']) && isset($values['mobile']))
            {

                if(CrmModel::where('email', $values['email'])->first() == null )
                    {
                        if(CrmModel::where('mobile', $values['mobile'])->first() == null)
                            {   
                                 
                                $insert['name'] = $values['name'];
                                $insert['email'] = $values['email'];
                                $insert['mobile'] = $values['mobile'];
                                $insert['registered_type'] = 'from excel';
                                if ( is_numeric($insert['mobile'])&&strlen($insert['mobile'])<10) {
                                   return redirect('admin/crm/user/create')->with('invalidMoblieErrorData', 'The excel file contain invalid mobile');
                                } 
                                elseif (filter_var($insert['email'], FILTER_VALIDATE_EMAIL)) {
                                     $result = CrmModel::create($insert);
                                }
                                else {  
                                         return redirect('admin/crm/user/create')->with('invalidEmailErrorData', 'The excel file contain invalid email');
                                    }
                                
                            }else{
                                $mobielValidationData[] = $values['mobile'];     
                            }
                        
                    }else{
                        $emailValidationData[] = $values['email'];
                    }  
                }else{
                    echo "empty message";                }
                        // if(isset($result)){
                        //     dd('Insert Record successfully.');
                        // }
            }
        }

       if(count($mobielValidationData) > 0 && count($emailValidationData) > 0)
       {
        return redirect('admin/crm/user/create')->with('mobileErrorData', $mobielValidationData)->with('emailErrorData', $emailValidationData);
       }

       if(count($mobielValidationData) > 0 && count($emailValidationData) == 0)
       {
        return redirect('admin/crm/user/create')->with('mobileErrorData', $mobielValidationData);
       }

       if(count($mobielValidationData) == 0 && count($emailValidationData) > 0)
       {
        return redirect('admin/crm/user/create')->with('emailErrorData', $emailValidationData);
       }

       if(count($mobielValidationData) == 0 && count($emailValidationData) == 0)
       {
        return redirect('admin/crm')->with('message','Users have been successfully imported.');
       }
       //return redirect::back()->withErrors(['msg', $rem]);
        //return back()->with($rem);
        
    }else{
        
    }

}

    // public function show($id)
    // {
    //     //
    // }

public function getDownload(){
    $file= public_path(). "\download\demo.xlsx";   
    return response()->download($file);
}
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
            'mobile'=>'required|unique:user_tbl|max:10'
        ]);
    }

    // dd('test');
    $data = array(
        'name'=>$request->name,
        'email'=>$request->email,
        'mobile'=>$request->mobile,
    );        


    CrmModel::find($id)->update($data);

    return redirect('admin/crm')->with('message','Update successfull.');
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
