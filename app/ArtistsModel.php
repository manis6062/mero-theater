<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ArtistsModel extends Model
{
    protected $table = 'artists_tbl';
    protected $guarded = ['id'];

    public function store($data)
    {
    	DB::table('artists_tbl')->insert($data);
    }

    public function listofartists()
    {
    	 return DB::table('artists_tbl')->orderBy('created_at','desc')->get();
    }
    public function getrequestedartist($artistid)
    {
    	return DB::table('artists_tbl')->where('id',$artistid)->get()->first();
    }

    public function updatedata($data,$aid)
    {
    	$updated = DB::table('artists_tbl')->where('id',$aid)->update($data);
    	if($updated)
    		return true;

    	return false;
    }

    public function deletedata($artistsid)
    {
    	$deleted = DB::table('artists_tbl')->where('id',$artistsid)->delete();
    	if($deleted)
    		return true;
    	return false;
    }
}
