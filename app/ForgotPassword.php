<?php

namespace App;
use App\CompanyModel;
use App\CounterModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class forgotPassword extends Authenticatable
{
    protected $guarded = ['id'];
    protected $table = 'forgotpassword_tbl';

   
      public function admin()
    {
        return $this->belongsTo('App\Admin','admin_id');
    }
}
 
