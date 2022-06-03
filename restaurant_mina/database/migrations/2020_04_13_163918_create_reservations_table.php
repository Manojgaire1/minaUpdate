<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_full_name',100);
            $table->string('email',100); // for the email should not be unique can be extend in future after the login user details
            $table->string('phone',15);
            $table->dateTime('reservation_date_time');
            $table->smallInteger('no_of_peoples')->default(1);
            $table->string('branch_name',50);
            $table->text('message')->nullable();
            $table->text('cancelled_message')->nullable();
            $table->enum('status',[0,1,2])->default(1); // 0 for the pending, 1 for approved and 2 for cancelled
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
        Schema::dropIfExists('reservations');
    }
}
