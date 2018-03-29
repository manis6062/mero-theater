<?php

namespace App\BookingModel;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class TemporaryReservedSeats extends Model
{
    use SyncsWithFirebase;
    protected $table = 'temporary_reserved_seats';
    protected $guarded = ['id'];
}
