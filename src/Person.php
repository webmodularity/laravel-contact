<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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
 * @method static Builder|Person whereEmail($value)
 * @method static Builder|Person whereFirstName($value)
 * @method static Builder|Person whereId($value)
 * @method static Builder|Person whereLastName($value)
 * @method static Builder|Person whereMiddleName($value)
 * @method static Builder|Person whereNickname($value)
 * @method static Builder|Person wherePrefix($value)
 * @method static Builder|Person whereSuffix($value)
 */

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
