<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'email' => $this->faker->unique()->safeEmail(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'user_type' => 'employer',
            'email_verified_at' => now(),
            'magic_link_token' => null,
            'magic_link_sent_at' => null,
            'magic_link_expires_at' => null,
            'country_code' => 'UG',
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
            'last_login_at' => $this->faker->optional(0.7)->dateTimeBetween('-30 days', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'admin',
            ];
        });
    }

    public function employer()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'employer',
            ];
        });
    }

    public function internee()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'internee',
            ];
        });
    }

    public function volunteer()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'volunteer',
            ];
        });
    }

    public function employee()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_type' => 'employee',
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

    public function withMagicLink()
    {
        return $this->state(function (array $attributes) {
            return [
                'magic_link_token' => Str::random(60),
                'magic_link_sent_at' => now(),
                'magic_link_expires_at' => now()->addHours(24),
            ];
        });
    }
}