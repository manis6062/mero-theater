<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
     protected $table = 'transaction_log';
     protected $guarded = ['id'];
 

		    public function users()
		{
		    return $this->belongsTo('App\CrmModel' , 'user_id');
		}

		    public function payment_types()
		{
		    return $this->belongsTo('App\PaymentModel' , 'payment_type_id');
		}
}
