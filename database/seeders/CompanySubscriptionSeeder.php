<?php
// database/seeders/CompanySubscriptionSeeder.php

namespace Database\Seeders;

use App\Models\CompanySubscription;
use App\Models\Company;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CompanySubscriptionSeeder extends Seeder
{
    public function run()
    {
        // Clear existing subscriptions
        CompanySubscription::query()->delete();

        $companies = Company::limit(40)->get();
        $plans = PaymentPlan::whereIn('type', ['premium_profile', 'company_verification'])->get();
        $transactions = Transaction::successful()->limit(100)->get();

        if ($companies->isEmpty() || $plans->isEmpty() || $transactions->isEmpty()) {
            $this->command->warn('Need companies, premium/verification plans, and successful transactions to seed subscriptions.');
            $this->command->warn('Companies: ' . $companies->count() . ', Plans: ' . $plans->count() . ', Transactions: ' . $transactions->count());
            return;
        }

        $this->command->info('Creating company subscriptions...');

        // Create active subscriptions
        foreach ($companies->take(25) as $company) {
            CompanySubscription::factory()->create([
                'company_id' => $company->id,
                'plan_id' => $plans->random()->id,
                'transaction_id' => $transactions->random()->id,
                'is_active' => true,
                'subscription_status' => 'active',
                'start_date' => Carbon::now()->subDays(rand(1, 60)),
                'end_date' => Carbon::now()->addDays(rand(10, 300)),
            ]);
        }

        // Create premium subscriptions
        foreach ($companies->take(15) as $company) {
            $premiumPlan = $plans->where('type', 'premium_profile')->random();
            CompanySubscription::factory()->create([
                'company_id' => $company->id,
                'plan_id' => $premiumPlan->id,
                'transaction_id' => $transactions->random()->id,
                'jobs_limit' => rand(10, 50),
                'featured_jobs_limit' => rand(5, 20),
                'has_analytics' => true,
                'has_branding' => true,
                'has_premium_support' => true,
                'has_api_access' => rand(0, 1),
                'is_active' => true,
                'subscription_status' => 'active',
                'start_date' => Carbon::now()->subDays(rand(1, 30)),
                'end_date' => Carbon::now()->addDays(rand(60, 365)),
            ]);
        }

        // Create some expired subscriptions
        foreach ($companies->take(10) as $company) {
            CompanySubscription::factory()->create([
                'company_id' => $company->id,
                'plan_id' => $plans->random()->id,
                'transaction_id' => $transactions->random()->id,
                'is_active' => false,
                'subscription_status' => 'expired',
                'start_date' => Carbon::now()->subDays(rand(60, 365)),
                'end_date' => Carbon::now()->subDays(rand(1, 59)),
            ]);
        }

        $this->command->info('Company subscriptions seeded successfully!');
        $this->command->info('Total subscriptions: ' . CompanySubscription::count());
        $this->command->info('Active subscriptions: ' . CompanySubscription::active()->count());
        $this->command->info('Premium subscriptions: ' . CompanySubscription::whereHas('plan', function ($q) {
            $q->where('type', 'premium_profile');
        })->count());
    }
}