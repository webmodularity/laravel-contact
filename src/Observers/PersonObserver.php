<?php

namespace App\Observers;

use WebModularity\LaravelContact\Person;

class PersonObserver
{
    /**
     * Listen to the Person updated event.
     *
     * @param  Person  $person
     * @return void
     */
    public function saving(Person $person)
    {
        \Log::critical($person);
    }
}
