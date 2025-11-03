<?php
// database/factories/JobTypeFactory.php

namespace Database\Factories;

use App\Models\JobType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobTypeFactory extends Factory
{
    protected $model = JobType::class;

    public function definition()
    {
        $name = $this->faker->randomElement(['Full-time', 'Part-time', 'Contract', 'Remote']);
        $slug = Str::slug($name . ' jobs uganda');

        return [
            'name' => $name . ' Jobs',
            'slug' => $slug,
            'description' => $this->faker->sentence(15),
            'meta_title' => "{$name} Jobs in Uganda - Employment Opportunities",
            'meta_description' => "Find {$name} jobs in Uganda. Browse employment opportunities and career positions across various industries and sectors.",
            'icon' => $this->faker->randomElement(['fa-briefcase', 'fa-clock', 'fa-file-contract', 'fa-laptop-house']),
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

    public function fullTime()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Full-time Jobs',
                'slug' => 'full-time-jobs-uganda',
                'meta_title' => 'Full-time Jobs in Uganda - Permanent Employment Opportunities',
                'meta_description' => 'Find full-time jobs in Uganda with permanent employment, regular hours, and career benefits across all industries.',
                'icon' => 'fa-briefcase',
                'sort_order' => 1,
            ];
        });
    }

    public function remote()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Remote Jobs',
                'slug' => 'remote-jobs-uganda',
                'meta_title' => 'Remote Jobs in Uganda - Work From Home Opportunities',
                'meta_description' => 'Browse remote jobs in Uganda. Find work from home opportunities, online positions, and virtual employment across various sectors.',
                'icon' => 'fa-laptop-house',
                'sort_order' => 2,
            ];
        });
    }
}