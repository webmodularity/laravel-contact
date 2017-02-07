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

    ///**
    // * Get the user record associated with the person.
    // */
    // Person should not know about user? Maybe check for existence of User Model and return if exists?
    //public function user()
    //{
    //    return $this->hasOne('App\User');
    //}

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Will update the specified field if current value of that field is null
     * @param $fieldName
     * @param $value
     * @return $this
     */

    public function updateIfNull($fieldName, $value)
    {
        if (is_null($this->$fieldName) && !is_null($value)) {
            $this->{$fieldName} = $value;
            $this->save();
        }

        return $this;
    }

    /**
     * Takes a full name returns its best guess of first and last
     * @param string $fullName
     * @return array ['firstName' => 'First', 'lastName' => 'Last']
     */

    public static function splitFullName($fullName)
    {
        if (!empty($fullName) && is_string($fullName)) {
            $nameParts = explode(' ', $fullName);
            if (count($nameParts) == 1) {
                return [
                    'firstName' => $nameParts[0]
                ];
            } else {
                return [
                    'firstName' => array_shift($nameParts),
                    'lastName', implode(' ', $nameParts)
                ];
            }
        }

        return [];
    }
}
