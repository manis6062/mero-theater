<?php

namespace App;
use App\CompanyModel;
use App\CounterModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guarded = ['id'];
    protected $table = 'admin_tbl';

    public  function  company()
    {
        return $this->hasOne('App\CompanyModel','admin_id');
    }

    public function counter(){
    	return $this->hasMany('App\CounterModel','admin_id');
    }
}
 
