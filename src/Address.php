<?php

namespace WebModularity\LaravelContact;

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

    public function state()
    {
        return $this->belongsTo(AddressState::class);
    }
}