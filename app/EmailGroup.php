<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailGroup extends Model
{
    protected $guarded = ['id'];
    protected $table = 'emailgroup_tbl';

    public function emailcontacts(){
        return $this->belongsToMany('App\EmailContact','EmailContact_EmailGroup_tbl')->withTimestamps();
    }


    public function countContact(){
        return $this->hasMany('App\EmailContactGroup', 'emailgroup_id')->count();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
