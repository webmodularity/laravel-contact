<?php

namespace WebModularity\LaravelContact\Http\Controllers;

use WebModularity\LaravelContact\Person;
use WebModularity\LaravelContact\Phone;

trait SyncsPhonesInputToPerson
{
    /**
     * Takes input from request() and syncs phone inputs to Person
     * @param Person $person
     * @param string $fieldName Name of input field containing phone types (use dot notation if nested)
     */
    protected function syncPhonesToPerson(Person $person, $fieldName = 'phones')
    {
        $phones = $person->phones()->keyBy('pivot.phone_type_id');
        dd($phones);
        foreach (request($fieldName) as $phoneKey => $phoneValue) {
            if (!is_null(Phone::splitFull($phoneValue))) {
                $phone = Phone::firstOrCreate(Phone::splitFull($phoneValue));
                if (!is_null($phone)) {
                    $phoneIds[$phone->id] = [
                        'phone_type_id' => constant(Phone::class . '::TYPE_' . strtoupper($phoneKey))
                    ];
                }
            }
        }
        $person->phones()->sync($phoneIds);
    }
}
