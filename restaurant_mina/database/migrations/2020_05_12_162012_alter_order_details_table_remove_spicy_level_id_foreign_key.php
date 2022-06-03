<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrderDetailsTableRemoveSpicyLevelIdForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
            $table->dropForeign(['spicy_level_id']);
            $table->dropColumn('spicy_level_id');
            $table->string('spicy_level',10)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
            $table->dropColumn('spicy_level');
            $table->unsignedInteger('spicy_level_id')->after('price');
            $table->foreign('spicy_level_id')->references('id')->on('spicy_level')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}
