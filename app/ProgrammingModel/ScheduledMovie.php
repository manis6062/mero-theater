<?php

namespace App\ProgrammingModel;

use Illuminate\Database\Eloquent\Model;

class ScheduledMovie extends Model
{
    protected $table = 'scheduled_movie';
    protected $guarded = ['id'];
}
