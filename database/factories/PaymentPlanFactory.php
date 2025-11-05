<?php
// database/factories/PaymentPlanFactory.php

namespace Database\Factories;

use App\Models\PaymentPlan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentPlanFactory extends Factory
{
    protected $model = PaymentPlan::class;

    public function definition()
    {
        $types = ['job_post', 'featured_job', 'company_verification', 'premium_profile'];
        $type = $this->faker->randomElement($types);

        return [
            'name' => $this->generatePlanName($type),
            'type' => $type,
            'country_code' => 'UG',
            'amount' => $this->generateAmount($type),
            'currency' => 'UGX',
            'duration_days' => $this->generateDuration($type),
            'features' => $this->generateFeatures($type),
            'description' => $this->faker->sentence(10),
            'is_active' => $this->faker->boolean(90),
            'is_popular' => $this->faker->boolean(30),
            'sort_order' => $this->faker->numberBetween(1, 20),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (PaymentPlan $plan) {
            // Add gateway IDs if needed
            if ($plan->is_active) {
                $plan->update([
                    'stripe_price_id' => 'price_' . Str::random(14),
                    'flutterwave_plan_id' => 'PLN_' . Str::random(10)
                ]);
            }
        });
    }

    // State Methods
    public function jobPost()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'job_post',
                'name' => 'Standard Job Post',
                'amount' => 50000,
                'duration_days' => 30,
                'features' => ['30-day listing', 'Basic visibility', 'Email notifications'],
            ];
        });
    }

    public function featuredJob()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'featured_job',
                'name' => 'Featured Job Boost',
                'amount' => 150000,
                'duration_days' => 14,
                'features' => ['Top placement', 'Highlighted listing', 'Social media promotion', 'Priority support'],
                'is_popular' => true,
            ];
        });
    }

    public function companyVerification()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'company_verification',
                'name' => 'Company Verification',
                'amount' => 100000,
                'duration_days' => 365,
                'features' => ['Verified badge', 'Enhanced credibility', 'Priority in search', 'Trust indicator'],
            ];
        });
    }

    public function premiumProfile()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'premium_profile',
                'name' => 'Premium Company Profile',
                'amount' => 200000,
                'duration_days' => 90,
                'features' => ['Enhanced profile', 'Analytics dashboard', 'Multiple job slots', 'Dedicated support'],
            ];
        });
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
            ];
        });
    }

    public function popular()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_popular' => true,
            ];
        });
    }

    // Helper Methods
    private function generatePlanName($type)
    {
        $names = [
            'job_post' => ['Standard Job Post', 'Basic Listing', 'Job Vacancy Post'],
            'featured_job' => ['Featured Boost', 'Premium Placement', 'Top Job Spot'],
            'company_verification' => ['Company Verification', 'Trust Badge', 'Verified Profile'],
            'premium_profile' => ['Premium Profile', 'Business Plus', 'Enterprise Profile']
        ];

        return $this->faker->randomElement($names[$type]);
    }

    private function generateAmount($type)
    {
        $ranges = [
            'job_post' => [30000, 100000],
            'featured_job' => [100000, 300000],
            'company_verification' => [50000, 150000],
            'premium_profile' => [150000, 500000]
        ];

        return $this->faker->numberBetween($ranges[$type][0], $ranges[$type][1]);
    }

    private function generateDuration($type)
    {
        $durations = [
            'job_post' => [30, 60, 90],
            'featured_job' => [7, 14, 30],
            'company_verification' => [365],
            'premium_profile' => [90, 180, 365]
        ];

        return $this->faker->randomElement($durations[$type]);
    }

    private function generateFeatures($type)
    {
        $featureSets = [
            'job_post' => [
                ['30-day job listing', 'Basic search visibility', 'Application management'],
                ['60-day job listing', 'Enhanced visibility', 'Candidate filtering', 'Email alerts'],
                ['90-day job listing', 'Premium placement', 'Advanced analytics', 'Priority support']
            ],
            'featured_job' => [
                ['Top of search results', 'Highlighted in listings', 'Social media promotion'],
                ['Homepage feature', 'Email newsletter inclusion', 'Urgent job badge', 'Mobile push notifications']
            ],
            'company_verification' => [
                ['Verified badge on profile', 'Enhanced trust score', 'Priority in search results'],
                ['Background verification', 'Enhanced company profile', 'Dedicated account manager']
            ],
            'premium_profile' => [
                ['Enhanced company profile', 'Multiple active jobs', 'Advanced analytics'],
                ['Branded company page', 'Candidate database access', 'Custom application forms', 'API access']
            ]
        ];

        return $this->faker->randomElement($featureSets[$type]);
    }
}