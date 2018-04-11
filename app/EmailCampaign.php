<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model
{
     protected $table = 'emailcampaign_tbl';
    protected $guarded = ['id'];
}
