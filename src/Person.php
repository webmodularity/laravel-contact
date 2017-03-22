<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Model;

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

    public function phones()
    {
        return $this->belongsToMany(Phone::class)->withPivot(['phone_type_id', 'is_primary']);
    }

    public function user()
    {
        return $this->hasOne('WebModularity\LaravelUser\User');
    }

    public function userInvitations()
    {
        return $this->hasMany('WebModularity\LaravelUser\UserInvitation');
    }

    public function scopeWithPrimaryPhone($query)
    {
        return $query->with(['phones' => function ($query) {
            $query->wherePivot('is_primary', '=', 1);
        }]);
    }

    public function scopeHasUser($query, $hasUser = true)
    {
        $operator = $hasUser ? '>' : '<=';
        return $query->withCount('user')->having('user_count', $operator, 0);
    }

    public function scopeHasUserInvitations($query, $hasUserInvitations = true)
    {
        $operator = $hasUserInvitations ? '>=' : '<';
        return $query->withCount('userInvitations')->having('user_invitations_count', $operator, 1);
    }

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
}
