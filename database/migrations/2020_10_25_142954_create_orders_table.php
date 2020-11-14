<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('order_number')->nullable();
            $table->integer("user_id")->index("user_id");
            $table->integer('product_id')->index("product_id");
            $table->integer("grade_id")->index("grade_id");
            $table->integer("amount")->index("amount");
            $table->text('params')->nullable();
            $table->text('packaging')->nullable();
            $table->integer('dry_store')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
