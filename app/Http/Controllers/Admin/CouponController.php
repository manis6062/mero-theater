<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $data = Coupon::orderBy('created_at','desc')->get();
        return view('admin.coupon.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->validate($request,[
            'code' => 'required',
            'discount_type' => 'required',
            'discount_rate'=>'required',
             'count'=>'numeric',
             'discount_rate'=>'numeric',
        ]);

        $data = array(
            'code'=>$request->code,
            'discount_type'=>$request->discount_type,
            'discount_rate'=>$request->discount_rate,
            'count'=>$request->count,
            'expire'=>$request->expire,
             'status'=>$request->status,
        );

        Coupon::create($data);

        return redirect('admin/coupon');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $editdata = Coupon::where('id',$id)->first();
        return view('admin.coupon.edit',compact('editdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request,[
            'code' => 'required',
            'discount_type' => 'required',
            'discount_rate'=>'required',
              'count'=>'numeric',
             'discount_rate'=>'numeric',
        ]);

        $data = array(
            'code'=>$request->code,
            'discount_type'=>$request->discount_type,
            'discount_rate'=>$request->discount_rate,
            'count'=>$request->count,
            'expire'=>$request->expire,
             'status'=>$request->status,
        );

         Coupon::where('id',$id)->update($data);

        return redirect('admin/coupon');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         Coupon::where('id', $request->Id)->delete();
        return 'true';
    }
}
