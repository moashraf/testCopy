<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpFollowUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('op_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->integer('op_id');
            $table->integer('patient_id');
            $table->integer('responsible_id')->nullable();
            $table->integer('short_term_responsible_id')->nullable();
            $table->boolean('day_1')->nullable();
            $table->boolean('day_3')->nullable();
            $table->boolean('day_5')->nullable();
            $table->integer('long_term_responsible_id')->nullable();
            $table->boolean('week_1')->nullable();
            $table->boolean('week_2')->nullable();
            $table->boolean('month_1')->nullable();
            $table->boolean('month_2')->nullable();
            $table->boolean('month_3')->nullable();
            $table->boolean('month_6')->nullable();
            $table->string('note', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('op_follow_ups');
    }
}