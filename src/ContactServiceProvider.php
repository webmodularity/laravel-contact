<?php

namespace WebModularity\LaravelContact;

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

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'contact-validator');
        $message = $this->app->translator->trans('contact-validator::validation.address');
        Validator::extend('address', '\WebModularity\LaravelContact\AddressValidator@validate', $message);
    }
}
