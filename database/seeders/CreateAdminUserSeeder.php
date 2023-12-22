<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Ahmed', 
            'second_name' => 'Mohammed',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'gendar' => 'male', 
            'birthday' => '1992/02/02',
            'country' => '64', 
            'city' => '312',
            'phone_number' => '012', 
            'sec_phone_number' => '012012',
            'branch_id' => '1', 
            'started_work' => '2011/02/02',
        ]);

        $role = Role::create(['name' => 'Super-admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}