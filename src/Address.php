<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * WebModularity\LaravelContact\Address
 *
 * @property int $id
 * @property string $street1
 * @property string $street2
 * @property string $city
 * @property int $state_id
 * @property string $zip
 */

class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'street1',
        'street2',
        'city',
        'state_id',
        'zip'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('withState', function (Builder $builder) {
            $builder->with('state');
        });
    }

    public function getOneLine()
    {
        $street = empty($this->street2)
            ? $this->street1
            : $this->street1 . ',' . $this->street2;

        return $street . ',' . $this->city . ',' . $this->state->iso . ',' . $this->zip;
    }

    public function state()
    {
        return $this->belongsTo(AddressState::class);
    }
}