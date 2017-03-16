<?php

namespace WebModularity\LaravelContact;

class AddressValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        extract($value);
        dd($validator->hasRule('address', 'required'));
        if ($validator->hasRule($attribute, 'required')
            && (
                empty($street)
                || empty($city)
                || empty($state_id)
                || empty($zip)
            )
        ) {
            if (empty($street)) {
                $validator->errors()->add($attribute . '.street', 'Street Address is required.');
            }
            if (empty($city)) {
                $validator->errors()->add($attribute . '.city', 'City is required.');
            }
            if (empty($state_id)) {
                $validator->errors()->add($attribute . '.state_id', 'State is required.');
            }
            if (empty($zip)) {
                $validator->errors()->add($attribute . '.zip', 'Zip Code is required.');
            }
            return false;
        }

        return true;
    }
}