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
    public function saving(Person $person)
    {
        foreach ($person->phones as $phone) {
            foreach ($phone->getDirty() as $dirtyAttribute => $dirtyValue) {
                $original = $phone->getOriginal($dirtyAttribute);
                \Log::critical($dirtyAttribute . ': ' . $dirtyValue . ' - ' . $original);
            }
        }
    }
}
