<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CounterModel extends Authenticatable
{
    protected $table = 'counter_tbl';
    protected $guarded = ['id'];

     public function admin()
    {
        return $this->belongsTo('App\Admin','admin_id');
    }

    public function getFullNameAttribute()
    {
        return ucwords($this->first_name).' '.ucwords($this->last_name);
    }
}
