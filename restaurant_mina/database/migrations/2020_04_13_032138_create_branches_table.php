<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->unique()->index();
            $table->string('slug',100)->unique()->index();
            $table->string('jp_name',100)->nullable();
            $table->string('jp_slug',100)->nullable();
            $table->tinyInteger('order')->unique()->index();
            $table->string('phone',15)->unique();
            $table->enum('is_main_branch',[0,1])->default(0)->index(); // 1 for main branch 0 for the sub branch
            $table->string('image_path',100)->nullable();
            $table->text('description')->nullable();
            $table->text('jp_description')->nullable();
            $table->enum('status',[0,1])->default(1)->index(); // 0 for inactive and 1 for active branch
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
        Schema::dropIfExists('branches');
    }
}
