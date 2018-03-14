<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentModel;

class PaymentController extends Controller
{
    
    public function index()
    {
        $data = PaymentModel::orderBy('created_at','desc')->get();
        return view('admin.payment.list',compact('data'));
    }

    
    public function create()
    {
         return view('admin.payment.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'image'=>'required',
            'description'=>'required',
            'status'=>'required'
        ]);

        $data = array(
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
        );

        if($request->hasFile('image'))
        {
            $img = $request->file('image');
            $filename = time(). uniqid(). '.' . $img->getClientOriginalExtension();
            $path = public_path('payment');
            $img->move($path,$filename);
            $data['image'] = $filename;
        }

        PaymentModel::create($data);

        return redirect('admin/content-management/payment-gateway');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $editdata = PaymentModel::where('id',$id)->first();
        return view('admin.payment.edit',compact('editdata'));
    }

    public function update(Request $request, $id)
    {
        
         $this->validate($request,[
            'name'=> 'required',
            'image'=>'sometimes|required|',
            'description'=>'required',
            'status'=>'required'
        ]);

        $data = array(
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
        );

        $detail = PaymentModel::where('id',$id)->first();

        if($request->hasFile('image'))
        {   
            if(file_exists(public_path('payment/'.$detail->image)))
                unlink(public_path('payment/'.$detail->image));
            $img = $request->file('image');
            $filename = time(). uniqid(). '.' . $img->getClientOriginalExtension();
            $path = public_path('payment');
            $img->move($path,$filename);
            $data['image'] = $filename;
        }

        PaymentModel::where('id',$id)->update($data);

        return redirect('admin/content-management/payment-gateway');
    }

    public function destroy(Request $request)
    {
         PaymentModel::where('id', $request->Id)->delete();
        return 'true';
    }
}
