<?php

namespace WebModularity\LaravelContact;

class AddressValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        \DebugBar::addMessage($attribute);
        \DebugBar::addMessage($value);
        \DebugBar::addMessage($parameters);
        \DebugBar::addMessage($validator);
    }
}