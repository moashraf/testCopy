<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('specialty_id');
            $table->smallInteger('branch_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name', 60);
            $table->string('second_name', 60);
            $table->string('avatar', 100)->nullable();
            $table->date('birthday');
            $table->enum('gendar', array('male', 'female'));
            $table->integer('country');
            $table->integer('city');
            $table->string('phone_number', 30)->unique();
            $table->string('sec_phone_number', 30)->nullable();
            $table->date('started_work');
            $table->text('note')->nullable();
            $table->tinyInteger('deactivate')->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}