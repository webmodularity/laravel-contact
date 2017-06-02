<?php

namespace WebModularity\LaravelContact\Observers;

use WebModularity\LaravelContact\Person;

class PersonObserver
{
    /**
     * Listen to the User deleting event.
     *
     * @param  Person  $person
     * @return bool
     */
    public function deleting(Person $person)
    {
        if ($person->isForceDeleting() && !is_null($person->user)) {
            return false;
        }
    }
}