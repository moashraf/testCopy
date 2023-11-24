<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('appointment_id');
            $table->tinyInteger('type')->default('1'); //1= rate, 2= cancel
            $table->tinyInteger('service')->nullable();
            $table->tinyInteger('doctor')->nullable();
            $table->tinyInteger('reception')->nullable();
            $table->tinyInteger('time')->nullable();
            $table->tinyInteger('cleanliness')->nullable();
            $table->integer('cancel_cat_id')->nullable();
            $table->tinyInteger('saved')->default('1'); //(not checked = 1, checked =2)
            $table->text('note')->nullable();
            $table->date('appointment_date');
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
        Schema::dropIfExists('rate_appointments');
    }
}