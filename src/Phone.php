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

    public static function splitFull($fullPhone)
    {
        if (!empty($fullPhone)) {
            if (preg_match("/^\((\d{3})\)\s?(\d{3})\-?(\d{4})\s?x?(\d{1,7})$/", $fullPhone, $match)) {
                $ext = isset($match[4]) && !empty($match[4])
                    ? $match[4]
                    : '';
                return [
                    'area_code' => $match[1],
                    'number' => $match[2] . $match[3],
                    'extension' => $ext
                ];
            }
        }

        return null;
    }
}
