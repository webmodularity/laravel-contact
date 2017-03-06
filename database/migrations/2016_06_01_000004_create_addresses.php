<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street1', 255);
            $table->string('street2', 255);
            $table->unsignedSmallInteger('location_id');
            $table->index('location_id');
            $table->unique(['street1', 'street2', 'location_id']);
            $table->foreign('location_id')->references('id')->on('address_locations')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
