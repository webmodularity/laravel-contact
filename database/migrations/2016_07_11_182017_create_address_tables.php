<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTables extends Migration
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
            $table->foreign('state_id')->references('id')->on('common.address_states')->onDelete('no action')->onUpdate('cascade');
        });

        Schema::create('address_streets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street1', 255);
            $table->string('street2', 255);
            $table->smallInteger('location_id')->unsigned()->index();
            $table->unique(['street1', 'street2', 'location_id']);
            $table->foreign('location_id')->references('id')->on('address_locations')->onDelete('cascade')->onUpdate('cascade');
        });

        DB::statement("
        CREATE VIEW addresses AS
            SELECT
                t_street.id id,
                t_street.street1 street1,
                t_street.street2 street2,
                t_loc.id location_id,
                t_loc.city city,
                t_loc.zip zip,
                t_state.id state_id,
                t_state.name state_name,
                t_state.iso state_iso,
                t_country.id country_id,
                t_country.name country_name,
                t_country.iso country_iso
            FROM
                address_streets AS t_street
                    LEFT JOIN
                address_locations AS t_loc ON t_street.location_id = t_loc.id
                    LEFT JOIN
                common.address_states AS t_state ON t_loc.state_id = t_state.id
                    LEFT JOIN
                common.address_countries AS t_country ON t_state.country_id = t_country.id;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('address_streets');
        Schema::drop('address_locations');
        DB::statement("DROP VIEW addresses;");
    }
}
