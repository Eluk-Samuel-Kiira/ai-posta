<?php

namespace Database\Factories;

use App\Models\OccupationalCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class OccupationalCategoryFactory extends Factory
{
    protected $model = OccupationalCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->sentence,
            'industry_sector' => $this->faker->randomElement([
                'Business', 'Technology', 'Healthcare', 'Education', 'Creative', 'Industrial', 'Services'
            ]),
            'is_active' => $this->faker->boolean(90),
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

    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }
}