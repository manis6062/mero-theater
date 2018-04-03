<?php

namespace App\BookingModel;

use Illuminate\Database\Eloquent\Model;

class CounterSellInvoice extends Model
{
    protected $table = 'counter_sell_invoices';
    protected $guarded = ['id'];
}
