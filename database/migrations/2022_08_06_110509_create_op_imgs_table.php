<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('op_imgs', function (Blueprint $table) {
            $table->id();
            $table->integer('op_id');
            $table->integer('patient_id');
            $table->tinyInteger('type'); //1= pre, 2= ducring, 3= after	
            $table->string('img', 25);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('op_imgs');
    }
}