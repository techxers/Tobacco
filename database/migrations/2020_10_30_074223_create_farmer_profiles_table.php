<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatefarmerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('number')->nullable();
            $table->integer('city_id')->index('city_id')->nullable();
            $table->integer('country_id')->index('country_id')->nullable();
            $table->integer('region_id')->index('region_id')->nullable();
            $table->integer('cropyear_id')->index('cropyear_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('id_number')->nullable();
            $table->string('status')->nullable();;

            $table->timestamps();
        });
    }

    /**
     *     * Reverse the migrations.

     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmer_profiles');
    }
}
