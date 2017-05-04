<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * WebModularity\LaravelContact\Person
 *
 * @property int $id
 * @property string $email
 * @property string $prefix
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $suffix
 * @property string $nickname
 */

class Person extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'nickname'
    ];

    protected $dates = ['deleted_at'];

    public function phones()
    {
        return $this->belongsToMany(Phone::class)->withPivot(['phone_type_id']);
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class)->withPivot(['address_type_id']);
    }

    public function user()
    {
        return $this->hasOne('WebModularity\LaravelUser\User');
    }

    public function nameIsEmpty()
    {
        return (empty($this->first_name) || empty($this->last_name));
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
                    'firstName' => $nameParts[0],
                    'lastName' => null
                ];
            } else {
                return [
                    'firstName' => array_shift($nameParts),
                    'lastName' => implode(' ', $nameParts)
                ];
            }
        }

        return [
            'firstName' => null,
            'lastName' => null
        ];
    }

    public function syncPhones($phonesInput = [])
    {

    }
}
