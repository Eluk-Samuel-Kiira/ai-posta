<?php
// app/Models/CompanySubscription.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class CompanySubscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'plan_id',
        'transaction_id',
        'start_date',
        'end_date',
        'is_active',
        'auto_renew',
        'jobs_limit',
        'jobs_used',
        'featured_jobs_limit',
        'featured_jobs_used',
        'candidate_views_limit',
        'candidate_views_used',
        'ai_matches_limit',
        'ai_matches_used',
        'has_analytics',
        'has_branding',
        'has_api_access',
        'has_premium_support',
        'has_custom_workflow',
        'has_bulk_operations',
        'monthly_price',
        'annual_price',
        'billing_cycle',
        'next_billing_date',
        'subscription_status',
        'payment_gateway_subscription_id',
        'usage_metrics',
        'feature_usage',
        'total_jobs_posted',
        'total_applications',
        'total_candidate_views',
        'custom_settings',
        'whitelabel_settings',
        'integration_settings',
        'gdpr_compliant',
        'data_retention_enabled',
        'data_retention_days'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'next_billing_date' => 'datetime',
        'is_active' => 'boolean',
        'auto_renew' => 'boolean',
        'has_analytics' => 'boolean',
        'has_branding' => 'boolean',
        'has_api_access' => 'boolean',
        'has_premium_support' => 'boolean',
        'has_custom_workflow' => 'boolean',
        'has_bulk_operations' => 'boolean',
        'gdpr_compliant' => 'boolean',
        'data_retention_enabled' => 'boolean',
        'monthly_price' => 'decimal:2',
        'annual_price' => 'decimal:2',
        'usage_metrics' => 'array',
        'feature_usage' => 'array',
        'custom_settings' => 'array',
        'whitelabel_settings' => 'array',
        'integration_settings' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            if (!$subscription->start_date) {
                $subscription->start_date = now();
            }
            
            if (!$subscription->end_date && $subscription->plan) {
                $subscription->end_date = Carbon::parse($subscription->start_date)
                    ->addDays($subscription->plan->duration_days);
            }
            
            // Set next billing date
            if ($subscription->auto_renew) {
                $subscription->next_billing_date = $subscription->end_date;
            }
        });
    }

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function plan()
    {
        return $this->belongsTo(PaymentPlan::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function jobPosts()
    {
        return $this->hasMany(Job::class, 'company_id', 'company_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where('end_date', '>', now())
                    ->where('subscription_status', 'active');
    }

    public function scopeExpired($query)
    {
        return $query->where('end_date', '<=', now())
                    ->orWhere('subscription_status', 'expired');
    }

    public function scopeAutoRenew($query)
    {
        return $query->where('auto_renew', true);
    }

    public function scopeTrial($query)
    {
        return $query->where('plan_id', function ($q) {
            $q->select('id')
              ->from('payment_plans')
              ->where('amount', 0);
        });
    }

    public function scopePremium($query)
    {
        return $query->whereHas('plan', function ($q) {
            $q->where('type', 'premium_profile')
              ->orWhere('amount', '>', 100000);
        });
    }

    // Accessors
    public function getIsExpiredAttribute()
    {
        return $this->end_date->isPast() || $this->subscription_status === 'expired';
    }

    public function getDaysRemainingAttribute()
    {
        return now()->diffInDays($this->end_date, false);
    }

    public function getJobsRemainingAttribute()
    {
        return max(0, $this->jobs_limit - $this->jobs_used);
    }

    public function getFeaturedJobsRemainingAttribute()
    {
        return max(0, $this->featured_jobs_limit - $this->featured_jobs_used);
    }

    public function getCandidateViewsRemainingAttribute()
    {
        return max(0, $this->candidate_views_limit - $this->candidate_views_used);
    }

    public function getAiMatchesRemainingAttribute()
    {
        return max(0, $this->ai_matches_limit - $this->ai_matches_used);
    }

    public function getUtilizationRateAttribute()
    {
        $total_limit = $this->jobs_limit + $this->featured_jobs_limit + $this->candidate_views_limit;
        $total_used = $this->jobs_used + $this->featured_jobs_used + $this->candidate_views_used;
        
        return $total_limit > 0 ? ($total_used / $total_limit) * 100 : 0;
    }

    public function getMonthlyCostAttribute()
    {
        if ($this->billing_cycle === 'annual' && $this->annual_price) {
            return $this->annual_price / 12;
        }
        
        return $this->monthly_price ?? $this->plan->amount;
    }

    // Methods
    public function canPostJob()
    {
        return $this->is_active && 
               !$this->is_expired && 
               $this->jobs_used < $this->jobs_limit;
    }

    public function canPostFeaturedJob()
    {
        return $this->is_active && 
               !$this->is_expired && 
               $this->featured_jobs_used < $this->featured_jobs_limit;
    }

    public function incrementJobUsage()
    {
        $this->increment('jobs_used');
        $this->increment('total_jobs_posted');
    }

    public function incrementFeaturedJobUsage()
    {
        $this->increment('featured_jobs_used');
    }

    public function incrementCandidateViews($count = 1)
    {
        $this->increment('candidate_views_used', $count);
        $this->increment('total_candidate_views', $count);
    }

    public function incrementAiMatches($count = 1)
    {
        $this->increment('ai_matches_used', $count);
    }

    public function incrementApplications($count = 1)
    {
        $this->increment('total_applications', $count);
    }

    public function activate()
    {
        $this->update([
            'is_active' => true,
            'subscription_status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addDays($this->plan->duration_days)
        ]);
    }

    public function cancel()
    {
        $this->update([
            'auto_renew' => false,
            'subscription_status' => 'canceled',
            'next_billing_date' => null
        ]);
    }

    public function suspend()
    {
        $this->update([
            'is_active' => false,
            'subscription_status' => 'suspended'
        ]);
    }

    public function renew($transaction = null)
    {
        $this->update([
            'start_date' => now(),
            'end_date' => now()->addDays($this->plan->duration_days),
            'is_active' => true,
            'subscription_status' => 'active',
            'jobs_used' => 0,
            'featured_jobs_used' => 0,
            'candidate_views_used' => 0,
            'ai_matches_used' => 0
        ]);

        if ($transaction) {
            $this->transaction()->associate($transaction);
        }

        $this->save();
    }

    public function upgrade(PaymentPlan $newPlan, Transaction $transaction)
    {
        $this->update([
            'plan_id' => $newPlan->id,
            'transaction_id' => $transaction->id,
            'jobs_limit' => $this->calculateUpgradedLimit('jobs_limit', $newPlan),
            'featured_jobs_limit' => $this->calculateUpgradedLimit('featured_jobs_limit', $newPlan),
            'monthly_price' => $newPlan->amount,
            'billing_cycle' => 'monthly'
        ]);

        // Prorate or extend subscription based on business rules
        $this->extendSubscription($newPlan);
    }

    private function calculateUpgradedLimit($limitType, PaymentPlan $newPlan)
    {
        // Implement logic to calculate new limits based on plan features
        $baseLimits = [
            'starter' => ['jobs_limit' => 5, 'featured_jobs_limit' => 1],
            'business' => ['jobs_limit' => 15, 'featured_jobs_limit' => 5],
            'enterprise' => ['jobs_limit' => 999, 'featured_jobs_limit' => 50]
        ];

        // Extract plan tier from name
        $planName = strtolower($newPlan->name);
        foreach ($baseLimits as $tier => $limits) {
            if (str_contains($planName, $tier)) {
                return $limits[$limitType] ?? $this->$limitType;
            }
        }

        return $this->$limitType;
    }

    private function extendSubscription(PaymentPlan $newPlan)
    {
        // Add extra days when upgrading as a bonus
        $bonusDays = 7; // 1 week bonus for upgrading
        $this->update([
            'end_date' => $this->end_date->addDays($bonusDays)
        ]);
    }

    public function getUsageAlerts()
    {
        $alerts = [];

        if ($this->jobs_used >= $this->jobs_limit * 0.9) {
            $alerts[] = 'Job posting limit nearly reached';
        }

        if ($this->featured_jobs_used >= $this->featured_jobs_limit * 0.9) {
            $alerts[] = 'Featured job limit nearly reached';
        }

        if ($this->days_remaining < 7) {
            $alerts[] = 'Subscription expires in ' . $this->days_remaining . ' days';
        }

        return $alerts;
    }

    public function trackFeatureUsage($feature, $data = [])
    {
        $currentUsage = $this->feature_usage ?? [];
        $currentUsage[$feature] = array_merge($currentUsage[$feature] ?? [], $data, [
            'last_used' => now()->toISOString(),
            'usage_count' => ($currentUsage[$feature]['usage_count'] ?? 0) + 1
        ]);

        $this->update(['feature_usage' => $currentUsage]);
    }
}