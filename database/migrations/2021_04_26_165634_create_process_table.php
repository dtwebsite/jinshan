<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('process')) {
            Schema::create('process', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('process_id')->nullable();
                $table->string('title',255);
                $table->text('content')->nullable();
                $table->text('inner_content')->nullable();
                $table->string('img', 100)->nullable();
                $table->string('lang',10);
                $table->tinyInteger('status')->default(1);
                $table->tinyInteger('sort')->default(0);
                $table->tinyInteger('en_check')->default(0);
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process');
    }
}
