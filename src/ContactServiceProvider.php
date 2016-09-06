<?php

namespace WebModularity\LaravelContact;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot() {
        // Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}