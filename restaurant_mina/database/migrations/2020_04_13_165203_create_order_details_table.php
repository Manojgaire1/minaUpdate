<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->tinyInteger('qty');
            $table->decimal('price',10,2)->default('0.00');
            $table->unsignedInteger('spicy_level_id')->nullable();
            $table->string('bbq_pcs',15)->nullable();
            $table->decimal('spicy_price',10,2)->default('0.00');
            $table->decimal('line_total_amount',12,2)->default('0.00');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('spicy_level_id')->references('id')->on('spicy_level');
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
        Schema::dropIfExists('order_details');
    }
}
