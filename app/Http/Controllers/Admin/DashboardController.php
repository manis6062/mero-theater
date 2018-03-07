<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\MovieTheatreScreens;

class DashboardController extends Controller
{	
    function index()
    {
    	$user = Auth::guard('theatre_admin')->user()->id;
    	$screens = DB::table('movie_theatre_screens')->where('theatre_admin_id',$user)->paginate();	
    	return view('admin.dashboard.index',['screens'=>$screens]);
    }

    function screenwiseseats($adminid,$scid)
    {
    	$seats = DB::table('movie_theatre_screen_seats')->where('theatre_admin_id',$adminid)->where('screen_id',$scid)->paginate()->first();
    	return view('admin.dashboard.seats',['seats'=> $seats]);
    }

    function screenwiseschedule($adminid,$scid)
    {
    	$scheduledmovies = DB::table('scheduled_movies')->where('theatre_admin_id',$adminid)->where('screen_id',$scid)->paginate();
    	return view('admin.dashboard.scheduledmovie',['scheduledmovie'=> $scheduledmovies]);
    }

    function screenwiseprice($adminid,$scid)
    {
    	return view('admin.dashboard.pricecart');
    }

    function editscreen($adminid,$scid)
    {
    	$screenedit = DB::table('movie_theatre_screens')->where('theatre_admin_id',$adminid)->where('id',$scid)->paginate()->first();

    	return view('admin.dashboard.screenedit',['screenedit'=> $screenedit]);
    }

    function editprocess(Request $request)
    {
    	$this->validate($request,['screen_name'=>'required']);

    	$name = $request->screen_name;
    	$id = $request->screen_name_id;

    	$update = DB::table('movie_theatre_screens')->where('id',$id)->update(['name'=>$name]);
    	if($update)
    	{
    		echo "Updated.";
    	}
    	return redirect('theatre_admin/dashboard');
    }

    function addscreen()
    {
    	return view('admin.dashboard.screenadd');
    }

    function addprocess(Request $request)
    {	

    	$this->validate($request,['screen_name'=>'required']);

    	$name = $request->screen_name;
    	$user = Auth::guard('theatre_admin')->user()->id;
    	$theatreadmintheatre = DB::table('movie_theatre_admin_theatres')->get()->first();
    	$thadmtheatre = $theatreadmintheatre->id;

    	$add = DB::table('movie_theatre_screens')->insert(['name'=>$name,'theatre_admin_id'=>$user,'theatre_id'=>$thadmtheatre,'slug'=>$name]);
    	if($add)
    	{
    		echo "Added";
    	}
    	return redirect('theatre_admin/dashboard');
    }

    function delete(Request $request)
    {
        $data = $request->all();
        $result = MovieTheatreScreens::find($data['delete-id'])->delete();
        if($result)
            redirect('theatre_admin/dashboard');
        
    }
}
