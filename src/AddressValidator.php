<?php

namespace WebModularity\LaravelContact;

use Validator;

class AddressValidator
{
    protected $isRequired = false;
    protected $attribute;
    protected $validator;

    public function validate($attribute, $value, $parameters, $validator)
    {
        $this->attribute = $attribute;
        $this->validator = $validator;

        $hasError = false;
        $this->isRequired = $this->validator->hasRule($this->attribute, 'Required');

        $street = array_pull($value, 'street');
        $zip = array_pull($value, 'zip');

        dd($zip);

        // Street
        $streetRules = [
            'max:255'
        ];
        if ($this->isRequired) {
            array_unshift($streetRules, 'required');
        }
        // Validate Street
        $streetValidator = Validator::make($street, [
            'street' => $streetRules
        ]);

        if ($streetValidator->fails()) {
            $this->transferErrors($streetValidator->errors()->getMessages());
            $hasError = true;
        } elseif (is_null($street['street'])) {
            // Address is optional and street is null, ignore address
            return true;
        }

        // City
        $cityRules = [
            'max:100'
        ];
        if ($this->isRequired) {
            array_unshift($cityRules, 'required');
        }
        // State
        $stateRules = [
            'integer',
            'exists:address_states,id'
        ];
        if ($this->isRequired) {
            array_unshift($stateRules, 'required');
        }
        // Validate City & State
        $addressValidator = Validator::make($value, [
            'city' => $cityRules,
            'state_id' => $stateRules
        ]);

        if ($addressValidator->fails()) {
            $this->transferErrors($addressValidator->errors()->getMessages());
            $hasError = true;
        }

        // Zip
        $zipRules = [
            'max:20'
        ];
        if (!is_null($value['state_id']) && $this->validator->errors()->has($this->attribute . '.' . 'state_id')) {
            $postalRegex = AddressState::select('postal_regex')
                ->leftJoin('address_countries', 'address_states.country_id', '=', 'address_countries.id')
                ->where('address_states.id', $value['state_id'])
                ->first();
            if (!is_null($postalRegex)) {
                array_unshift($zipRules, 'regex:/' . $postalRegex->postal_regex . '/');
            }
        }
        if ($this->isRequired) {
            array_unshift($zipRules, 'required');
        }
        // Validate Zip
        $zipValidator = Validator::make($zip, [
            'zip' => $zipRules
        ]);

        if ($zipValidator->fails()) {
            $this->transferErrors($zipValidator->errors()->getMessages());
            $hasError = true;
        }

        return ! $hasError;
    }

    protected function transferErrors($errors)
    {
        foreach ($errors as $key => $allErrors) {
            foreach ($allErrors as $error) {
                $this->validator->errors()->add($this->attribute . '.' . $key, $error);
            }
        }
    }
}
