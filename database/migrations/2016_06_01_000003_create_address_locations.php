<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_locations', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('city', 255);
            $table->smallInteger('state_id')->unsigned()->index();
            $table->string('zip', 20)->index();
            $table->unique(['city', 'state_id', 'zip']);
            $table->foreign('state_id')->references('id')->on('address_states')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('address_locations');
    }
}
