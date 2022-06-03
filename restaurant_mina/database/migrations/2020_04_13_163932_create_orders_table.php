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
            $table->increments('id');
            //need to seperate the columns and add the login in user id only in future for the customer login implemented
            $table->string('customer_first_name',50);
            $table->string('customer_last_name',50)->nullable();
            $table->string('customer_full_name',100);
            $table->string('customer_email',100);
            $table->string('customer_phone',20);
            $table->enum('pickup_type',[0,1])->default(0)->index();// 0 for as soon as possible and 1 for the desired pickup time
            $table->time('pickup_time');
            $table->unsignedInteger('branch_id');
            $table->decimal('total_amount',12,2)->default('0.00');
            $table->decimal('total_tax_amount',12,2)->default('0.00');
            $table->decimal('grand_total_amount',12,2)->default('0.00');
            $table->enum('status',[0,1,2,3])->default(1)->index(); // 0 for pending order, 1 for the approved order, 2 for the delivered order and 3 for the cancelled order
            $table->text('message')->nullable();
            $table->text('order_cancellation_message')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
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
