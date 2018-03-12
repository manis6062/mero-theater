<?php

namespace App\TicketTypeModel;

use Illuminate\Database\Eloquent\Model;

class TicketClass extends Model
{
    protected $table = 'ticket_classes';
    protected $guarded = ['id'];
}
