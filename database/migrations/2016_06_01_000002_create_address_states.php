<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use WebModularity\LaravelContact\AddressState;

class CreateAddressStates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_states', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 255)->unique();
            $table->char('iso', 2)->unique()->nullable();
            $table->unsignedSmallInteger('country_id');
            $table->unique(['country_id', 'iso']);
            $table->foreign('country_id')->references('id')->on('address_countries')->onUpdate('cascade');
        });

        $states = [
            [
                'name' => "Alaska",
                'iso' => "AK",
                'country_id' => 1
            ],
            [
                'name' => "Alabama",
                'iso' => "AL",
                'country_id' => 1
            ],
            [
                'name' => "Arkansas",
                'iso' => "AR",
                'country_id' => 1
            ],
            [
                'name' => "Arizona",
                'iso' => "AZ",
                'country_id' => 1
            ],
            [
                'name' => "California",
                'iso' => "CA",
                'country_id' => 1
            ],
            [
                'name' => "Colorado",
                'iso' => "CO",
                'country_id' => 1
            ],
            [
                'name' => "Connecticut",
                'iso' => "CT",
                'country_id' => 1
            ],
            [
                'name' => "Delaware",
                'iso' => "DE",
                'country_id' => 1
            ],
            [
                'name' => "District of Columbia",
                'iso' => "DC",
                'country_id' => 1
            ],
            [
                'name' => "Florida",
                'iso' => "FL",
                'country_id' => 1
            ],
            [
                'name' => "Georgia",
                'iso' => "GA",
                'country_id' => 1
            ],
            [
                'name' => "Hawaii",
                'iso' => "HI",
                'country_id' => 1
            ],
            [
                'name' => "Iowa",
                'iso' => "IA",
                'country_id' => 1
            ],
            [
                'name' => "Idaho",
                'iso' => "ID",
                'country_id' => 1
            ],
            [
                'name' => "Illinois",
                'iso' => "IL",
                'country_id' => 1
            ],
            [
                'name' => "Indiana",
                'iso' => "IN",
                'country_id' => 1
            ],
            [
                'name' => "Kansas",
                'iso' => "KS",
                'country_id' => 1
            ],
            [
                'name' => "Kentucky",
                'iso' => "KY",
                'country_id' => 1
            ],
            [
                'name' => "Louisiana",
                'iso' => "LA",
                'country_id' => 1
            ],
            [
                'name' => "Massachusetts",
                'iso' => "MA",
                'country_id' => 1
            ],
            [
                'name' => "Maryland",
                'iso' => "MD",
                'country_id' => 1
            ],
            [
                'name' => "Maine",
                'iso' => "ME",
                'country_id' => 1
            ],
            [
                'name' => "Michigan",
                'iso' => "MI",
                'country_id' => 1
            ],
            [
                'name' => "Minnesota",
                'iso' => "MN",
                'country_id' => 1
            ],
            [
                'name' => "Missouri",
                'iso' => "MO",
                'country_id' => 1
            ],
            [
                'name' => "Mississippi",
                'iso' => "MS",
                'country_id' => 1
            ],
            [
                'name' => "Montana",
                'iso' => "MT",
                'country_id' => 1
            ],
            [
                'name' => "North Carolina",
                'iso' => "NC",
                'country_id' => 1
            ],
            [
                'name' => "North Dakota",
                'iso' => "ND",
                'country_id' => 1
            ],
            [
                'name' => "Nebraska",
                'iso' => "NE",
                'country_id' => 1
            ],
            [
                'name' => "New Hampshire",
                'iso' => "NH",
                'country_id' => 1
            ],
            [
                'name' => "New Jersey",
                'iso' => "NJ",
                'country_id' => 1
            ],
            [
                'name' => "New Mexico",
                'iso' => "NM",
                'country_id' => 1
            ],
            [
                'name' => "Nevada",
                'iso' => "NV",
                'country_id' => 1
            ],
            [
                'name' => "New York",
                'iso' => "NY",
                'country_id' => 1
            ],
            [
                'name' => "Ohio",
                'iso' => "OH",
                'country_id' => 1
            ],
            [
                'name' => "Oklahoma",
                'iso' => "OK",
                'country_id' => 1
            ],
            [
                'name' => "Oregon",
                'iso' => "OR",
                'country_id' => 1
            ],
            [
                'name' => "Pennsylvania",
                'iso' => "PA",
                'country_id' => 1
            ],
            [
                'name' => "Rhode Island",
                'iso' => "RI",
                'country_id' => 1
            ],
            [
                'name' => "South Carolina",
                'iso' => "SC",
                'country_id' => 1
            ],
            [
                'name' => "South Dakota",
                'iso' => "SD",
                'country_id' => 1
            ],
            [
                'name' => "Tennessee",
                'iso' => "TN",
                'country_id' => 1
            ],
            [
                'name' => "Texas",
                'iso' => "TX",
                'country_id' => 1
            ],
            [
                'name' => "Utah",
                'iso' => "UT",
                'country_id' => 1
            ],
            [
                'name' => "Virginia",
                'iso' => "VA",
                'country_id' => 1
            ],
            [
                'name' => "Vermont",
                'iso' => "VT",
                'country_id' => 1
            ],
            [
                'name' => "Washington",
                'iso' => "WA",
                'country_id' => 1
            ],
            [
                'name' => "Wisconsin",
                'iso' => "WI",
                'country_id' => 1
            ],
            [
                'name' => "West Virginia",
                'iso' => "WV",
                'country_id' => 1
            ],
            [
                'name' => "Wyoming",
                'iso' => "WY",
                'country_id' => 1
            ],
            [
                'name' => "Alberta",
                'iso' => "AB",
                'country_id' => 2
            ],
            [
                'name' => "British Columbia",
                'iso' => "BC",
                'country_id' => 2
            ],
            [
                'name' => "Manitoba",
                'iso' => "MB",
                'country_id' => 2
            ],
            [
                'name' => "New Brunswick",
                'iso' => "NB",
                'country_id' => 2
            ],
            [
                'name' => "Newfoundland and Labrador",
                'iso' => "NL",
                'country_id' => 2
            ],
            [
                'name' => "Nova Scotia",
                'iso' => "NS",
                'country_id' => 2
            ],
            [
                'name' => "Ontario",
                'iso' => "ON",
                'country_id' => 2
            ],
            [
                'name' => "Prince Edward Island",
                'iso' => "PE",
                'country_id' => 2
            ],
            [
                'name' => "Quebec",
                'iso' => "QC",
                'country_id' => 2
            ],
            [
                'name' => "Saskatchewan",
                'iso' => "SK",
                'country_id' => 2
            ],
            [
                'name' => "Yukon",
                'iso' => "YT",
                'country_id' => 2
            ],
            [
                'name' => "Northwest Territories",
                'iso' => "NT",
                'country_id' => 2
            ],
            [
                'name' => "Nunavut",
                'iso' => "NU",
                'country_id' => 2
            ]

        ];

        foreach ($states as $state) {
            AddressState::create($state);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('address_states');
    }
}
