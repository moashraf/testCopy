<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('code', 40)->unique();
            $table->tinyInteger('type')->default('0')->comment('income =0 and expenses=1');
            $table->tinyInteger('status')->default('0')->comment('not paid = 0, deposit = 2, paid = 3');
            $table->boolean('operation'); //(not operation = 0, operation = 1)
            $table->smallInteger('service_inv_cat_id');
            $table->smallInteger('specialty_id');
            $table->smallInteger('branch_id');
            $table->integer('receivable_id')->nullable();
            $table->string('receivable_type', 50)->nullable();
            $table->decimal('items_price', 10,2);
            $table->integer('coupon_id')->nullable();
            $table->decimal('discount', 10,2)->nullable();
            $table->decimal('final_price', 10,2);
            $table->decimal('total_paid', 10,2)->default('0');
            $table->decimal('tax', 10,2)->default('0');
            $table->decimal('total_cost', 10,2)->default('0');
            $table->text('note')->nullable();
            $table->timestamp('paid_date');
            $table->string('attached_pic', 40)->nullable();
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
        Schema::dropIfExists('invoices');
    }
}