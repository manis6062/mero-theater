<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['admin_id', 'body', 'recipients' , 'schedule_for', 'status'];


    public function histories()
    {
        return $this->hasMany('App\Models\MessageHistory');
    }
}
