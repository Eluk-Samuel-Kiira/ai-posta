<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            OccupationalCategorySeeder::class,
            JobCategorySeeder::class,
            IndustrySeeder::class,
            CompanySeeder::class,

            // Location & job details
            LocationSeeder::class,
            JobTypeSeeder::class,
            SalaryRangeSeeder::class,
            ExperienceLevelSeeder::class,
            EducationLevelSeeder::class,
            JobSeeder::class,
        ]);
    }
}
