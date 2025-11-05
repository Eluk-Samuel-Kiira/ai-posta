<?php
// app/Models/JobPromotion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class JobPromotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_id',
        'plan_id',
        'transaction_id',
        'start_date',
        'end_date',
        'is_active',
        'is_paused',
        'promotion_type',
        'external_promotion_id',
        'promotion_channel',
        'view_count',
        'click_count',
        'application_count',
        'click_through_rate',
        'conversion_rate',
        'targeting_criteria',
        'promotion_placement',
        'creative_assets',
        'priority_level',
        'daily_budget',
        'total_spent',
        'max_cpc',
        'max_cpm',
        'performance_metrics',
        'audience_insights',
        'optimization_notes',
        'auto_optimize',
        'external_metadata',
        'sync_status',
        'last_synced_at'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'is_paused' => 'boolean',
        'targeting_criteria' => 'array',
        'promotion_placement' => 'array',
        'creative_assets' => 'array',
        'performance_metrics' => 'array',
        'audience_insights' => 'array',
        'external_metadata' => 'array',
        'auto_optimize' => 'boolean',
        'daily_budget' => 'decimal:2',
        'total_spent' => 'decimal:2',
        'max_cpc' => 'decimal:2',
        'max_cpm' => 'decimal:2',
        'click_through_rate' => 'decimal:2',
        'conversion_rate' => 'decimal:2',
        'last_synced_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($promotion) {
            if (empty($promotion->external_promotion_id)) {
                $promotion->external_promotion_id = 'PROMO_' . uniqid();
            }
            
            // Auto-calculate end date based on plan duration
            if ($promotion->plan && !$promotion->end_date) {
                $promotion->end_date = Carbon::parse($promotion->start_date)
                    ->addDays($promotion->plan->duration_days);
            }
        });

        static::updating(function ($promotion) {
            // Recalculate metrics if counts changed
            if ($promotion->isDirty(['view_count', 'click_count', 'application_count'])) {
                $promotion->calculateMetrics();
            }
        });
    }

    // Relationships
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function plan()
    {
        return $this->belongsTo(PaymentPlan::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where('is_paused', false)
                    ->where('end_date', '>', now());
    }

    public function scopeExpired($query)
    {
        return $query->where('end_date', '<=', now());
    }

    public function scopePaused($query)
    {
        return $query->where('is_paused', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('promotion_type', $type);
    }

    public function scopeFeatured($query)
    {
        return $query->where('promotion_type', 'featured');
    }

    public function scopeUrgent($query)
    {
        return $query->where('promotion_type', 'urgent');
    }

    public function scopeHighPriority($query)
    {
        return $query->where('priority_level', 'high');
    }

    public function scopeNeedsOptimization($query)
    {
        return $query->where('click_through_rate', '<', 2)
                    ->where('auto_optimize', true)
                    ->where('is_active', true);
    }

    // Accessors
    public function getIsExpiredAttribute()
    {
        return $this->end_date->isPast();
    }

    public function getDaysRemainingAttribute()
    {
        return now()->diffInDays($this->end_date, false);
    }

    public function getProgressPercentageAttribute()
    {
        $totalDuration = $this->start_date->diffInDays($this->end_date);
        $elapsed = $this->start_date->diffInDays(now());
        
        return min(100, max(0, ($elapsed / $totalDuration) * 100));
    }

    public function getPerformanceScoreAttribute()
    {
        $score = 0;
        
        if ($this->click_through_rate > 5) $score += 40;
        elseif ($this->click_through_rate > 2) $score += 25;
        else $score += 10;
        
        if ($this->conversion_rate > 10) $score += 40;
        elseif ($this->conversion_rate > 5) $score += 25;
        else $score += 10;
        
        if ($this->application_count > 0) $score += 20;
        
        return min(100, $score);
    }

    public function getBudgetUtilizationAttribute()
    {
        if (!$this->daily_budget) return 0;
        return min(100, ($this->total_spent / $this->daily_budget) * 100);
    }

    // Methods
    public function calculateMetrics()
    {
        $this->click_through_rate = $this->view_count > 0 
            ? ($this->click_count / $this->view_count) * 100 
            : 0;
            
        $this->conversion_rate = $this->click_count > 0 
            ? ($this->application_count / $this->click_count) * 100 
            : 0;
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
        $this->calculateMetrics();
        $this->save();
    }

    public function incrementClickCount()
    {
        $this->increment('click_count');
        $this->calculateMetrics();
        $this->save();
    }

    public function incrementApplicationCount()
    {
        $this->increment('application_count');
        $this->calculateMetrics();
        $this->save();
    }

    public function pause()
    {
        $this->update(['is_paused' => true]);
    }

    public function resume()
    {
        $this->update(['is_paused' => false]);
    }

    public function extend($days)
    {
        $this->update([
            'end_date' => $this->end_date->addDays($days)
        ]);
    }

    public function updateSpent($amount)
    {
        $this->increment('total_spent', $amount);
    }

    public function shouldAutoOptimize()
    {
        return $this->auto_optimize && 
               $this->is_active && 
               !$this->is_paused &&
               !$this->is_expired &&
               $this->performance_score < 60;
    }

    public function getOptimizationSuggestions()
    {
        $suggestions = [];
        
        if ($this->click_through_rate < 2) {
            $suggestions[] = 'Consider updating job title or increasing bid amount';
        }
        
        if ($this->conversion_rate < 5) {
            $suggestions[] = 'Review job description and requirements for better conversion';
        }
        
        if ($this->view_count < 100 && $this->days_remaining < 3) {
            $suggestions[] = 'Low visibility - consider increasing promotion budget';
        }
        
        return $suggestions;
    }
}