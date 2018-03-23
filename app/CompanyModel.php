<?php

namespace App;
use App\Admin;

use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    protected $table = 'company_tbl';
    protected $guarded = ['id'];
    
    public function admin()
    {
        return $this->belongsTo('App\Admin','admin_id');
    }
}
