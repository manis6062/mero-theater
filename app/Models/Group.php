<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id', 'name',
    ];

    /**
     * Getting all contacts
     */
    public function contacts(){
        return $this->belongsToMany('App\Models\Contact');
    }

    /**
     * Get the name of group.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Count contact associated with group
     */
    public function countContact(){
        return $this->hasMany('App\Models\ContactGroup', 'group_id')->count();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function contactGroup()
    {
        return $this->hasMany('App\Models\ContactGroup', 'group_id');
    }
}
