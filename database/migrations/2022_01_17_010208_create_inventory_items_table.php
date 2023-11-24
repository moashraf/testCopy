<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('code');
            $table->smallInteger('service_inv_cat_id');
            $table->smallInteger('specialty_id');
            $table->smallInteger('branch_id');
            $table->string('name', 40);
            $table->decimal('price', 10,2);
            $table->string('place', 30);
            $table->integer('current_quantity')->default('0');
            $table->smallInteger('quantity_notify');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_items');
    }
}