<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NotificationModel;

class NotificationController extends Controller
{
    
    public function index()
    {
        $data = NotificationModel::orderBy('created_at','desc')->get();
        return view('admin.notification.list',compact('data'));
    }

    public function create()
    {
        return view('admin.notification.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'text' => 'required'
        ]);

        $data = array(
            'name'=>$request->name,
            'text'=>$request->text,
            'status'=>$request->status
        );

        $result = NotificationModel::create($data);

          if (isset($result))
            return redirect('admin/content-management/notification/footer')->with('message', 'Notification Successfully Created !');
    }

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $editdata = NotificationModel::where('id',$id)->first();
        return view('admin.notification.edit',compact('editdata'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'text' => 'required'
        ]);

        $data = array(
            'name'=>$request->name,
            'text'=>$request->text,
            'status'=>$request->status
        );

        $result =  NotificationModel::where('id',$id)->update($data);

           if (isset($result))
            return redirect('admin/content-management/notification/footer')->with('message', 'Notification Successfully Created !');
    }

    public function destroy(Request $request)
    {
        NotificationModel::where('id', $request->Id)->delete();
        return 'true';
    }
}
