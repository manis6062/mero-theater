<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ManagePagesModel;

class ManagePagesController extends Controller
{
    
    public function index()
    {
        $data = ManagePagesModel::orderBy('created_at','desc')->get();
        return view('admin.pages.list',compact('data'));
    }

   
    public function create()
    {
      return view('admin.pages.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'body'=>'required',
            'status'=>'required'
        ]);

        $data = array(
            'title'=>$request->title,
            'body'=>$request->body,
            'status'=>$request->status
        );

       $result =  ManagePagesModel::create($data);

         if (isset($result))
            return redirect('admin/content-management/manage-pages')->with('message', 'Pages Successfully Created !');
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editdata = ManagePagesModel::where('id',$id)->first();
        return view('admin.pages.edit',compact('editdata'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=> 'required',
            'body'=>'required',
            'status'=>'required'
        ]);

        $data = array(
            'title'=>$request->title,
            'body'=>$request->body,
            'status'=>$request->status
        );

        $result = ManagePagesModel::where('id',$id)->update($data);

         if (isset($result))
            return redirect('admin/content-management/manage-pages')->with('message', 'Pages Successfully Updated !');
    }

    public function destroy(Request $request)
    {
        ManagePagesModel::where('id', $request->Id)->delete();
        return 'true';
    }
}
