<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::create([
            'name' => 'System Admin',
            'email' => 'admin@foodshare.com',
            'password' => Hash::make('admin123'),
        ]);
        $adminUser->assignRole('admin');
    }
}
