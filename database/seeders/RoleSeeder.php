<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $donor = Role::firstOrCreate(['name' => 'donor']);
        $volunteer = Role::firstOrCreate(['name' => 'volunteer']);
        $member = Role::firstOrCreate(['name' => 'member']);

        $permission = Permission::firstOrCreate(['name' => 'approve donations']);
        $admin->givePermissionTo($permission);
    }
}
