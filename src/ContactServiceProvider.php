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

        Validator::extend('address', '\WebModularity\LaravelContact\AddressValidator@validate');
    }
}
