<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Model;

/**
 * WebModularity\LaravelContact\AddressState
 *
 * @property int $id
 * @property string $name
 * @property string $iso
 * @property int country_id
 * @property-read AddressCountry $country
 */

class AddressState extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'iso',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(AddressCountry::class);
    }
}
