<?php
// database/migrations/2024_01_01_000015_create_api_credentials_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('api_credentials', function (Blueprint $table) {
            $table->id();
            
            // Company Relationship
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            
            // API Keys
            $table->string('api_key')->unique();
            $table->text('api_secret');
            $table->string('api_token')->nullable()->unique();
            
            // Status & Configuration
            $table->boolean('is_active')->default(true);
            $table->string('environment')->default('production'); // sandbox, production
            $table->string('api_version')->default('v1');
            
            // Usage Tracking
            $table->integer('request_count')->default(0);
            $table->integer('request_limit')->default(1000);
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            
            // Security
            $table->json('allowed_ips')->nullable();
            $table->json('allowed_domains')->nullable();
            $table->json('permissions')->nullable();
            $table->string('webhook_url')->nullable();
            $table->string('webhook_secret')->nullable();
            
            // Rate Limiting
            $table->integer('rate_limit_per_minute')->default(60);
            $table->integer('rate_limit_per_hour')->default(1000);
            $table->integer('concurrent_requests_limit')->default(5);
            
            // Analytics
            $table->json('usage_statistics')->nullable();
            $table->json('error_logs')->nullable();
            $table->string('last_ip_address')->nullable();
            $table->string('last_user_agent')->nullable();
            
            // Metadata
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            
            $table->timestamps();

            // Indexes
            $table->index(['company_id', 'is_active']);
            $table->index('api_key');
            $table->index('api_token');
            $table->index('environment');
            $table->index('last_used_at');
            $table->index('expires_at');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_credentials');
    }
};