<?php

namespace WebModularity\LaravelContact\Http\Controllers;

use WebModularity\LaravelContact\Person;
use WebModularity\LaravelContact\Phone;
use WebModularity\LaravelContact\Address;

trait SyncsInputToPerson
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
                $person->phones()->wherePivot('phone_type_id', $phoneTypeId)->detach($phoneOld);
            } elseif (!is_null($phone) && is_null($phoneOld)) {
                $person->phones()->attach($phone, ['phone_type_id' => $phoneTypeId]);
            } elseif (!is_null($phone) && !is_null($phoneOld) && $phone->id != $phoneOld->id) {
                $person->phones()->wherePivot('phone_type_id', $phoneTypeId)->detach($phoneOld);
                $person->phones()->attach($phone, ['phone_type_id' => $phoneTypeId]);
            }
        }
    }


    protected function syncAddressToPerson(
        Person $person,
        $addressTypeId = Address::TYPE_PRIMARY,
        $fieldName = 'address'
    ) {
        $addressInput = request($fieldName);
        $address = !empty($addressInput['street'])
            ? $address = Address::firstOrCreate($addressInput)
            : null;
        $addressOld = $person->addresses()->wherePivot('address_type_id', $addressTypeId)->first();
        if (is_null($address) && !is_null($addressOld)) {
            $person->addresses()->wherePivot('address_type_id', $addressTypeId)->detach($addressOld);
        } elseif (!is_null($address) && is_null($addressOld)) {
            $person->addresses()->attach($address, ['address_type_id' => $addressTypeId]);
        } elseif (!is_null($address) && !is_null($addressOld) && $address->id != $addressOld->id) {
            $person->addresses()->wherePivot('address_type_id', $addressTypeId)->detach($addressOld);
            $person->addresses()->attach($address, ['address_type_id' => $addressTypeId]);
        }
    }
}
