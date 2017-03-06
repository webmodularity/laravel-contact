<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use WebModularity\LaravelContact\AddressCountry;

class CreateAddressCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_countries', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 255)->unique();
            $table->char('iso', 2)->unique();
            $table->char('iso3', 3)->unique();
            $table->char('fips', 2);
            $table->char('continent', 2);
            $table->char('currency_code', 3);
            $table->char('tld', 3);
            $table->unsignedSmallInteger('phone_code');
            $table->string('postal_regex', 255);
        });

        $countries = [
            [
                'name' => 'United States',
                'iso' => 'US',
                'iso3' => 'USA',
                'fips' => 'US',
                'continent' => 'NA',
                'currency_code' => 'USD',
                'tld' => '.us',
                'phone_code' => 1,
                'postal_regex' => '^[0-9]{5}(?:-[0-9]{4})?$'
            ],
            [
                'name' => 'Canada',
                'iso' => 'CA',
                'iso3' => 'CAN',
                'fips' => 'CA',
                'continent' => 'NA',
                'currency_code' => 'CAD',
                'tld' => '.ca',
                'phone_code' => 1,
                'postal_regex' => '^([a-zA-Z]\\d[a-zA-Z]\\d[a-zA-Z]\\d)$'
            ]
        ];

        foreach ($countries as $country) {
            AddressCountry::create($country);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('address_countries');
    }
}
