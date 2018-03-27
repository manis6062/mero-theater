<?php

namespace App\ProgrammingModel;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'show_times';
    protected $guarded = ['id'];
}
