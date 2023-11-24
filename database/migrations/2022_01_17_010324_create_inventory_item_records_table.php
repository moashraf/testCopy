<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_item_records', function (Blueprint $table) {
            $table->id();
            $table->integer('creator_id');
            $table->smallInteger('type')->comment('0=add, 1=withdraw');;
            $table->integer('item_id');
            $table->integer('invoice_id')->nullable();
            $table->integer('quantity');
            $table->integer('price')->nullable();
            $table->date('buying_date');
            $table->date('expiration_date')->nullable();
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
        Schema::dropIfExists('inventory_item_records');
    }
}