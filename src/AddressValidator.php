<?php

namespace WebModularity\LaravelContact;

use Illuminate\Validation\ValidationRuleParser;

class AddressValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        extract($value);
        $isRequired = $validator->hasRule($attribute, 'Required');
        $rules = [];

        // Street
        $streetRules = $isRequired
            ? 'required|max:255'
            : 'max:255';
        $rules[$attribute . '.street'] = ValidationRuleParser::parse($streetRules);

        $validator->addRules($rules);

        return true;
    }
}