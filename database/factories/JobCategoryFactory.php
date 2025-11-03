<?php
// database/factories/JobCategoryFactory.php

namespace Database\Factories;

use App\Models\JobCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobCategoryFactory extends Factory
{
    protected $model = JobCategory::class;

    public function definition()
    {
        $name = $this->faker->unique()->randomElement([
            'Software Development', 'Digital Marketing', 'Healthcare', 'Education', 
            'Sales', 'Customer Service', 'Finance', 'Human Resources'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => "Find {$name} jobs and career opportunities in Uganda",
            'meta_title' => "{$name} Jobs in Uganda - Find Career Opportunities",
            'meta_description' => "Discover latest {$name} job vacancies in Uganda. Apply now for exciting career opportunities in {$name}.",
            'icon' => $this->faker->randomElement(['fa-briefcase', 'fa-chart-line', 'fa-heart', 'fa-graduation-cap']),
            'is_active' => $this->faker->boolean(95),
            'sort_order' => $this->faker->numberBetween(1, 100),
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

    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'sort_order' => $this->faker->numberBetween(1, 10),
            ];
        });
    }
}