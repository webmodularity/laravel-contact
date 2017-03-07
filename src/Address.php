<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Model;

/**
 * WebModularity\LaravelContact\Address
 *
 * @property int $id
 * @property string $street1
 * @property string $street2
 * @property int $location_id
 */

class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'street1',
        'street2',
        'location_id'
    ];

    public function location()
    {
        return $this->belongsTo(AddressLocation::class);
    }
}