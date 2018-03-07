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
}
