<?php

namespace WebModularity\LaravelContact;

use Illuminate\Database\Eloquent\Model;

/**
 * WebModularity\LaravelContact\Phone
 *
 * @property int $id
 * @property string $area_code
 * @property string $number
 * @property string $extension
 */

class Phone extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'area_code',
        'number',
        'extension'
    ];

    public function people()
    {
        return $this->belongsToMany(Person::class)->withPivot(['phone_type_id', 'is_primary']);
    }
}
