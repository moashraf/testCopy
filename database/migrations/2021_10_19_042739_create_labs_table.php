<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->string('code', 40)->unique();
            $table->integer('services_cat_id');
            $table->integer('appointment_id')->nullable();
            $table->integer('patient_id');
            $table->smallInteger('branch_id');
            $table->integer('resp_doctor_id')->nullable();
            $table->string('xray_file', 70)->nullable();
            $table->tinyInteger('status')->default('0')->comment('sent = 0 and done = 1');
            $table->text('note_doctor')->nullable();
            $table->text('note_lab')->nullable();
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
        Schema::dropIfExists('labs');
    }
}