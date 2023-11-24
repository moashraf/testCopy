<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default('2'); //(1= Real patients, 2= all leads, 3= Leades (Interested), 4= Leades (Not Interested))
            $table->tinyInteger('recommendation')->default('1'); //(1- Normal, 2- recommended, 3- not recommended)
            $table->decimal('wallet', 10,2)->default('0');
            $table->mediumInteger('balance')->default('0');
            $table->tinyInteger('ask_for_id')->nullable();
            $table->string('code', '20')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->smallInteger('first_branch_id');
            $table->string('first_name', 30);
            $table->string('second_name', 60);
            $table->string('mother_name', 60)->nullable();
            $table->string('avatar', 100)->nullable();
            $table->date('birthday');
            $table->enum('gendar', array('male', 'female'));
            $table->string('blood_type', 7);
            $table->smallInteger('height')->default('0');
            $table->smallInteger('weight')->default('0');
            $table->tinyInteger('heart_rate')->default('0');
            $table->string('bl_pressure', 5)->default('0');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->string('phone_number', 30)->unique();
            $table->string('sec_phone_number', 30)->nullable();
            $table->string('insurance', 30)->nullable();
            $table->smallInteger('from_recourse_id')->default('0');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('patients');
    }
}