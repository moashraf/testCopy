<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 40)->unique();
            $table->smallInteger('specialty_id');
            $table->smallInteger('branch_id');
            $table->smallInteger('unit_id');
            $table->integer('patient_id');
            $table->integer('doctor_id')->nullable();
            $table->integer('services_cat_id');
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->text('note')->nullable();
            $table->text('note_doctor')->nullable();
            $table->integer('creator_id')->nullable();
            $table->integer('last_update_person_id')->nullable();
            $table->tinyInteger('status')->default('0')->comment('not accepted = 0, accepted = 1, arrived = 2, with doctor = 3, done = 4, not responding = 5, canceled = 6');
            $table->boolean('queue_show')->default('0');
            $table->smallInteger('rate')->nullable()->comment('from 1 to 5');
            $table->string('meet_start_url')->nullable();
            $table->string('meet_join_url')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}