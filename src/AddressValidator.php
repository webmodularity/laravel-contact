<?php

namespace WebModularity\LaravelContact;

use Validator;

class AddressValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        extract($value);
        $isRequired = $validator->hasRule($attribute, 'Required');

        // Street
        $streetRules = $isRequired
            ? 'required|max:255'
            : 'max:255';
        $streetValidator = Validator::make(['street' => $street,[
            'street' =>
        ]);

        $rules[$attribute . '.street'] = $streetRules;

        $validator->addRules($rules);

        return false;
    }
}