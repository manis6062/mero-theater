<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MovieModel extends Model
{
    public function store($data)
    {
    	DB::table('movie_tbl')->insert($data);
    }

    public function listofmovies()
    {
    	 return DB::table('movie_tbl')->orderBy('created_at','desc')->get();
    }
    public function getrequestedmovie($movieid)
    {
    	return DB::table('movie_tbl')->where('id',$movieid)->get()->first();
    }

    public function updatedata($data,$mid)
    {
    	$updated = DB::table('movie_tbl')->where('id',$mid)->update($data);
    	if($updated)
    		return true;

    	return false;
    }

    public function deletedata($movieid)
    {
    	$deleted = DB::table('movie_tbl')->where('id',$movieid)->delete();
    	if($deleted)
    		return true;
    	return false;
    }

    public function newstatus($movieid)
    {
    	$moviestatus = $this->getrequestedmovie($movieid);
    	if($moviestatus->status=="active")
    	{
    		$data['status'] = "inactive"; 
    	}
    	$newstatuschanged = DB::table('movie_tbl')->where('id',$movieid)->update($data);
    	if($newstatuschanged)
    		return true;

    	return false;
    }
}
