<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_grades', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->index('product_id');
            $table->integer('grade_id')->index('grade_id');
            $table->double('yield_percentage');
            $table->integer('ration');
           
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
        Schema::dropIfExists('product_grades');
    }
}
