<?php
// database/factories/ApiSyncLogFactory.php

namespace Database\Factories;

use App\Models\ApiSyncLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApiSyncLogFactory extends Factory
{
    protected $model = ApiSyncLog::class;

    public function definition()
    {
        $resourceTypes = ['job', 'company', 'category', 'application'];
        $actions = ['create', 'update', 'delete'];
        $statuses = ['pending', 'success', 'failed'];
        
        $resourceType = $this->faker->randomElement($resourceTypes);
        $action = $this->faker->randomElement($actions);
        $status = $this->faker->randomElement($statuses);

        return [
            'resource_type' => $resourceType,
            'resource_id' => $this->faker->numberBetween(1, 100),
            'action' => $action,
            'payload' => $this->generatePayload($resourceType, $action),
            'response' => $status === 'success' ? $this->generateSuccessResponse() : null,
            'error_message' => $status === 'failed' ? $this->faker->sentence() : null,
            'status' => $status,
            'retry_count' => $status === 'failed' ? $this->faker->numberBetween(1, 2) : 0,
            'last_attempt_at' => $status !== 'pending' ? $this->faker->dateTimeBetween('-1 week', 'now') : null,
            'processed_at' => $status !== 'pending' ? $this->faker->dateTimeBetween('-1 week', 'now') : null,
            'external_id' => $status === 'success' ? 'EXT_' . $this->faker->uuid() : null,
            'api_endpoint' => $this->generateEndpoint($resourceType, $action),
            'api_version' => 'v1',
            'response_time_ms' => $status !== 'pending' ? $this->faker->numberBetween(50, 2000) : null,
            'http_status_code' => $status === 'success' ? '200' : ($status === 'failed' ? '500' : null),
            'batch_id' => $this->faker->optional()->bothify('BATCH_#####'),
            'correlation_id' => 'CORR_' . uniqid(),
        ];
    }

    private function generatePayload($resourceType, $action)
    {
        $basePayload = [
            'action' => $action,
            'timestamp' => now()->toISOString(),
            'source' => 'katica-system'
        ];

        switch ($resourceType) {
            case 'job':
                $basePayload['job'] = [
                    'id' => $this->faker->numberBetween(1, 1000),
                    'title' => $this->faker->jobTitle(),
                    'company' => $this->faker->company(),
                    'location' => $this->faker->city()
                ];
                break;
            case 'company':
                $basePayload['company'] = [
                    'id' => $this->faker->numberBetween(1, 100),
                    'name' => $this->faker->company(),
                    'email' => $this->faker->companyEmail()
                ];
                break;
            case 'category':
                $basePayload['category'] = [
                    'id' => $this->faker->numberBetween(1, 50),
                    'name' => $this->faker->word(),
                    'slug' => $this->faker->slug()
                ];
                break;
            case 'application':
                $basePayload['application'] = [
                    'id' => $this->faker->numberBetween(1, 500),
                    'job_id' => $this->faker->numberBetween(1, 1000),
                    'candidate_name' => $this->faker->name()
                ];
                break;
        }

        return $basePayload;
    }

    private function generateSuccessResponse()
    {
        return [
            'success' => true,
            'message' => 'Operation completed successfully',
            'timestamp' => now()->toISOString(),
            'data' => [
                'id' => $this->faker->uuid(),
                'status' => 'processed'
            ]
        ];
    }

    private function generateEndpoint($resourceType, $action)
    {
        $baseUrl = 'https://api.external-system.com/v1/';
        
        switch ($resourceType) {
            case 'job': return $baseUrl . 'jobs';
            case 'company': return $baseUrl . 'companies';
            case 'category': return $baseUrl . 'categories';
            case 'application': return $baseUrl . 'applications';
            default: return $baseUrl . 'resources';
        }
    }

    // State Methods
    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'pending',
                'retry_count' => 0,
                'last_attempt_at' => null,
                'processed_at' => null,
                'response' => null,
                'error_message' => null,
            ];
        });
    }

    public function success()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'success',
                'response' => $this->generateSuccessResponse(),
                'external_id' => 'EXT_' . $this->faker->uuid(),
                'processed_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
                'response_time_ms' => $this->faker->numberBetween(50, 1000),
                'http_status_code' => '200',
                'error_message' => null,
            ];
        });
    }

    public function failed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'failed',
                'error_message' => $this->faker->sentence(),
                'retry_count' => $this->faker->numberBetween(1, 2),
                'last_attempt_at' => $this->faker->dateTimeBetween('-1 day', 'now'),
                'http_status_code' => '500',
                'response' => [
                    'success' => false,
                    'error' => 'Internal server error',
                    'timestamp' => now()->toISOString()
                ],
            ];
        });
    }

    public function forJob()
    {
        return $this->state(function (array $attributes) {
            return [
                'resource_type' => 'job',
                'resource_id' => $this->faker->numberBetween(1, 1000),
                'api_endpoint' => 'https://api.external-system.com/v1/jobs',
            ];
        });
    }

    public function forCompany()
    {
        return $this->state(function (array $attributes) {
            return [
                'resource_type' => 'company',
                'resource_id' => $this->faker->numberBetween(1, 100),
                'api_endpoint' => 'https://api.external-system.com/v1/companies',
            ];
        });
    }
}