<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SocialMediaModel;


class SocialMediaController extends Controller
{
   
    public function index()
    {
        $data = SocialMediaModel::orderBy('created_at','desc')->get();
        return view('admin.socialmedia.list',compact('data'));
    }

    
    public function create()
    {
        return view('admin.socialmedia.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'link'=>'required|url',
            'icon'=>'required|dimensions:width=32,height=32|mimes:jpeg,jpg,bmp,png,svg'
        ]);

        $data = array(
            'name'=>$request->name,
            'link'=>$request->link
        );

        if($request->hasFile('icon'))
        {
            $img = $request->file('icon');
            $filename = time().uniqid(). '.' .$img->getClientOriginalExtension();
            $path = public_path('socialmedia');
            $img->move($path,$filename);
            $data['icon'] = $filename;
        }

        $result = SocialMediaModel::create($data);

         if (isset($result))
            return redirect('admin/content-management/social-media')->with('message', 'Social Media Successfully Created !');
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editdata = SocialMediaModel::where('id',$id)->first();
        return view('admin.socialmedia.edit',compact('editdata'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=> 'required',
            'link'=>'required|url',
            'icon'=>'sometimes|required|dimensions:width=32,height=32|mimes:jpeg,jpg,bmp,png,svg'
        ]);

        $data = array(
            'name'=>$request->name,
            'link'=>$request->link
        );

        $detail = SocialMediaModel::where('id',$id)->first();
        if($request->hasFile('icon'))
        {   
            if(file_exists(public_path('socialmedia/'.$detail->icon)))
                unlink(public_path('socialmedia/'.$detail->icon));
            $img = $request->file('icon');
            $filename = time().uniqid(). '.' .$img->getClientOriginalExtension();
            $path = public_path('socialmedia');
            $img->move($path,$filename);
            $data['icon'] = $filename;
        }

        $result = SocialMediaModel::where('id',$id)->update($data);

          if (isset($result))
            return redirect('admin/content-management/social-media')->with('message', 'Social Media Successfully Updated !');
    }

   
    public function destroy(Request $request)
    {
        SocialMediaModel::where('id', $request->Id)->delete();
        return 'true';
    }
}
