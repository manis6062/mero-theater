<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InquiryModel extends Model
{
    protected $table = 'inquiry_tbl';
    protected $guarded = ['id'];
}
