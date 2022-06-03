<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id',100)->unique();
            $table->string('name',100)->unique()->index();
            $table->string('slug',100)->unique()->index();
            $table->string('jp_name',100)->nullable();
            $table->string('jp_slug',100)->nullable();
            $table->smallInteger('number')->unique()->index();
            $table->unsignedInteger('category_id');
            $table->text('description')->nullable();
            $table->text('jp_description')->nullable();
            $table->enum('type',['simple','variable'])->default('simple')->index(); // bbq will have variation for the price on the basis of the half plate, 4 pcs and full plate
            $table->enum('status',[0,1])->default(1)->index(); // 0 for the inactive product and 1 for the active one
            $table->enum('is_open_for_takeout',[0,1])->default(1)->index(); // product can takeout or not
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}
