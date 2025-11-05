<?php
// app/Models/ApiCredentials.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ApiCredentials extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'api_key',
        'api_secret',
        'api_token',
        'is_active',
        'environment',
        'api_version',
        'request_count',
        'request_limit',
        'last_used_at',
        'expires_at',
        'allowed_ips',
        'allowed_domains',
        'permissions',
        'webhook_url',
        'webhook_secret',
        'rate_limit_per_minute',
        'rate_limit_per_hour',
        'concurrent_requests_limit',
        'usage_statistics',
        'error_logs',
        'last_ip_address',
        'last_user_agent',
        'name',
        'description',
        'metadata'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'allowed_ips' => 'array',
        'allowed_domains' => 'array',
        'permissions' => 'array',
        'usage_statistics' => 'array',
        'error_logs' => 'array',
        'metadata' => 'array',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime'
    ];

    protected $hidden = [
        'api_secret',
        'webhook_secret'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($credential) {
            if (empty($credential->api_key)) {
                $credential->api_key = 'key_' . Str::random(32);
            }
            
            if (empty($credential->api_secret)) {
                $credential->api_secret = 'secret_' . Str::random(64);
            }
            
            if (empty($credential->api_token)) {
                $credential->api_token = 'token_' . Str::random(32);
            }
            
            if (empty($credential->name)) {
                $credential->name = 'API Key for ' . $credential->company->name;
            }
        });
    }

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function syncLogs()
    {
        return $this->hasMany(ApiSyncLog::class, 'company_id', 'company_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function ($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    });
    }

    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<=', now());
    }

    public function scopeByEnvironment($query, $environment)
    {
        return $query->where('environment', $environment);
    }

    public function scopeHasRequestsRemaining($query)
    {
        return $query->where('request_count', '<', \DB::raw('request_limit'));
    }

    public function scopeRecentlyUsed($query, $days = 7)
    {
        return $query->where('last_used_at', '>=', Carbon::now()->subDays($days));
    }

    // Accessors
    public function getIsExpiredAttribute()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function getRequestsRemainingAttribute()
    {
        return max(0, $this->request_limit - $this->request_count);
    }

    public function getUsagePercentageAttribute()
    {
        return $this->request_limit > 0 ? ($this->request_count / $this->request_limit) * 100 : 0;
    }

    public function getDaysUntilExpiryAttribute()
    {
        return $this->expires_at ? now()->diffInDays($this->expires_at, false) : null;
    }

    public function getIsRateLimitedAttribute()
    {
        // Check if rate limit is exceeded (simplified check)
        return $this->request_count >= $this->request_limit;
    }

    public function getFormattedLastUsedAttribute()
    {
        return $this->last_used_at ? $this->last_used_at->diffForHumans() : 'Never';
    }

    // Methods
    public function incrementRequestCount()
    {
        $this->update([
            'request_count' => $this->request_count + 1,
            'last_used_at' => now()
        ]);
    }

    public function resetRequestCount()
    {
        $this->update([
            'request_count' => 0
        ]);
    }

    public function activate()
    {
        $this->update(['is_active' => true]);
    }

    public function deactivate()
    {
        $this->update(['is_active' => false]);
    }

    public function regenerateKeys()
    {
        $this->update([
            'api_key' => 'key_' . Str::random(32),
            'api_secret' => 'secret_' . Str::random(64),
            'api_token' => 'token_' . Str::random(32)
        ]);
    }

    public function isIpAllowed($ip)
    {
        if (empty($this->allowed_ips)) {
            return true;
        }

        return in_array($ip, $this->allowed_ips);
    }

    public function isDomainAllowed($domain)
    {
        if (empty($this->allowed_domains)) {
            return true;
        }

        return in_array($domain, $this->allowed_domains);
    }

    public function hasPermission($permission)
    {
        if (empty($this->permissions)) {
            return true;
        }

        return in_array($permission, $this->permissions);
    }

    public function logUsage($ip = null, $userAgent = null)
    {
        $this->incrementRequestCount();
        
        if ($ip) {
            $this->update(['last_ip_address' => $ip]);
        }
        
        if ($userAgent) {
            $this->update(['last_user_agent' => $userAgent]);
        }

        // Update usage statistics
        $stats = $this->usage_statistics ?? [];
        $today = now()->format('Y-m-d');
        
        if (!isset($stats[$today])) {
            $stats[$today] = 0;
        }
        
        $stats[$today]++;
        $this->update(['usage_statistics' => $stats]);
    }

    public function logError($error)
    {
        $errors = $this->error_logs ?? [];
        $errors[] = [
            'error' => $error,
            'timestamp' => now()->toISOString(),
            'ip' => $this->last_ip_address
        ];
        
        // Keep only last 100 errors
        if (count($errors) > 100) {
            $errors = array_slice($errors, -100);
        }
        
        $this->update(['error_logs' => $errors]);
    }

    public function canMakeRequest()
    {
        return $this->is_active && 
               !$this->is_expired && 
               !$this->is_rate_limited;
    }

    public function getRateLimitInfo()
    {
        return [
            'requests_remaining' => $this->requests_remaining,
            'request_limit' => $this->request_limit,
            'rate_limit_per_minute' => $this->rate_limit_per_minute,
            'rate_limit_per_hour' => $this->rate_limit_per_hour,
            'usage_percentage' => $this->usage_percentage,
            'reset_time' => $this->getResetTime()
        ];
    }

    private function getResetTime()
    {
        // Assuming monthly reset - you can customize this
        return now()->endOfMonth()->toISOString();
    }
}