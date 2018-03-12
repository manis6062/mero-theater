<?php

namespace App\TicketTypeModel;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $table = 'ticket_types';
    protected $guarded = ['id'];

    public function screen()
    {
        return $this->belongsTo('App\Screen\Screen', 'screen_id');
    }
}
