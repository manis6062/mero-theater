<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactUsModel;

class ContactUsController extends Controller
{
   
    public function index()
    {
        $data = ContactUsModel::orderBy('created_at','desc')->get();
        return view('admin.contactus.list',compact('data'));
    }


    public function create()
    {
         return view('admin.contactus.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'email'=>'required|email',
            // 'phone_no'=>'required|numeric|min:6|max:12',
            'status'=>'required'
        ]);

        $data = array(
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_no'=>$request->phone_no,
            'status'=>$request->status,
            'message'=>$request->message
        );

        $result = ContactUsModel::create($data);

         if (isset($result))
            return redirect('admin/content-management/contact-us')->with('message', 'Contact Us Successfully Created !');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $editdata = ContactUsModel::where('id',$id)->first();
        return view('admin.contactus.edit',compact('editdata'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=> 'required',
            'email'=>'required|email',
            // 'phone_no'=>'required|numeric|min:6|max:12',
            'status'=>'required'
        ]);

        $data = array(
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_no'=>$request->phone_no,
            'message'=>$request->message,
             'status'=>$request->status
        );

       $result =  ContactUsModel::where('id',$id)->update($data);

       if (isset($result))
            return redirect('admin/content-management/contact-us')->with('message', 'Contact Us Successfully Updated !');
    }

    public function destroy(Request $request)
    {
        ContactUsModel::where('id', $request->Id)->delete();
        return 'true';
    }
}
