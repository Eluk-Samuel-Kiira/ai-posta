<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create 18 employer users
        User::factory()->count(12)->create();

        // Create 2 admin users
        User::factory()->count(2)->admin()->create();
        User::factory()->count(2)->volunteer()->create();
        User::factory()->count(2)->internee()->create();
        User::factory()->count(2)->employee()->create();

        

    }
}