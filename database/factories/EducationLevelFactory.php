<?php
// database/factories/EducationLevelFactory.php

namespace Database\Factories;

use App\Models\EducationLevel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EducationLevelFactory extends Factory
{
    protected $model = EducationLevel::class;

    public function definition()
    {
        $name = $this->faker->randomElement(['Diploma', 'Bachelor\'s Degree', 'Master\'s Degree']);
        $slug = Str::slug($name . '-jobs-uganda');

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->sentence(10),
            'meta_title' => "{$name} Jobs in Uganda - Education Requirements",
            'meta_description' => "Find jobs in Uganda requiring {$name}. Browse employment opportunities with specific education qualifications.",
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

    public function bachelors()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Bachelor\'s Degree',
                'slug' => 'bachelors-degree-jobs-uganda',
                'description' => 'Jobs requiring a bachelor\'s degree qualification',
                'meta_title' => 'Bachelor Degree Jobs in Uganda - Graduate Opportunities',
                'meta_description' => 'Browse jobs in Uganda requiring bachelor\'s degrees. Find graduate opportunities and professional positions for degree holders.',
                'sort_order' => 4,
            ];
        });
    }

    public function highSchool()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'High School',
                'slug' => 'high-school-jobs-uganda',
                'description' => 'Jobs requiring high school education (O-Level, A-Level)',
                'meta_title' => 'High School Jobs in Uganda - O-Level & A-Level Opportunities',
                'meta_description' => 'Find jobs in Uganda requiring high school education. Browse opportunities for secondary school graduates.',
                'sort_order' => 1,
            ];
        });
    }
}