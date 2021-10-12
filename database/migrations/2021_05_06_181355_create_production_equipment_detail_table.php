<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionEquipmentDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('production_equipment_detail')) {
            Schema::create('production_equipment_detail', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('pid')->nullable();
                $table->string('name',255);
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
        Schema::dropIfExists('production_equipment_detail');
    }
}
