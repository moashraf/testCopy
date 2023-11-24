<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->integer('disease_cats');
            $table->integer('calendable_id');
            $table->string('calendable_type', 70);
            $table->integer('patient_id');
            $table->date('start');
            $table->date('end')->nullable();
            $table->tinyInteger('status')->default('0')->comment('in prog = 0 and healed = 1');
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
        Schema::dropIfExists('diseases');
    }
}