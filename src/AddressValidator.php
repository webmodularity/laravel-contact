<?php

namespace WebModularity\LaravelContact;

use Validator;

class AddressValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $isRequired = $validator->hasRule($attribute, 'Required');
        $zip = array_pull($value, 'zip');

        // Street
        $streetRules = $isRequired
            ? 'required|max:255'
            : 'max:255';
        // City
        $cityRules = $isRequired
            ? 'required|max:100'
            : 'max:100';
        // State
        $stateRules = $isRequired
            ? 'required|integer|exists:address_states,id'
            : 'integer|exists:address_states,id';

        $addressValidator = Validator::make($value, [
            'street' => $streetRules,
            'city' => $cityRules,
            'state_id' => $stateRules
        ]);

        if ($addressValidator->fails()) {
            dd($addressValidator->errors());
        }

        return false;
    }
}