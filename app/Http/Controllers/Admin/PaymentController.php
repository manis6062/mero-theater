<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentModel;
use App\PaymentApi;
use DB;

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
            'status'=>'required',

        ]);

        $data = array(
            'name'=>$request->name,
            'status'=>$request->status,
            'contact_person'=>$request->contact_person,
            'phone'=>$request->phone,
            'gateway_id'=>$request->gateway_id,
        );

        if($request->hasFile('image'))
        {
            $img = $request->file('image');
            $filename = time(). uniqid(). '.' . $img->getClientOriginalExtension();
            $path = public_path('payment');
            $img->move($path,$filename);
            $data['image'] = $filename;
        }

        $result = PaymentModel::create($data);

        if (isset($result))
            return redirect('admin/content-management/payment-gateway')->with('message', 'Payment Method Successfully Created !');
    }



     public function payment_api_insert_live(Request $request)
    {
        $this->validate($request,[
            'label'=> 'required',
            'api_key'=>'required',

        ]);

        $data = array(
            'label'=>$request->label,
            'api_key'=>$request->api_key,
            'payment_type_id'=>$request->payment_type_id,
            'api_type'=>$request->api_type,
        );
        PaymentApi::create($data);

       return redirect()->back();
    }


     public function payment_api_live_note(Request $request , $id)
    {
        $this->validate($request,[
            'live_note'=> 'required',
        ]);

        $data = array(
            'live_note'=>$request->live_note,
        );
      PaymentModel::where('id',$id)->update($data);
       return redirect()->back();
    }

      public function payment_api_test_note(Request $request , $id)
    {
        $this->validate($request,[
            'test_note'=> 'required',
        ]);

        $data = array(
            'test_note'=>$request->test_note,
        );
      PaymentModel::where('id',$id)->update($data);
       return redirect()->back();
    }



    public function payment_api_update(Request $request , $id)
    {
        $this->validate($request,[
            'label'=> 'required',
            'api_key'=>'required',

        ]);

        $data = array(
            'label'=>$request->label,
            'api_key'=>$request->api_key,
            'payment_type_id'=>$request->payment_type_id,
            'api_type'=>$request->api_type,
        );
        PaymentApi::where('id',$id)->update($data);

       return redirect()->back();
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

     public function api_details($id)
    {
        $payment_type_id = $id;
        $payment_api_details = PaymentModel::all()->where('id' , $id)->first();
        $payment_apis = PaymentApi::where('payment_type_id',$id)->where('api_type' , 'live')->get();
        $payment_apis_test = PaymentApi::where('payment_type_id',$id)->where('api_type' , 'test')->get();
        return view('admin.payment.api_details',compact('payment_type_id' , 'payment_apis' , 'payment_apis_test' , 'payment_api_details'));
    }

    public function update(Request $request, $id)
    {
        
         $this->validate($request,[
            'name'=> 'required',
            'image'=>'sometimes|required|',
            'status'=>'required',

        ]);

        $data = array(
             'name'=>$request->name,
            'status'=>$request->status,
            'contact_person'=>$request->contact_person,
            'phone'=>$request->phone,
            'gateway_id'=>$request->gateway_id,
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

       $result = PaymentModel::where('id',$id)->update($data);

        if (isset($result))
            return redirect('admin/content-management/payment-gateway')->with('message', 'Payment Method Successfully Updated !');
    }

    public function destroy(Request $request)
    {
         PaymentModel::where('id', $request->Id)->delete();
        return 'true';
    }


    public function payment_api_delete(Request $request)
    {
         PaymentApi::where('id', $request->Id)->delete();
        return 'true';
    }


      public function payment_api_field_live(Request $request)
    {
        $payment_type_id = $request->payment_type_id;
        $url = url('admin/content-management/payment_api_insert/submit');
            $form = '<form class="form" role="form" autocomplete="off" action="' . $url . '"  method="post" id="createForm" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="' .csrf_token() .'">
             <input type="hidden" name="api_type" value="live">
             <input type="hidden" name="payment_type_id" value="' . $payment_type_id .'">
                                                <div class="row">
                                                    <div class="col-lg-4"><div class="form-group">
                                                    <label>Label</label>
                                                    <div class="input-group">
                                                      <input type="text" class="form-control label_field" placeholder="Public Key" name="label">
                                                    </div>
                                                </div></div>
                                                     <div class="col-lg-6"><div class="form-group">
                                                    <label>Key</label>
                                                    <div class="input-group">
                                                      <input type="text" class="form-control" placeholder="2ihfddfjodiuyf9" name="api_key"> 
                                                    </div>
                                                </div></div>
                                                 <div class="col-lg-2"><div class="form-group" style="margin-top: 30px;">
                                                    <div class="input-group">
                                                      <button type="submit" class="btn btn-default">
                                                          Create
                                                      </button>
                                                    </div>
                                                </div></div>
                                                </div>
                                            </form>'; 
            return $form;
        }

       public function payment_api_field_test(Request $request)
    {
        $payment_type_id = $request->payment_type_id;
        $url = url('admin/content-management/payment_api_insert/submit');
            $form = '<form class="form" role="form" autocomplete="off" action="' . $url . '"  method="post" id="createForm" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="' .csrf_token() .'">
             <input type="hidden" name="api_type" value="test">
             <input type="hidden" name="payment_type_id" value="' . $payment_type_id .'">
                                                <div class="row">
                                                    <div class="col-lg-4"><div class="form-group">
                                                    <label>Label</label>
                                                    <div class="input-group">
                                                      <input type="text" class="form-control label_field" placeholder="Public Key" name="label">
                                                    </div>
                                                </div></div>
                                                     <div class="col-lg-6"><div class="form-group">
                                                    <label>Key</label>
                                                    <div class="input-group">
                                                      <input type="text" class="form-control" placeholder="2ihfddfjodiuyf9" name="api_key"> 
                                                    </div>
                                                </div></div>
                                                 <div class="col-lg-2"><div class="form-group" style="margin-top: 30px;">
                                                    <div class="input-group">
                                                      <button type="submit" class="btn btn-default">
                                                          Create
                                                      </button>
                                                    </div>
                                                </div></div>
                                                </div>
                                            </form>'; 
            return $form;
        }
    
}
