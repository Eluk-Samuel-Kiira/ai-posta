<?php
// database/seeders/CompanySeeder.php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Industry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    public function run()
    {
        // Real Ugandan companies data (same as before)
        $ugandanCompanies = [
            // Banking & Finance
            [
                'name' => 'Stanbic Bank Uganda',
                'description' => 'Leading commercial bank in Uganda offering banking and financial services',
                'website' => 'https://www.stanbicbank.co.ug',
                'contact_name' => 'Patrick Mweheire',
                'contact_email' => 'info@stanbicbank.co.ug',
                'contact_phone' => '+256 312 256 000',
                'address1' => 'Plot 6, Nile Avenue, Kampala, Uganda',
                'company_size' => '1000+ employees',
                'industry_id' => Industry::where('slug', 'banking-industry')->first()?->id,
                'is_verified' => true,
            ],
            // ... (include all the other companies from previous seeder)
        ];

        foreach ($ugandanCompanies as $companyData) {
            // Check if company already exists
            $existingCompany = Company::where('name', $companyData['name'])->first();
            
            if (!$existingCompany) {
                Company::create([
                    'name' => $companyData['name'],
                    'slug' => Str::slug($companyData['name']),
                    'description' => $companyData['description'],
                    'website' => $companyData['website'],
                    'contact_name' => $companyData['contact_name'],
                    'contact_email' => $companyData['contact_email'],
                    'contact_phone' => $companyData['contact_phone'],
                    'address1' => $companyData['address1'],
                    'company_size' => $companyData['company_size'],
                    'industry_id' => $companyData['industry_id'],
                    'is_active' => true,
                    'is_verified' => $companyData['is_verified'],
                ]);
            }
        }

        // Create additional fake companies using factory
        Company::factory()
            ->count(30)
            ->create();

        // Create some companies with specific traits
        Company::factory()
            ->count(10)
            ->withLogo()
            ->verified()
            ->active()
            ->create();

        Company::factory()
            ->count(5)
            ->largeCompany()
            ->withLogo()
            ->verified()
            ->create();

        Company::factory()
            ->count(8)
            ->smallCompany()
            ->active()
            ->create();

        // $this->command->info('Companies seeded successfully!');
        // $this->command->info('Total companies: ' . Company::count());
        // $this->command->info('Verified companies: ' . Company::where('is_verified', true)->count());
        // $this->command->info('Companies with logos: ' . Company::whereNotNull('logo')->count());
    }
}