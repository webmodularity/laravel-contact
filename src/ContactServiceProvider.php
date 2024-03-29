<?php

namespace WebModularity\LaravelContact;

use WebModularity\LaravelContact\Observers\PersonObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ContactServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'contact-validator');

        // User event observer
        Person::observe(PersonObserver::class);

        // Validators
        // Address
        Validator::extend(
            'address',
            '\WebModularity\LaravelContact\Validators\AddressValidator@validate',
            $this->app->translator->trans('contact-validator::validation.address')
        );
        // Phone
        Validator::extend(
            'phone',
            '\WebModularity\LaravelContact\Validators\PhoneValidator@validate',
            $this->app->translator->trans('contact-validator::validation.phone')
        );
    }
}
