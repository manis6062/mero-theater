<?php

namespace App\Screen;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    protected $table = 'screens';
    protected $guarded = ['id'];

    public function screenSeats()
    {
        return $this->hasOne('App\Screen\ScreenSeat', 'screen_id');
    }
}
