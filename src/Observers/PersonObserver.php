<?php

namespace WebModularity\LaravelContact\Observers;

use WebModularity\LaravelContact\Person;

class PersonObserver
{
    /**
     * Listen to the Person updated event.
     *
     * @param  Person  $person
     * @return void
     */
    public function updated(Person $person)
    {
        \Log::critical($person);
    }
}
