<?php
// database/migrations/2024_01_01_000013_create_company_subscriptions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('company_subscriptions', function (Blueprint $table) {
            $table->id();
            
            // Relationships
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('payment_plans')->onDelete('cascade');
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            
            // Subscription Period - Make them nullable
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('auto_renew')->default(true);
            
            // Usage Limits & Tracking
            $table->integer('jobs_limit')->default(1);
            $table->integer('jobs_used')->default(0);
            $table->integer('featured_jobs_limit')->default(0);
            $table->integer('featured_jobs_used')->default(0);
            $table->integer('candidate_views_limit')->default(0);
            $table->integer('candidate_views_used')->default(0);
            $table->integer('ai_matches_limit')->default(0);
            $table->integer('ai_matches_used')->default(0);
            
            // Advanced Features
            $table->boolean('has_analytics')->default(false);
            $table->boolean('has_branding')->default(false);
            $table->boolean('has_api_access')->default(false);
            $table->boolean('has_premium_support')->default(false);
            $table->boolean('has_custom_workflow')->default(false);
            $table->boolean('has_bulk_operations')->default(false);
            
            // Billing & Renewal
            $table->decimal('monthly_price', 10, 2)->nullable()->default(null);
            $table->decimal('annual_price', 10, 2)->nullable()->default(null);
            $table->string('billing_cycle')->default('monthly');
            $table->timestamp('next_billing_date')->nullable();
            $table->string('subscription_status')->default('active');
            $table->string('payment_gateway_subscription_id')->nullable();
            
            // Usage Analytics
            $table->json('usage_metrics')->nullable();
            $table->json('feature_usage')->nullable();
            $table->integer('total_jobs_posted')->default(0);
            $table->integer('total_applications')->default(0);
            $table->integer('total_candidate_views')->default(0);
            
            // Customization
            $table->json('custom_settings')->nullable();
            $table->json('whitelabel_settings')->nullable();
            $table->json('integration_settings')->nullable();
            
            // Compliance & Security
            $table->boolean('gdpr_compliant')->default(true);
            $table->boolean('data_retention_enabled')->default(true);
            $table->integer('data_retention_days')->default(730);
            
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['company_id', 'is_active']);
            $table->index(['plan_id', 'is_active']);
            $table->index(['start_date', 'end_date']);
            $table->index('subscription_status');
            $table->index('auto_renew');
            $table->index('next_billing_date');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_subscriptions');
    }
};