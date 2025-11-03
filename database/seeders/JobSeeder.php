<?php
// database/seeders/JobSeeder.php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run()
    {
        // Create regular jobs
        Job::factory()
            ->count(100)
            ->create();

        // Create featured jobs
        Job::factory()
            ->count(15)
            ->featured()
            ->create();

        // Create urgent jobs
        Job::factory()
            ->count(10)
            ->urgent()
            ->create();

        // Create remote jobs
        Job::factory()
            ->count(20)
            ->remote()
            ->create();

        // Create high-salary jobs
        Job::factory()
            ->count(25)
            ->highSalary()
            ->withSeoOptimized()
            ->create();

        $this->command->info('Jobs seeded successfully!');
        $this->command->info('Total jobs: ' . Job::count());
        $this->command->info('Featured jobs: ' . Job::where('is_featured', true)->count());
        $this->command->info('Urgent jobs: ' . Job::where('is_urgent', true)->count());
        $this->command->info('Remote jobs: ' . Job::where('location_type', 'remote')->count());
        $this->command->info('High SEO score jobs: ' . Job::where('seo_score', '>=', 80)->count());
    }
}