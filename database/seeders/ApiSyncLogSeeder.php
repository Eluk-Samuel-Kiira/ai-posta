<?php
// database/seeders/ApiSyncLogSeeder.php

namespace Database\Seeders;

use App\Models\ApiSyncLog;
use Illuminate\Database\Seeder;

class ApiSyncLogSeeder extends Seeder
{
    public function run()
    {
        // Clear existing logs
        ApiSyncLog::query()->delete();

        // Create pending sync logs
        ApiSyncLog::factory()
            ->count(20)
            ->pending()
            ->create();

        // Create successful sync logs
        ApiSyncLog::factory()
            ->count(50)
            ->success()
            ->create();

        // Create failed sync logs
        ApiSyncLog::factory()
            ->count(15)
            ->failed()
            ->create();

        // Create job-specific logs
        ApiSyncLog::factory()
            ->count(25)
            ->forJob()
            ->create();

        // Create company-specific logs
        ApiSyncLog::factory()
            ->count(15)
            ->forCompany()
            ->create();

        $this->command->info('API sync logs seeded successfully!');
        $this->command->info('Total logs: ' . ApiSyncLog::count());
        $this->command->info('Pending: ' . ApiSyncLog::pending()->count());
        $this->command->info('Successful: ' . ApiSyncLog::successful()->count());
        $this->command->info('Failed: ' . ApiSyncLog::failed()->count());
    }
}