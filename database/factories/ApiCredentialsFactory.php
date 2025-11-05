<?php
// database/factories/ApiCredentialsFactory.php

namespace Database\Factories;

use App\Models\ApiCredentials;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ApiCredentialsFactory extends Factory
{
    protected $model = ApiCredentials::class;

    public function definition()
    {
        return [
            'company_id' => Company::factory(),
            'api_key' => 'key_' . Str::random(32),
            'api_secret' => 'secret_' . Str::random(64),
            'api_token' => 'token_' . Str::random(32),
            'is_active' => $this->faker->boolean(85),
            'environment' => $this->faker->randomElement(['sandbox', 'production']),
            'api_version' => 'v1',
            'request_count' => $this->faker->numberBetween(0, 500),
            'request_limit' => 1000,
            'last_used_at' => $this->faker->optional()->dateTimeBetween('-30 days', 'now'),
            'expires_at' => $this->faker->optional()->dateTimeBetween('+30 days', '+1 year'),
            'allowed_ips' => $this->faker->optional()->randomElements([
                '192.168.1.1', '10.0.0.1', '172.16.0.1', '203.0.113.1'
            ], 2),
            'allowed_domains' => $this->faker->optional()->randomElements([
                'example.com', 'api.example.com', 'webhook.example.com'
            ], 2),
            'permissions' => ['read', 'write', 'delete'],
            'webhook_url' => $this->faker->optional()->url(),
            'rate_limit_per_minute' => 60,
            'rate_limit_per_hour' => 1000,
            'concurrent_requests_limit' => 5,
            'name' => $this->faker->word() . ' API Key',
            'description' => $this->faker->sentence(),
        ];
    }

    // State Methods
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
                'expires_at' => $this->faker->dateTimeBetween('+30 days', '+1 year'),
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

    public function expired()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
                'expires_at' => $this->faker->dateTimeBetween('-30 days', '-1 day'),
            ];
        });
    }

    public function sandbox()
    {
        return $this->state(function (array $attributes) {
            return [
                'environment' => 'sandbox',
                'request_limit' => 100,
            ];
        });
    }

    public function production()
    {
        return $this->state(function (array $attributes) {
            return [
                'environment' => 'production',
                'request_limit' => 10000,
            ];
        });
    }

    public function withHighUsage()
    {
        return $this->state(function (array $attributes) {
            return [
                'request_count' => $this->faker->numberBetween(800, 950),
                'last_used_at' => $this->faker->dateTimeBetween('-1 day', 'now'),
            ];
        });
    }

    public function withIpRestrictions()
    {
        return $this->state(function (array $attributes) {
            return [
                'allowed_ips' => ['192.168.1.1', '10.0.0.1', '203.0.113.1'],
            ];
        });
    }
}