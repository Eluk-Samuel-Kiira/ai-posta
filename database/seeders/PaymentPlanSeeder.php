<?php
// database/seeders/PaymentPlanSeeder.php

namespace Database\Seeders;

use App\Models\PaymentPlan;
use Illuminate\Database\Seeder;

class PaymentPlanSeeder extends Seeder
{
    public function run()
    {
        // Job Post Plans
        PaymentPlan::create([
            'name' => 'Basic Job Post',
            'type' => 'job_post',
            'amount' => 30000,
            'duration_days' => 30,
            'features' => ['30-day job listing', 'Basic search visibility', 'Application management'],
            'description' => 'Standard job posting for 30 days',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        PaymentPlan::create([
            'name' => 'Standard Job Post',
            'type' => 'job_post',
            'amount' => 50000,
            'duration_days' => 60,
            'features' => ['60-day job listing', 'Enhanced visibility', 'Candidate filtering', 'Email alerts'],
            'description' => 'Extended job posting with better visibility',
            'is_active' => true,
            'is_popular' => true,
            'sort_order' => 2,
        ]);

        PaymentPlan::create([
            'name' => 'Premium Job Post',
            'type' => 'job_post',
            'amount' => 80000,
            'duration_days' => 90,
            'features' => ['90-day job listing', 'Premium placement', 'Advanced analytics', 'Priority support'],
            'description' => 'Premium job posting with maximum visibility',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        // Featured Job Plans
        PaymentPlan::create([
            'name' => '7-Day Featured Boost',
            'type' => 'featured_job',
            'amount' => 100000,
            'duration_days' => 7,
            'features' => ['Top of search results', 'Highlighted in listings', 'Social media promotion'],
            'description' => 'Get your job featured for 7 days',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        PaymentPlan::create([
            'name' => '14-Day Featured Boost',
            'type' => 'featured_job',
            'amount' => 150000,
            'duration_days' => 14,
            'features' => ['Homepage feature', 'Email newsletter inclusion', 'Urgent job badge', 'Mobile push notifications'],
            'description' => 'Extended featuring with premium benefits',
            'is_active' => true,
            'is_popular' => true,
            'sort_order' => 5,
        ]);

        // Company Verification
        PaymentPlan::create([
            'name' => 'Company Verification',
            'type' => 'company_verification',
            'amount' => 100000,
            'duration_days' => 365,
            'features' => ['Verified badge on profile', 'Enhanced trust score', 'Priority in search results'],
            'description' => 'Get your company verified for one year',
            'is_active' => true,
            'sort_order' => 6,
        ]);

        // Premium Profile
        PaymentPlan::create([
            'name' => 'Premium Company Profile',
            'type' => 'premium_profile',
            'amount' => 200000,
            'duration_days' => 90,
            'features' => ['Enhanced company profile', 'Multiple active jobs', 'Advanced analytics', 'Dedicated support'],
            'description' => 'Premium company profile for 90 days',
            'is_active' => true,
            'sort_order' => 7,
        ]);

        PaymentPlan::create([
            'name' => 'Enterprise Profile',
            'type' => 'premium_profile',
            'amount' => 500000,
            'duration_days' => 365,
            'features' => ['Branded company page', 'Candidate database access', 'Custom application forms', 'API access', 'Dedicated account manager'],
            'description' => 'Enterprise-level profile with all features',
            'is_active' => true,
            'sort_order' => 8,
        ]);

        // Create additional plans using factory
        PaymentPlan::factory()
            ->count(5)
            ->create();

        $this->command->info('Payment plans seeded successfully!');
        $this->command->info('Total plans: ' . PaymentPlan::count());
        $this->command->info('Active plans: ' . PaymentPlan::where('is_active', true)->count());
        $this->command->info('Popular plans: ' . PaymentPlan::where('is_popular', true)->count());
    }
}