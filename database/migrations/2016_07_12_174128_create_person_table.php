<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)->nullable()->unique();
            $table->string('prefix', 5)->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('suffix', 10)->nullable();
            $table->string('nickname', 255)->nullable()->index();
            $table->index(['last_name', 'first_name']);
        });

        // Junction Table for Address
        Schema::create('address_person', function (Blueprint $table) {
            $table->integer('address_id')->unsigned();
            $table->integer('person_id')->unsigned()->index();
            $table->smallInteger('address_type_id')->unsigned()->default(1);
            $table->primary(['address_id', 'person_id', 'address_type_id']);
            $table->foreign('address_id')
                ->references('id')
                ->on('address_streets')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('person_id')
                ->references('id')
                ->on('people')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Junction Table for Phone
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
        Schema::drop('address_person');
        Schema::drop('person_phone');
        Schema::drop('people');
    }
}
