<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NewsModel;
use App\ManageCategoryModel;

class NewsController extends Controller
{ 
    public function index()
    {
        $data = NewsModel::orderBy('created_at','desc')->get();
        return view('admin.news.list',compact('data'));
    }

    public function create()
    {
        $categories = ManageCategoryModel::orderBy('created_at','desc')->get();
        return view('admin.news.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'category' => 'required',
            'title' => 'required',
            'description'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required',
            'featured_image'=>'required',
            'caption'=>'required',
        ]);

        $data = array(
            'category'=>$request->category,
            'title'=>$request->title,
            'description'=>$request->description,
            'meta_title'=>$request->meta_title,
            'meta_description'=>$request->meta_description,
            'caption'=>$request->caption,
             'status'=>$request->status,
        );

        if($request->hasFile('featured_image'))
        {
            $img = $request->file('featured_image');
            $filename = time().uniqid(). '.' .$img->getClientOriginalExtension();
            $path = public_path('news');
            $img->move($path,$filename);
            $data['featured_image'] = $filename;
        }

        $result = NewsModel::create($data);

         if (isset($result))
            return redirect('admin/content-management/manage-news/news')->with('message', 'News Successfully Created !');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editdata = NewsModel::where('id',$id)->first();
        $categories = ManageCategoryModel::orderBy('created_at','desc')->get();
        return view('admin.news.edit',compact('editdata','categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'category'=> 'required',
            'title'=>'required',
            'description'=>'required',
            'meta_title'=>'required',
            'meta_description'=>'required',
            'featured_image'=>'sometimes|required',
            'caption'=>'required'
        ]);

        $data = array(
            'category'=>$request->category,
            'title'=>$request->title,
            'description'=>$request->description,
            'meta_title'=>$request->meta_title,
            'meta_description'=>$request->meta_description,
            'caption'=>$request->caption,
        );

        $detail = NewsModel::where('id',$id)->first();

        if($request->hasFile('featured_image'))
        {   if(file_exists(public_path('news/'.$detail->featured_image)))
                unlink(public_path('news/'.$detail->featured_image));
            $img = $request->file('featured_image');
            $filename = time().uniqid(). '.' .$img->getClientOriginalExtension();
            $path = public_path('news');
            $img->move($path,$filename);
            $data['featured_image'] = $filename;
        }

       $result = NewsModel::where('id',$id)->update($data);

          if (isset($result))
            return redirect('admin/content-management/manage-news/news')->with('message', 'News Successfully Updated !');
    }

    public function destroy(Request $request)
    {
        NewsModel::where('id', $request->Id)->delete();
        return 'true';
    }
}
