<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Service_itemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
            array('specialty_id' => '1' ,'branch_id' => "0", 'service_inv_cat_id' => "1" ,'name' => "حجز مجاني" ,'price' => "0" ,'pulses' => "" ,'package' => "" ,'package_items_number' => ""),
            array('specialty_id' => '1' ,'branch_id' => "0", 'service_inv_cat_id' => "3" ,'name' => "Money Per Pulse" ,'price' => "1.00" ,'pulses' => "1" ,'package' => "1" ,'package_items_number' => ""),
            array('specialty_id' => '1' ,'branch_id' => "0", 'service_inv_cat_id' => "3" ,'name' => "Free session" ,'price' => "0" ,'pulses' => "" ,'package' => "" ,'package_items_number' => ""),
            array('specialty_id' => '1' ,'branch_id' => "0", 'service_inv_cat_id' => "9" ,'name' => "اضافة الي المحفظة" ,'price' => "0" ,'pulses' => "" ,'package' => "" ,'package_items_number' => ""),
        );

        DB::table('service_items')->insert($items);
    }
}