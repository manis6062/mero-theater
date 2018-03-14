<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMediaModel extends Model
{
    protected $table = 'socialmedia_tbl';
    protected $guarded = ['id'];
}
