<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageHistory extends Model
{
    protected $fillable = ['admin_id','body', 'message_id','recipient', 'network','status'];
    protected $table = 'message_history';


}
