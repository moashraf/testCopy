<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadPatNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_pat_notes', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('worker_id');
            $table->integer('patient_id');
            $table->string('note', 255);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('lead_pat_notes');
    }
}