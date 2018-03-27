<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ManageCategoryModel;

class ManageCategoryController extends Controller
{
    public function index()
    {
        $data = ManageCategoryModel::orderBy('created_at','desc')->get();
        return view('admin.category.list',compact('data'));
    }

    
    public function create()
    {
        return view('admin.category.create');
    }

 
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_name'=> 'required',
        ]);

        $data = array(
            'category_name'=>$request->category_name,
            'description'=>$request->description
        );

        ManageCategoryModel::create($data);

        return redirect('admin/content-management/manage-news/manage-category');
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        $editdata = ManageCategoryModel::where('id',$id)->first();
        return view('admin.category.edit',compact('editdata'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'category_name'=> 'required',
        ]);

        $data = array(
            'category_name'=>$request->category_name,
            'description'=>$request->description
        );

        ManageCategoryModel::where('id',$id)->update($data);

        return redirect('admin/content-management/manage-news/manage-category');
    }

    public function destroy(Request $request)
    {
        ManageCategoryModel::where('id', $request->Id)->delete();
        return 'true';
    }
}
