<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePulsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pulses', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('services_cat_id');
            $table->smallInteger('pulses_machine_id');
            $table->integer('appointment_id');
            $table->integer('patient_id');
            $table->smallInteger('doctor_id')->nullable();
            $table->smallInteger('branch_id');
            $table->tinyInteger('type'); //( 0- add session, 1- taken from session package, 2- taken from pulses package )
            $table->boolean('status'); //( 0 not done, 1= done )
            $table->string('fluence', 10)->nullable();
            $table->smallInteger('pulse_area_id');
            $table->tinyInteger('spot_size');
            $table->smallInteger('balance_before_session');
            $table->smallInteger('used_pulses');
            $table->integer('package_id')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('pulses');
    }
}