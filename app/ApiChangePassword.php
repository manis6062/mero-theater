<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiChangePassword extends Model
{
    protected $table = 'api_change_passwords';
    protected $guarded = ['id'];
}
