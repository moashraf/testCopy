<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            //super-admin is already created in Admin seeder
            'Branch-manager',
            'Receptionist',
            'Call-center',
            'Hr',
            'Lab',
            'Doctor',
            'Accountant',
            'Stocker',
            'Operation',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}