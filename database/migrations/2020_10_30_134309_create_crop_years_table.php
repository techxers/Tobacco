<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_years', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('status')->default(1)->comment('1=active, 2=inactive');
            $table->string('desription');
            $table->boolean('isActive')->default(0);
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
        Schema::dropIfExists('crop_years');
    }
}
