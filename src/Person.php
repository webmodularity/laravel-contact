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
        'email', 'prefix', 'first_name', 'middle_name', 'last_name', 'suffix', 'nickname'
    ];

    /**
     * Get the user record associated with the person.
     */
    // Person should not know about user? Maybe check for existence of User Model and return if exists?
    //public function user()
    //{
    //    return $this->hasOne('App\User');
    //}

    public static function getNamePartsFromFull($fullName) {
        if (!empty($fullName) && is_string($fullName)) {
            $nameParts = explode(' ', $fullName);
            if (count($nameParts) == 1) {
                return [null, $nameParts[0]];
            } else {
                return [array_pop($nameParts), implode(' ', $nameParts)];
            }
        } else {
            return [null, null];
        }
    }
}
