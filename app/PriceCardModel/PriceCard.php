<?php

namespace App\PriceCardModel;

use Illuminate\Database\Eloquent\Model;

class PriceCard extends Model
{
    protected $table = 'price_cards';
    protected $guarded = ['id'];
}
