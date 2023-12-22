<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Service_inv_catSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
            array('name' => 'الحجوزات'),
            array('name' => 'الجلسات'),
            array('name' => 'ليزر ازالة الشعر'),
            array('name' => 'المختبر'),
            array('name' => 'العمليات'),
            array('name' => 'التشغيل'),
            array('name' => 'مرتبات واجور'),
            array('name' => 'المخزون'),
            array('name' => 'المحفظة'),
        );

        DB::table('service_inv_cats')->insert($items);
    }
}