<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_wallets', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->smallInteger('branch_id');
            $table->integer('patient_id');
            $table->mediumInteger('service_item_id');
            $table->integer('invoice_id');
            $table->decimal('balance_before_tran', 10,2)->default('0');
            $table->decimal('amount', 10,2)->default('0');
            $table->date('date');
            $table->string('note', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_wallets');
    }
}