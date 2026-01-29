<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// REMOVED: use RoleSeeder; (Not needed when in the same namespace)

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Roles & Permissions first!
        $this->call([
            RoleSeeder::class,
        ]);

        // 2. Then create your Admin/Users
        $this->call([
            AdminSeeder::class,
        ]);

        // Optional: Create a generic test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
