<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('contact')) {
            Schema::create('contact', function (Blueprint $table) {
                $table->increments('id');
                $table->string('company',50);
                $table->string('contact_person',20);
                $table->string('phone',20);
                $table->string('address',50);
                $table->string('product_category',100)->nullable();
                $table->string('product_specification',100)->nullable();
                $table->string('container_material',100)->nullable();
                $table->string('contents',100)->nullable();
                $table->text('message');
                $table->tinyInteger('status')->default(0);
                $table->timestamps();
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
        Schema::dropIfExists('contact');
    }
}
