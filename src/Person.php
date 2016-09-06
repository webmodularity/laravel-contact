<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name'
    ];

    /**
     * Get the user record associated with the person.
     */
    // Person should not know about user? Maybe check for existence of User Model and return if exists?
    //public function user()
    //{
    //    return $this->hasOne('App\User');
    //}
}
