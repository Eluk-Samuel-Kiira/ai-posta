<?php
// database/migrations/2024_01_01_000014_create_api_sync_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('api_sync_logs', function (Blueprint $table) {
            $table->id();
            
            // Resource Information
            $table->enum('resource_type', ['job', 'company', 'category', 'application']);
            $table->unsignedBigInteger('resource_id');
            $table->enum('action', ['create', 'update', 'delete']);
            
            // API Data
            $table->json('payload')->nullable();
            $table->json('response')->nullable();
            $table->text('error_message')->nullable();
            
            // Status & Tracking
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->integer('retry_count')->default(0);
            $table->timestamp('last_attempt_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            
            // External References
            $table->string('external_id')->nullable();
            $table->string('external_reference')->nullable();
            $table->string('api_endpoint')->nullable();
            $table->string('api_version')->nullable();
            
            // Performance Metrics
            $table->integer('response_time_ms')->nullable();
            $table->integer('payload_size_bytes')->nullable();
            $table->string('http_status_code')->nullable();
            
            // Additional Metadata
            $table->json('metadata')->nullable();
            $table->string('batch_id')->nullable();
            $table->string('correlation_id')->nullable();
            
            $table->timestamps();

            // Indexes
            $table->index(['resource_type', 'resource_id']);
            $table->index(['status', 'created_at']);
            $table->index('action');
            $table->index('external_id');
            $table->index('batch_id');
            $table->index('correlation_id');
            $table->index('created_at');
            $table->index(['status', 'retry_count']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_sync_logs');
    }
};