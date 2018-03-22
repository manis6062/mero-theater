<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id', 'first_name', 'last_name', 'country_code', 'phone', 'password',
    ];

    /**
     * Getting groups
     */
    public function groups(){
        return $this->belongsToMany('App\Models\Group');
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Combine country_code and phone
     *
     * @param  string  $value
     * @return string
     */
    public function getPhoneNumberAttribute($value)
    {
        return ($this->country_code.$this->phone);
    }

    /**
     * Combine first name and last name as full name
     *
     * @param  string  $value
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        return ($this->first_name." ".$this->last_name);
    }

    public function contactGroup()
    {
        return $this->hasMany('App\Models\ContactGroup', 'contact_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }
}
