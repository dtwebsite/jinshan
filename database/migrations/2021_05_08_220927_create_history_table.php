<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('history')) {
            Schema::create('history', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('hid')->nullable();
                $table->string('year',20);
                $table->text('content')->nullable();
                $table->string('lang',10);
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
        Schema::dropIfExists('history');
    }
}
