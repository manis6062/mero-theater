<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PromotionalBannerModel;

class PromotionalBannerController extends Controller
{
   public function index()
   {
   	$data = PromotionalBannerModel::orderBy('created_at','desc')->get();
   	return view('admin.promotionalbanner.list',compact('data'));
   } 

   public function add()
   {
   	return view('admin.promotionalbanner.create');
   }

   public function submit(Request $request)
   {
	   	$this->validate($request,[
	   		'banner_name' => 'required',
	   		'image'=>'required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg'
	   	]);

	   	$data = array(
	   		'banner_name' => $request->banner_name,
	   		'description' => $request->description,
	   		'link' => $request->link,
	   	);

	   	if($request->hasFile('image'))
	   	{
	   		$img = $request->file('image');
	   		$filename = time().uniqid(). '.' .$img->getClientOriginalExtension();
	   		$path = public_path('promotional-banner');
	   		$img->move($path,$filename);
	   		$data['image'] = $filename;
	   	}

	   	PromotionalBannerModel::create($data);

	   	return redirect('admin/content-management/promotional-banner');

   }

   public function edit($id)
   {	
   		$editdata = PromotionalBannerModel::where('id',$id)->first();
   		return view('admin.promotionalbanner.edit',compact('editdata'));
   }

   public function update(Request $request,$id)
   {
   		$this->validate($request,[
	   		'banner_name' => 'required',
	   		'image'=>'sometimes|required|dimensions:width=25,height=25|mimes:jpeg,jpg,bmp,png,svg'
	   	]);

	   	$data = array(
	   		'banner_name' => $request->banner_name,
	   		'description' => $request->description,
	   		'link' => $request->link,
	   	);

	   	$previousdata = PromotionalBannerModel::where('id',$id)->first();

	   	if($request->hasFile('image'))
	   	{
	   		if(file_exists(public_path('promotional-banner/'.$previousdata->image)))
	   			unlink(public_path('promotional-banner/'.$previousdata->image));
	   		$img = $request->file('image');
	   		$filename = time().uniqid(). '.' .$img->getClientOriginalExtension();
	   		$path = public_path('promotional-banner');
	   		$img->move($path,$filename);
	   		$data['image'] = $filename;
	   	}

	   	PromotionalBannerModel::where('id',$id)->update($data);

	   	return redirect('admin/content-management/promotional-banner');
   }
   public function delete(Request $request)
   {
   	  $Id = $request->Id;
   	  PromotionalBannerModel::find($Id)->delete();
   	  return 'true';
   }
}
