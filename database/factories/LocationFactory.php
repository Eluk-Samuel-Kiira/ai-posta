<?php
// database/factories/LocationFactory.php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition()
    {
        $name = $this->faker->city();
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'type' => $this->faker->randomElement(['city', 'district']),
            'parent_id' => null,
            'description' => $this->faker->sentence(10),
            'meta_title' => "Jobs in {$name} Uganda - Career Opportunities & Vacancies",
            'meta_description' => "Find latest jobs in {$name} Uganda. Browse employment opportunities, career positions, and vacancies in {$name} region.",
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

    public function city()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'city',
            ];
        });
    }

    public function district()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'district',
            ];
        });
    }

    public function remote()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Remote Uganda',
                'slug' => 'remote-jobs-uganda',
                'type' => 'virtual',
                'meta_title' => 'Remote Jobs in Uganda - Work From Home Opportunities',
                'meta_description' => 'Find remote jobs in Uganda. Browse work from home opportunities, online jobs, and virtual positions available nationwide.',
            ];
        });
    }
}