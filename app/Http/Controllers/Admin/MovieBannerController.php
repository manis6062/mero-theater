<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MovieBannerModel;

class MovieBannerController extends Controller
{
    
    public function index()
    {
        $data = MovieBannerModel::orderBy('created_at','desc')->get();
        return view('admin.moviebanner.list',compact('data'));
    }

    
    public function create()
    {
         return view('admin.moviebanner.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'image'=>'required',
        ]);

        $data = array(
            'name'=>$request->name,
            'description'=>$request->description,
            'link'=>$request->link,
            'status'=>$request->status
        );

        if($request->hasFile('image'))
        {   
            $img = $request->file('image');
            $filename = time(). uniqid(). '.' . $img->getClientOriginalExtension();
            $path = public_path('moviebanner');
            $img->move($path,$filename);
            $data['image'] = $filename;
        }

        MovieBannerModel::create($data);

        return redirect('admin/content-management/movie-banner');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editdata = MovieBannerModel::where('id',$id)->first();
        return view('admin.moviebanner.edit',compact('editdata'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=> 'required',
            'image'=>'sometimes|required|mimes:jpeg,jpg,bmp,png,svg|max:2048',
        ]);

        $data = array(
            'name'=>$request->name,
            'description'=>$request->description,
            'link'=>$request->link,
            'status'=>$request->status
        );

        $detail = MovieBannerModel::where('id',$id)->first();

        if($request->hasFile('image'))
        {   if(file_exists(public_path('moviebanner/'.$detail->image)))
                unlink(public_path('moviebanner/'.$detail->image));
            $img = $request->file('image');
            $filename = time(). uniqid(). '.' . $img->getClientOriginalExtension();
            $path = public_path('moviebanner');
            $img->move($path,$filename);
            $data['image'] = $filename;
        }

        MovieBannerModel::where('id',$id)->update($data);

        return redirect('admin/content-management/movie-banner');
    }

    public function destroy($id)
    {
        MovieBannerModel::where('id', $request->Id)->delete();
        return 'true';
    }
}
