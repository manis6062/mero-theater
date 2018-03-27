<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\CompanyModel;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
class ProfileController extends Controller
{

	public function index()
	{
		 $editdata=\App\CompanyModel::with('admin')->get();
        return view('admin.profile.update', compact('editdata'));
	}

	public function update(Request $request, $id)
	{	
		$this->validate($request,[
        'account_name'=> 'required',
        'title'=>'required',
        'fname'=> 'required',
        'lname'=> 'required',
        'mobile'=> 'required',
        'company_name'=> 'required',
        'company_display_name'=>'required:8',
        'vat_number'=> 'required',
        'country'=>'required',
        'timezone'=> 'required',
        'address1'=>'required',
        'address2'=>'required'
    ]);
		$admindata = array(
			'account_name'=> $request->account_name,
	        'title'=> $request->title,
	        'first_name'=> $request->fname,
	        'last_name'=> $request->lname,
	        'mobile'=> $request->mobile 
		);

		
		
		$a=Admin::find($id)->update($admindata);

		$companydata = array(
			'company_name'=>$request->company_name,
	        'company_display_name'=>$request->company_display_name,
	        'vat_number'=>$request->vat_number,
	        'country'=>$request->country,
	        'timezone'=>$request->timezone,
	        'address1'=>$request->address1,
	        'address2'=>$request->address2
		);
		CompanyModel::find($id)->update($companydata);
		return redirect('admin/profile');
	}
}
