<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePulsesMachineRecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pulses_machine_recs', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('pulses_machine_id');
            $table->integer('doctor_id');
            $table->integer('beginning');
            $table->integer('ending')->nullable();
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pulses_machine_recs');
    }
}