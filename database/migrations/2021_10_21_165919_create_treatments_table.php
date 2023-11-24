<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->integer('treatment_cat_id');
            $table->integer('appointment_id');
            $table->integer('patient_id');
            $table->smallInteger('sessions');
            $table->smallInteger('sessions_done')->nullable();
            $table->date('start');
            $table->date('end')->nullable();
            $table->tinyInteger('status')->default('1')->comment('in prog = 0, no result = 1 done = 2');
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
        Schema::dropIfExists('treatments');
    }
}