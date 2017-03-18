<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * WebModularity\LaravelContact\Address
 *
 * @property int $id
 * @property string $street
 * @property string $city
 * @property int $state_id
 * @property string $zip
 */

class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'street',
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

    public function state()
    {
        return $this->belongsTo(AddressState::class);
    }

    /**
     * Try and delete address record but ignore failures as this address may be related to other records
     *
     * @param int $addressId
     */

    public static function attemptDelete($addressId)
    {
        if (is_int($addressId) && $addressId > 0) {
            $address = static::find($addressId);
            if (!is_null($address)) {
                try {
                    $address->delete();
                } catch (\Exception $exception) {
                    // Stay quiet
                }
            }
        }
    }
}
