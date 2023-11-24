<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'sett-show',
            'sett-create',
            'sett-edit',
            'sett-delete',
            'user-show',
            'user-create',
            'user-edit',
            'user-delete',
            'patient-show',
            'patient-create',
            'patient-edit',
            'patient-delete',
            'appointment-show',
            'appointment-create',
            'appointment-edit',
            'appointment-delete',
            'lab-show',
            'lab-create',
            'lab-edit',
            'lab-delete',
            'accounting-show',
            'accounting-create',
            'accounting-edit',
            'accounting-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}