<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('specialty_id');
            $table->smallInteger('branch_id');
            $table->smallInteger('service_inv_cat_id');
            $table->string('name', 40);
            $table->decimal('price', 10,2);
            $table->mediumInteger('pulses')->nullable(); //number of the session will be taken 
            $table->boolean('package')->default(0);	
            $table->smallInteger('package_items_number')->nullable(); //number of the session will be taken
            $table->tinyInteger('doctor_comm')->default(0);	 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_items');
    }
}