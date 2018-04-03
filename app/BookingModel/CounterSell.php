<?php

namespace App\BookingModel;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class CounterSell extends Model
{
    use SyncsWithFirebase;
    protected $table = 'counter_sells';
    protected $guarded = ['id'];
}
