<?php

namespace WebModularity\LaravelContact\Validators;

use WebModularity\LaravelContact\Phone;

class PhoneValidator
{

    public function validate($attribute, $value, $parameters, $validator)
    {
        return !empty(Phone::splitFull($value));
    }
}
