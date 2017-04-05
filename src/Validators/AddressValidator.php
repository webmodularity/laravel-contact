<?php

namespace WebModularity\LaravelContact\Validators;

use Validator;
use WebModularity\LaravelContact\Address;
use WebModularity\LaravelContact\AddressState;

class AddressValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $address = Address::create($value);
        $nullable = $validator->hasRule($attribute, 'Nullable');

        if ($nullable && $address->isEmpty()) {
            return true;
        }

        // Validate Street, City, and State
        $addressValidator = Validator::make($value, [
            'street' => 'required|max:255',
            'city' => 'required|max:100',
            'state_id' => [
                'required',
                'integer',
                'exists:address_states,id'
            ]
        ]);

        if ($addressValidator->passes()) {
            $postalRegex = AddressState::select('postal_regex')
                ->leftJoin('address_countries', 'address_states.country_id', '=', 'address_countries.id')
                ->where('address_states.id', $address->state_id)
                ->first();
            $zipRegex = !is_null($postalRegex)
                ? $postalRegex->postal_regex
                : '.*';
            // Validate Zip
            $zipValidator = Validator::make(['zip' => $address->zip], [
                'zip' => [
                    'required',
                    'regex:/' . $zipRegex . '/'
                ]
            ]);
            if ($zipValidator->passes()) {
                return true;
            } else {
                $this->transferErrors($zipValidator->errors()->getMessages(), $attribute, $validator);
            }
        } else {
            $this->transferErrors($addressValidator->errors()->getMessages(), $attribute, $validator);
        }

        return false;
    }

    protected function transferErrors($errors, $attribute, $validator)
    {
        foreach ($errors as $key => $allErrors) {
            foreach ($allErrors as $error) {
                $validator->errors()->add($attribute . '.' . $key, $error);
            }
        }
    }
}
