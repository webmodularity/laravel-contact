<?php

namespace WebModularity\LaravelContact;

class AddressValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        extract($value);
        $isRequired = $validator->hasRule($attribute, 'Required');
        $rules = [];

        // Street
        $rules[$attribute . '.street'] = [
            'max:255'
        ];
        if ($isRequired) {
            $rules[$attribute . '.street'][] = 'required';
        }

        $validator->addRules($rules);

        return true;
    }
}