<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeople extends Migration
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
            $table->string('email', 255);
            $table->string('prefix', 5)->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('suffix', 10)->nullable();
            $table->string('nickname', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(('email'));
            $table->index(['last_name', 'first_name', 'deleted_at']);
            $table->index(['deleted_at', 'email']);
            $table->index('nickname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('people');
    }
}
