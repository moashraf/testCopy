<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->integer('itemable_id')->nullable();
            $table->integer('itemable_type')->nullable();
            $table->integer('categorizable_id');
            $table->integer('categorizable_type');
            $table->decimal('price', 10,2);
            $table->decimal('sold_price', 10,2);
            $table->smallInteger('doctor_id')->nullable();
            $table->decimal('doctor_comm', 10,2)->default('0');
            $table->decimal('paid', 10,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}