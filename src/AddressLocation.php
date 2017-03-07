<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Model;

/**
 * WebModularity\LaravelContact\AddressLocation
 *
 * @property int $id
 * @property string $city
 * @property int $state_id
 * @property string $zip
 */

class AddressLocation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'city',
        'state_id',
        'zip'
    ];

    public function state()
    {
        return $this->belongsTo(AddressState::class);
    }
}