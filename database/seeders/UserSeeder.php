<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@crm.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Manager Users
        User::create([
            'name' => 'Manager Sales',
            'email' => 'manager@crm.com',
            'password' => Hash::make('password123'),
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'Manager Operations',
            'email' => 'operations@crm.com',
            'password' => Hash::make('password123'),
            'role' => 'manager',
        ]);

        // Agent Users
        $agents = [
            ['name' => 'John Doe', 'email' => 'john@crm.com'],
            ['name' => 'Jane Smith', 'email' => 'jane@crm.com'],
            ['name' => 'Bob Wilson', 'email' => 'bob@crm.com'],
            ['name' => 'Alice Brown', 'email' => 'alice@crm.com'],
            ['name' => 'Charlie Davis', 'email' => 'charlie@crm.com'],
        ];

        foreach ($agents as $agent) {
            User::create([
                'name' => $agent['name'],
                'email' => $agent['email'],
                'password' => Hash::make('password123'),
                'role' => 'agent',
            ]);
        }
    }
}
