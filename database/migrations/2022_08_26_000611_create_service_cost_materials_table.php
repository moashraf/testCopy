<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCostMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_cost_materials', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('service_item_id');
            $table->mediumInteger('cost_cat_id')->nullable();
            $table->mediumInteger('inventory_id')->nullable();
            $table->tinyInteger('qty')->default('1');
            $table->decimal('price', 10,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_cost_materials');
    }
}