<?php
// database/factories/CompanySubscriptionFactory.php

namespace Database\Factories;

use App\Models\CompanySubscription;
use App\Models\Company;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class CompanySubscriptionFactory extends Factory
{
    protected $model = CompanySubscription::class;

    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-90 days', 'now');
        $endDate = Carbon::parse($startDate)->addDays($this->faker->numberBetween(30, 365));

        return [
            'company_id' => Company::factory(),
            'plan_id' => PaymentPlan::factory(),
            'transaction_id' => Transaction::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_active' => $this->faker->boolean(85),
            'auto_renew' => $this->faker->boolean(70),
            'jobs_limit' => $this->faker->numberBetween(1, 50),
            'jobs_used' => function (array $attributes) {
                return $this->faker->numberBetween(0, $attributes['jobs_limit']);
            },
            'featured_jobs_limit' => $this->faker->numberBetween(0, 10),
            'featured_jobs_used' => function (array $attributes) {
                return $this->faker->numberBetween(0, $attributes['featured_jobs_limit']);
            },
            'candidate_views_limit' => $this->faker->numberBetween(0, 1000),
            'candidate_views_used' => function (array $attributes) {
                return $this->faker->numberBetween(0, $attributes['candidate_views_limit']);
            },
            'ai_matches_limit' => $this->faker->numberBetween(0, 100),
            'ai_matches_used' => function (array $attributes) {
                return $this->faker->numberBetween(0, $attributes['ai_matches_limit']);
            },
            'has_analytics' => $this->faker->boolean(60),
            'has_branding' => $this->faker->boolean(40),
            'has_api_access' => $this->faker->boolean(20),
            'has_premium_support' => $this->faker->boolean(30),
            'billing_cycle' => $this->faker->randomElement(['monthly', 'quarterly', 'annual']),
            'subscription_status' => $this->faker->randomElement(['active', 'canceled', 'suspended']),
            'total_jobs_posted' => $this->faker->numberBetween(0, 100),
            'total_applications' => $this->faker->numberBetween(0, 500),
            'total_candidate_views' => $this->faker->numberBetween(0, 5000),
        ];
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
                'subscription_status' => 'active',
                'start_date' => Carbon::now()->subDays(rand(1, 60)),
                'end_date' => Carbon::now()->addDays(rand(10, 300)),
            ];
        });
    }

    public function premium()
    {
        return $this->state(function (array $attributes) {
            return [
                'jobs_limit' => $this->faker->numberBetween(10, 50),
                'featured_jobs_limit' => $this->faker->numberBetween(5, 20),
                'has_analytics' => true,
                'has_branding' => true,
                'has_premium_support' => true,
                'has_api_access' => $this->faker->boolean(50),
            ];
        });
    }

    public function expired()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
                'subscription_status' => 'expired',
                'start_date' => Carbon::now()->subDays(rand(60, 365)),
                'end_date' => Carbon::now()->subDays(rand(1, 59)),
            ];
        });
    }
}