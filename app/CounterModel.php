<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CounterModel extends Authenticatable
{
    protected $table = 'counter_tbl';
    protected $guarded = ['id'];
}
