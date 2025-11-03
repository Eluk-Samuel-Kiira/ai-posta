<?php
// database/factories/IndustryFactory.php

namespace Database\Factories;

use App\Models\Industry;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IndustryFactory extends Factory
{
    protected $model = Industry::class;

    public function definition()
    {
        $name = $this->faker->unique()->word . ' Industry';
        
        // Generate a unique slug
        $slug = Str::slug($name);
        $counter = 1;
        $originalSlug = $slug;
        
        while (Industry::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        
        return [
            'name' => $name,
            'slug' => $slug,
            'description' => "{$name} jobs and career opportunities in Uganda",
            'meta_title' => "{$name} Jobs in Uganda - Career Opportunities",
            'meta_description' => "Find {$name} jobs in Uganda. Browse career opportunities and apply for positions in {$name} sector.",
            'icon' => $this->faker->randomElement(['fa-industry', 'fa-building', 'fa-chart-line', 'fa-heart']),
            'is_active' => $this->faker->boolean(95),
            'sort_order' => $this->faker->numberBetween(41, 100), // Start after predefined industries
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
}