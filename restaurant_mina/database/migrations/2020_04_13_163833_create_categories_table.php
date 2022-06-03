<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->unique()->index();
            $table->string('slug',100)->unique()->index();
            $table->string('jp_namme',100)->nullable();
            $table->string('jp_slug',100)->nullable();
            $table->tinyInteger('parent');
            $table->text('description')->nullable();
            $table->text('jp_description')->nullable();
            $table->string('image_path',150)->nullable();
            $table->tinyInteger('order')->unique(); // to sort the category if required in the future
            $table->enum('status',[0,1])->default(1)->index(); // 0 for inactive and 1 for active
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
        Schema::dropIfExists('categories');
    }
}
