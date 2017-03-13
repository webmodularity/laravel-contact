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
            $table->string('street1', 100);
            $table->string('street2', 100);
            $table->string('city', 100);
            $table->unsignedSmallInteger('state_id');
            $table->string('zip', 20);
            $table->index(['zip', 'city', 'state_id']);
            $table->index(['state_id', 'zip']);
            $table->index(['state_id', 'city']);
            $table->unique(['street1', 'street2', 'city', 'state_id', 'zip'], 'address_unique');
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
        Schema::drop('addresses');
    }
}
