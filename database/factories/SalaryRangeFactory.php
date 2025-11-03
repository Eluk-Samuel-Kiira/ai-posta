<?php
// database/factories/SalaryRangeFactory.php

namespace Database\Factories;

use App\Models\SalaryRange;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SalaryRangeFactory extends Factory
{
    protected $model = SalaryRange::class;

    public function definition()
    {
        $min = $this->faker->numberBetween(500000, 2000000);
        $max = $min + $this->faker->numberBetween(500000, 3000000);
        $name = "UGX " . number_format($min) . " - UGX " . number_format($max);

        return [
            'name' => $name,
            'slug' => Str::slug("jobs-{$min}-to-{$max}-uganda"),
            'min_salary' => $min,
            'max_salary' => $max,
            'currency' => 'UGX',
            'meta_title' => "Jobs Paying {$name} in Uganda - Salary Range Opportunities",
            'meta_description' => "Find jobs in Uganda with salary range {$name}. Browse employment opportunities offering competitive compensation packages.",
            'is_active' => $this->faker->boolean(95),
            'sort_order' => $this->faker->numberBetween(1, 10),
        ];
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
            ];
        });
    }

    public function entryLevel()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Under UGX 500,000',
                'slug' => 'jobs-under-500k-uganda',
                'min_salary' => 0,
                'max_salary' => 500000,
                'meta_title' => 'Jobs Under UGX 500,000 in Uganda - Entry Level Positions',
                'meta_description' => 'Find jobs paying under UGX 500,000 in Uganda. Browse entry-level positions and starting salary opportunities across various sectors.',
                'sort_order' => 1,
            ];
        });
    }

    public function highPaying()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Over UGX 5,000,000',
                'slug' => 'jobs-over-5m-uganda',
                'min_salary' => 5000000,
                'max_salary' => null,
                'meta_title' => 'High Paying Jobs Over UGX 5 Million in Uganda',
                'meta_description' => 'Discover high-paying jobs over UGX 5 million in Uganda. Find executive positions and top salary opportunities across industries.',
                'sort_order' => 5,
            ];
        });
    }
}