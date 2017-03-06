<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressPerson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_person', function (Blueprint $table) {
            $table->integer('address_id')->unsigned();
            $table->integer('person_id')->unsigned()->index();
            $table->smallInteger('address_type_id')->unsigned()->default(1);
            $table->primary(['address_id', 'person_id', 'address_type_id']);
            $table->foreign('address_id')->references('id')->on('address_streets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('address_person');
    }
}
