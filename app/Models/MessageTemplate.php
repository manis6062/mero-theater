<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    protected $fillable = ['admin_id', 'name', 'body', 'taglib'];

    protected $table = 'message_templates';

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'admin_id');
    }
}
