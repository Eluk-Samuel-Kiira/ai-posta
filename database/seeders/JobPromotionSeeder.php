<?php
// database/seeders/JobPromotionSeeder.php

namespace Database\Seeders;

use App\Models\JobPromotion;
use App\Models\Job;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JobPromotionSeeder extends Seeder
{
    public function run()
    {
        // Clear existing promotions
        JobPromotion::query()->delete();

        $jobs = Job::limit(50)->get();
        $plans = PaymentPlan::where('type', 'featured_job')->get();
        $transactions = Transaction::successful()->limit(100)->get();

        if ($jobs->isEmpty() || $plans->isEmpty() || $transactions->isEmpty()) {
            $this->command->warn('Need jobs, featured job plans, and successful transactions to seed promotions.');
            $this->command->warn('Jobs: ' . $jobs->count() . ', Plans: ' . $plans->count() . ', Transactions: ' . $transactions->count());
            return;
        }

        $this->command->info('Creating job promotions...');

        // Create active promotions
        foreach ($jobs->take(30) as $job) {
            JobPromotion::factory()->create([
                'job_id' => $job->id,
                'plan_id' => $plans->random()->id,
                'transaction_id' => $transactions->random()->id,
                'is_active' => true,
                'is_paused' => false,
                'start_date' => Carbon::now()->subDays(rand(1, 10)),
                'end_date' => Carbon::now()->addDays(rand(5, 20)),
            ]);
        }

        // Create featured promotions
        foreach ($jobs->take(15) as $job) {
            JobPromotion::factory()->create([
                'job_id' => $job->id,
                'plan_id' => $plans->random()->id,
                'transaction_id' => $transactions->random()->id,
                'promotion_type' => 'featured',
                'priority_level' => 'high',
                'is_active' => true,
                'start_date' => Carbon::now()->subDays(rand(1, 5)),
                'end_date' => Carbon::now()->addDays(rand(10, 30)),
            ]);
        }

        // Create high-performance promotions
        foreach ($jobs->take(10) as $job) {
            JobPromotion::factory()->create([
                'job_id' => $job->id,
                'plan_id' => $plans->random()->id,
                'transaction_id' => $transactions->random()->id,
                'view_count' => rand(1000, 5000),
                'click_count' => rand(100, 500),
                'application_count' => rand(20, 50),
                'is_active' => true,
                'start_date' => Carbon::now()->subDays(rand(1, 15)),
                'end_date' => Carbon::now()->addDays(rand(5, 25)),
            ]);
        }

        // Create some expired promotions
        foreach ($jobs->take(5) as $job) {
            JobPromotion::factory()->create([
                'job_id' => $job->id,
                'plan_id' => $plans->random()->id,
                'transaction_id' => $transactions->random()->id,
                'is_active' => false,
                'start_date' => Carbon::now()->subDays(60),
                'end_date' => Carbon::now()->subDays(30),
            ]);
        }

        // Calculate metrics for all promotions
        JobPromotion::all()->each(function ($promotion) {
            $promotion->calculateMetrics();
            $promotion->save();
        });

        $this->command->info('Job promotions seeded successfully!');
        $this->command->info('Total promotions: ' . JobPromotion::count());
        $this->command->info('Active promotions: ' . JobPromotion::active()->count());
        $this->command->info('Featured promotions: ' . JobPromotion::where('promotion_type', 'featured')->count());
    }
}