<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use App\Models\Admin; // Make sure you have created the Admin model
// use Illuminate\Support\Facades\Hash;

// class AdminSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         Admin::create([
//             'name' => 'System Admin',
//             'email' => 'admin@foodshare.com',
//             'password' => Hash::make('admin123'),
//         ]);
//     }
// }

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Use the User model instead of Admin
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the user using the User model
        $adminUser = User::create([
            'name' => 'System Admin',
            'email' => 'admin@foodshare.com',
            'password' => Hash::make('admin123'),
        ]);

        // 2. Assign the 'admin' role (this requires RoleSeeder to have run first!)
        $adminUser->assignRole('admin');
    }
}
