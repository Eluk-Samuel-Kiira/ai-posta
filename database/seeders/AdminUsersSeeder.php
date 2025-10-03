<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'samuel',
            'name' => 'Samuel Kiira',
            'email' => 'samuelkiiraeluk@gmail.com',
            'password' => Hash::make('Samuel@13'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'martin',
            'name' => 'Martin Mubiru',
            'email' => 'martmub7@gmail.com',
            'password' => Hash::make('1234567890'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin users created successfully!');
        $this->command->info('Email: samuelkiiraeluk@gmail.com | Password: Samuel@13');
        $this->command->info('Email: martmub7@gmail.com | Password: 1234567890');
    }
}