<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Expenses_itemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
            array('specialty_id' => '1', 'service_inv_cat_id' => "9", 'name' => "دفعة مقدمة للعاملين", 'price' => "0"),
        );

        DB::table('expenses_items')->insert($items);
    }
}