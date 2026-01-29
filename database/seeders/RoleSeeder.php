<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    // public function run(): void
    // {
    //     // Create Roles
    //     $admin = Role::create(['name' => 'admin']);
    //     $donor = Role::create(['name' => 'donor']);
    //     $volunteer = Role::create(['name' => 'volunteer']);

    //     // Create a sample Permission
    //     $permission = Permission::create(['name' => 'approve donations']);

    //     // Give admin all permissions
    //     $admin->givePermissionTo($permission);
    // }

    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $donor = Role::firstOrCreate(['name' => 'donor']);
        $volunteer = Role::firstOrCreate(['name' => 'volunteer']);

        $permission = Permission::firstOrCreate(['name' => 'approve donations']);
        $admin->givePermissionTo($permission);
    }
}
