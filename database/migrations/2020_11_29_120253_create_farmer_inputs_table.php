<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_inputs', function (Blueprint $table) {
            $table->id();
            $table->integer('farmer_profile_id')->index('farmer_profiles_id')->nullable();
            $table->integer('farm_input_id')->index('farm_inputs_id')->nullable();
            $table->date('issued_date');
            $table->string('description');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmer_inputs');
    }
}
