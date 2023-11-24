<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Prox_settingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = array(
            array('option_name' => 'companytype', 'option_value' => "DR. Amr Saeed"),
            array('option_name' => 'companyname', 'option_value' => "Pain Cure"),
            array('option_name' => 'clinicdescription', 'option_value' => "| Pain cure"),
            array('option_name' => 'cliniclogo', 'option_value' => "paincurelogo.png"),
            array('option_name' => 'timeslotduration', 'option_value' => "45"),
            array('option_name' => 'timeslotcleanup', 'option_value' => "15"),
            array('option_name' => 'timeslotstart', 'option_value' => "14:00"),
            array('option_name' => 'timeslotend', 'option_value' => "22:00"),
            array('option_name' => 'timeslotweekends', 'option_value' => 'a:1:{i:0;s:6:"firday";}'),
            array('option_name' => 'workinghours', 'option_value' => "7"),
            array('option_name' => 'logo', 'option_value' => "pc-loader.png"),
            array('option_name' => 'tax', 'option_value' => "0"),
        );

        DB::table('prox_settings')->insert($options);
    }
}