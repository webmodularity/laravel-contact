<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonPhone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_phone', function (Blueprint $table) {
            $table->integer('person_id')->unsigned();
            $table->integer('phone_id')->unsigned()->index();
            $table->smallInteger('phone_type_id')->unsigned()->default(1);
            $table->boolean('is_primary')->default(0);
            $table->primary(['person_id', 'phone_id', 'phone_type_id']);
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('person_phone');
    }
}
