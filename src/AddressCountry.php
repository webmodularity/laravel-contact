<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Model;

/**
 * WebModularity\LaravelContact\AddressCountry
 *
 * @property int $id
 * @property string $name
 * @property string $iso
 * @property string $iso3
 * @property string $fips
 * @property string $continent
 * @property string $currency_code
 * @property string $tld
 * @property int $phone_code
 * @property string $postal_regex
 */

class AddressCountry extends Model
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
        'iso3',
        'fips',
        'continent',
        'currency_code',
        'tld',
        'phone_code',
        'postal_regex'
    ];
}
