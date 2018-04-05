<?php

namespace App\BookingModel;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class CounetrReservation extends Model
{
    use SyncsWithFirebase;
    protected $table = 'counter_reservations';
    protected $guarded = ['id'];
}
