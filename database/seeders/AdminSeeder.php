<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; // Make sure you have created the Admin model
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'System Admin',
            'email' => 'admin@foodshare.com',
            'password' => Hash::make('admin123'), // This will be your login password
        ]);
    }
}
