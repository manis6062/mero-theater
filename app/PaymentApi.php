<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentApi extends Model
{
    protected $table = 'payment_api';
    protected $guarded = ['id'];
}
