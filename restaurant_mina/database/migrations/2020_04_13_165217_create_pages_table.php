<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('posted_by');
            $table->string('name',100)->unique()->index();
            $table->string('slug',100)->unique()->index();
            $table->string('jp_name',100)->nullable();
            $table->string('jp_slug',100)->nullable();
            $table->tinyInteger('order');
            $table->enum('status',[0,1])->default(1); // 1 for the active pages
            $table->text('excerpt')->nullable();
            $table->text('jp_excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->longText('jp_description')->nullable();
            $table->foreign('posted_by')->references('id')->on('users');
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
        Schema::dropIfExists('pages');
    }
}
