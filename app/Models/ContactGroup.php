<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'contact_id',
    ];

    /**
     * providing table name
     */
    protected $table = 'contact_group';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'group_id' => 'integer',
        'contact_id' => 'integer',
    ];

    /**
     * Getting groups
     */
    public function group(){
        return $this->belongsTo('App\Models\Group');
    }

    public function contact()
    {
        return $this->belongsTo('App\Models\Contact', 'contact_id');
    }
}
