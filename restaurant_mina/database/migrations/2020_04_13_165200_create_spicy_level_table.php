<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpicyLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spicy_level', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->unique()->index();
            $table->string('jp_name',100)->nullable();
            $table->string('value',50);
            $table->decimal('extra_price',10,2)->default('0.00');
            $table->text('description')->nullable();
            $table->text('jp_description')->nullable();
            $table->tinyInteger('order');
            $table->enum('status',[0,1])->default(1)->index(); // 1 for the active spicy level
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
        Schema::dropIfExists('spicy_level');
    }
}
