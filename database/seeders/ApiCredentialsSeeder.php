<?php
// database/seeders/ApiCredentialsSeeder.php

namespace Database\Seeders;

use App\Models\ApiCredentials;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ApiCredentialsSeeder extends Seeder
{
    public function run()
    {
        // Clear existing credentials
        ApiCredentials::query()->delete();

        $companies = Company::limit(20)->get();

        if ($companies->isEmpty()) {
            $this->command->warn('No companies found. Please run CompanySeeder first.');
            return;
        }

        // Create active production credentials
        foreach ($companies->take(15) as $company) {
            ApiCredentials::factory()
                ->for($company)
                ->production()
                ->active()
                ->create();
        }

        // Create sandbox credentials
        foreach ($companies->take(10) as $company) {
            ApiCredentials::factory()
                ->for($company)
                ->sandbox()
                ->active()
                ->create();
        }

        // Create credentials with high usage
        foreach ($companies->take(5) as $company) {
            ApiCredentials::factory()
                ->for($company)
                ->withHighUsage()
                ->active()
                ->create();
        }

        // Create some expired credentials
        foreach ($companies->take(3) as $company) {
            ApiCredentials::factory()
                ->for($company)
                ->expired()
                ->create();
        }

        // Create credentials with IP restrictions
        foreach ($companies->take(4) as $company) {
            ApiCredentials::factory()
                ->for($company)
                ->withIpRestrictions()
                ->active()
                ->create();
        }

        $this->command->info('API credentials seeded successfully!');
        $this->command->info('Total credentials: ' . ApiCredentials::count());
        $this->command->info('Active: ' . ApiCredentials::active()->count());
        $this->command->info('Production: ' . ApiCredentials::where('environment', 'production')->count());
        $this->command->info('Sandbox: ' . ApiCredentials::where('environment', 'sandbox')->count());
    }
}