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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('product_id')->nullable();
                $table->string('name',255);
                $table->string('img', 100)->nullable();
                $table->text('features')->nullable();
                $table->text('application')->nullable();
                $table->text('material')->nullable();
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
        Schema::dropIfExists('products');
    }
}
