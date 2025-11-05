<?php
// database/factories/JobPromotionFactory.php

namespace Database\Factories;

use App\Models\JobPromotion;
use App\Models\Job;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JobPromotionFactory extends Factory
{
    protected $model = JobPromotion::class;

    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-30 days', '+5 days');
        $endDate = Carbon::parse($startDate)->addDays($this->faker->numberBetween(7, 30));

        return [
            'job_id' => Job::factory(),
            'plan_id' => PaymentPlan::factory(),
            'transaction_id' => Transaction::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_active' => $this->faker->boolean(80),
            'is_paused' => $this->faker->boolean(10),
            'promotion_type' => $this->faker->randomElement(['featured', 'urgent', 'spotlight', 'homepage']),
            'external_promotion_id' => 'PROMO_' . Str::random(10),
            'promotion_channel' => $this->faker->randomElement(['web', 'mobile', 'email', 'social']),
            'view_count' => $this->faker->numberBetween(0, 5000),
            'click_count' => $this->faker->numberBetween(0, 500),
            'application_count' => $this->faker->numberBetween(0, 50),
            'priority_level' => $this->faker->randomElement(['low', 'medium', 'high', 'premium']),
            'daily_budget' => $this->faker->numberBetween(5000, 50000),
            'total_spent' => $this->faker->numberBetween(0, 200000),
            'max_cpc' => $this->faker->numberBetween(100, 1000),
            'auto_optimize' => $this->faker->boolean(70),
            'sync_status' => $this->faker->randomElement(['synced', 'pending', 'failed']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (JobPromotion $promotion) {
            // Calculate metrics after creation
            $promotion->calculateMetrics();
            $promotion->save();
        });
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
                'is_paused' => false,
                'start_date' => Carbon::now()->subDays(rand(1, 10)),
                'end_date' => Carbon::now()->addDays(rand(5, 20)),
            ];
        });
    }

    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'promotion_type' => 'featured',
                'priority_level' => 'high',
            ];
        });
    }

    public function highPerformance()
    {
        return $this->state(function (array $attributes) {
            return [
                'view_count' => $this->faker->numberBetween(1000, 5000),
                'click_count' => $this->faker->numberBetween(100, 500),
                'application_count' => $this->faker->numberBetween(20, 50),
            ];
        });
    }
}