<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_records', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
            $table->string('type', 20)->comment('0=fine, 1=bonus, 2=promotion, 3=problem, 4=other');
            $table->integer('amount')->nullable();
            $table->date('start');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('worker_records');
    }
}