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
    const TYPE_MOBILE = 1;
    const TYPE_OFFICE = 2;
    const TYPE_HOME = 3;
    const TYPE_FAX = 4;

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

    public function getFull()
    {
        return '(' . $this->area_code . ') ' . $this->number;
    }
}
