<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTobaccoProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tobacco_products', function (Blueprint $table) {
            $table->id();
            $table->text('bale_name')->nullable();
            $table->text('unique_no')->nullable();
            $table->double('weight')->nullable();
            $table->integer('grade_id')->index('grade_id');
            $table->integer('transport_id')->index('transport_id');
            $table->integer('farmer_profile_id')->index('farmer_profile_id');
            $table->integer('lorry_status_id')->index('lorry_status_id');
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
        Schema::dropIfExists('tobacco_products');
    }
}
