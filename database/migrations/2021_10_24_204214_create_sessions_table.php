<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_pats', function (Blueprint $table) {
            $table->id();
            $table->integer('services_cat_id');
            $table->integer('appointment_id');
            $table->smallInteger('doctor_id')->nullable();
            $table->integer('patient_id');
            $table->integer('treatment_id')->nullable();
            $table->tinyInteger('status')->default('0')->comment('not yet = 0 and done = 1');
            $table->date('start');
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
        Schema::dropIfExists('sessions');
    }
}