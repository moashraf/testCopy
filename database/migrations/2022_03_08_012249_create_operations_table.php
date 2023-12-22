<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('specialty_id');
            $table->smallInteger('branch_id');
            $table->smallInteger('oper_place_id');
            $table->integer('patient_id');
            $table->integer('doctor_id')->nullable();
            $table->integer('services_cat_id');
            $table->integer('appointment_id')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->string('note', 255)->nullable();
            $table->integer('creator_id')->nullable();
            $table->tinyInteger('status')->default('0')->comment('not scheduled = 0, scheduled = 1, accepted = 2, done = 3, not respond = 4, postponed = 5, canceled = 6');
            $table->tinyInteger('improvement_rate')->nullable()->comment('from 0 to 5');
            $table->string('note_after_op', 255)->nullable();
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
        Schema::dropIfExists('operations');
    }
}