<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmModel extends Model
{
    protected $table = 'user_tbl';
    protected $guarded = ['id'];
}
