<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUsModel extends Model
{
    protected $table = 'contactus_tbl';
    protected $guarded = ['id'];
}
