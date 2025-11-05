<?php
// database/migrations/2024_01_01_000012_create_job_promotions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_promotions', function (Blueprint $table) {
            $table->id();
            
            // Relationships
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('payment_plans')->onDelete('cascade');
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            
            // Promotion Period - Make them nullable
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            
            // Promotion Status & Tracking
            $table->boolean('is_active')->default(true);
            $table->boolean('is_paused')->default(false);
            $table->string('promotion_type')->default('featured');
            $table->string('external_promotion_id')->nullable()->unique();
            $table->string('promotion_channel')->nullable();
            
            // Performance Metrics
            $table->integer('view_count')->default(0);
            $table->integer('click_count')->default(0);
            $table->integer('application_count')->default(0);
            $table->decimal('click_through_rate', 5, 2)->default(0.00);
            $table->decimal('conversion_rate', 5, 2)->default(0.00);
            
            // Promotion Settings
            $table->json('targeting_criteria')->nullable();
            $table->json('promotion_placement')->nullable();
            $table->json('creative_assets')->nullable();
            $table->string('priority_level')->default('medium');
            
            // Budget & Bidding
            $table->decimal('daily_budget', 10, 2)->nullable()->default(null);
            $table->decimal('total_spent', 10, 2)->default(0.00);
            $table->decimal('max_cpc', 10, 2)->nullable()->default(null);
            $table->decimal('max_cpm', 10, 2)->nullable()->default(null);
            
            // Analytics & Optimization
            $table->json('performance_metrics')->nullable();
            $table->json('audience_insights')->nullable();
            $table->text('optimization_notes')->nullable();
            $table->boolean('auto_optimize')->default(true);
            
            // External Integration
            $table->json('external_metadata')->nullable();
            $table->string('sync_status')->default('synced');
            $table->timestamp('last_synced_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['is_active', 'end_date']);
            $table->index(['job_id', 'is_active']);
            $table->index(['plan_id', 'is_active']);
            $table->index(['start_date', 'end_date']);
            $table->index('promotion_type');
            $table->index('priority_level');
            $table->index('external_promotion_id');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_promotions');
    }
};