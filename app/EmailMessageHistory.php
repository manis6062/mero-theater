<?php

namespace App;
use App\EmailCampaign;

use Illuminate\Database\Eloquent\Model;

class EmailMessageHistory extends Model
{
     protected $guarded = ['id'];
    protected $table = 'emailmessagehistory_tbl';
   
    
    public function emailCompaign()
    {
        return $this->belongsTo('App\EmailCampaign','campaign_id');
    }
}
