<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use EmailGroup;

class EmailContact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $table = 'emailcontacts_tbl';

    /**
     * Getting groups
     */
    public function groups(){
        return $this->belongsToMany('App\EmailGroup','EmailContact_EmailGroup_tbl','emailcontact_id','emailgroup_id')->withTimestamps();
    }


    public function user()
    {
        return $this->belongsTo('App\Admin', 'admin_id');
    }
}
