<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseaseDrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_draws', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('type')->default('0')->comment('0=body, 1=face, 2=teeth');
            $table->integer('calendable_id');
            $table->string('calendable_type', 70);
            $table->integer('patient_id');
            $table->string('front', 70)->nullable();
            $table->string('back', 70)->nullable();
            $table->string('face', 70)->nullable();
            $table->string('teeth', 70)->nullable();
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disease_draws');
    }
}