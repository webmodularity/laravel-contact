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
        $phonesOld = $person->phones->keyBy('pivot.phone_type_id');
        foreach (request($fieldName) as $phoneKey => $phoneValue) {
            $phoneSplit = Phone::splitFull($phoneValue);
            $phoneTypeId = constant(Phone::class . '::' . 'TYPE_' . strtoupper($phoneKey));
            $phone = !is_null($phoneSplit) ? Phone::firstOrCreate($phoneSplit) : null;
            $phoneOld = isset($phonesOld[$phoneTypeId]) ? $phonesOld[$phoneTypeId] : null;
            if (is_null($phone) && !is_null($phoneOld)) {
                $person->phones()->detach($phoneOld);
            } elseif (!is_null($phone) && is_null($phoneOld)) {
                \Log::warning('Attaching: ' . $phoneOld->id);
                $person->phones()->attach($phone, ['phone_type_id' => $phoneTypeId]);
            } elseif (!is_null($phone) && !is_null($phoneOld) && $phone->id != $phoneOld->id) {
                $person->phones()->detach($phoneOld);
                $person->phones()->attach($phone, ['phone_type_id' => $phoneTypeId]);
            }
        }
    }
}
