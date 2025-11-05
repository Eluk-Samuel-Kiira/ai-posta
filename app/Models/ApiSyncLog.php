<?php
// app/Models/ApiSyncLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ApiSyncLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'resource_type',
        'resource_id',
        'action',
        'payload',
        'response',
        'error_message',
        'status',
        'retry_count',
        'last_attempt_at',
        'processed_at',
        'external_id',
        'external_reference',
        'api_endpoint',
        'api_version',
        'response_time_ms',
        'payload_size_bytes',
        'http_status_code',
        'metadata',
        'batch_id',
        'correlation_id'
    ];

    protected $casts = [
        'payload' => 'array',
        'response' => 'array',
        'metadata' => 'array',
        'last_attempt_at' => 'datetime',
        'processed_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($log) {
            if (empty($log->correlation_id)) {
                $log->correlation_id = 'CORR_' . uniqid();
            }
            
            // Calculate payload size
            if ($log->payload) {
                $log->payload_size_bytes = strlen(json_encode($log->payload));
            }
        });
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    public function scopeByResource($query, $type, $id)
    {
        return $query->where('resource_type', $type)->where('resource_id', $id);
    }

    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    public function scopeNeedsRetry($query)
    {
        return $query->where('status', 'failed')
                    ->where('retry_count', '<', 3)
                    ->where(function ($q) {
                        $q->whereNull('last_attempt_at')
                          ->orWhere('last_attempt_at', '<=', Carbon::now()->subMinutes(30));
                    });
    }

    public function scopeRecent($query, $hours = 24)
    {
        return $query->where('created_at', '>=', Carbon::now()->subHours($hours));
    }

    public function scopeByBatch($query, $batchId)
    {
        return $query->where('batch_id', $batchId);
    }

    // Accessors
    public function getIsPendingAttribute()
    {
        return $this->status === 'pending';
    }

    public function getIsSuccessfulAttribute()
    {
        return $this->status === 'success';
    }

    public function getIsFailedAttribute()
    {
        return $this->status === 'failed';
    }

    public function getCanRetryAttribute()
    {
        return $this->is_failed && 
               $this->retry_count < 3 && 
               (!$this->last_attempt_at || $this->last_attempt_at->diffInMinutes(now()) >= 30);
    }

    public function getRetryDelayMinutesAttribute()
    {
        // Exponential backoff: 30min, 60min, 120min
        return min(120, 30 * pow(2, $this->retry_count));
    }

    public function getFormattedResponseTimeAttribute()
    {
        if (!$this->response_time_ms) return 'N/A';
        return $this->response_time_ms . 'ms';
    }

    public function getFormattedPayloadSizeAttribute()
    {
        if (!$this->payload_size_bytes) return 'N/A';
        
        $size = $this->payload_size_bytes;
        $units = ['B', 'KB', 'MB', 'GB'];
        $unitIndex = 0;
        
        while ($size >= 1024 && $unitIndex < count($units) - 1) {
            $size /= 1024;
            $unitIndex++;
        }
        
        return round($size, 2) . ' ' . $units[$unitIndex];
    }

    // Methods
    public function markAsPending()
    {
        $this->update([
            'status' => 'pending',
            'last_attempt_at' => now()
        ]);
    }

    public function markAsSuccess($response = null, $externalId = null, $responseTime = null)
    {
        $this->update([
            'status' => 'success',
            'response' => $response,
            'external_id' => $externalId,
            'response_time_ms' => $responseTime,
            'processed_at' => now(),
            'http_status_code' => '200'
        ]);
    }

    public function markAsFailed($errorMessage = null, $response = null, $httpStatusCode = null)
    {
        $this->update([
            'status' => 'failed',
            'error_message' => $errorMessage,
            'response' => $response,
            'http_status_code' => $httpStatusCode,
            'retry_count' => $this->retry_count + 1,
            'last_attempt_at' => now()
        ]);
    }

    public function incrementRetryCount()
    {
        $this->update([
            'retry_count' => $this->retry_count + 1,
            'last_attempt_at' => now()
        ]);
    }

    public function getResourceModel()
    {
        $modelClass = match($this->resource_type) {
            'job' => \App\Models\Job::class,
            'company' => \App\Models\Company::class,
            'category' => \App\Models\JobCategory::class,
            'application' => \App\Models\JobApplication::class,
            default => null
        };

        return $modelClass ? $modelClass::find($this->resource_id) : null;
    }

    public function getResourceName()
    {
        $resource = $this->getResourceModel();
        return $resource ? $resource->name ?? $resource->title ?? 'Unknown' : 'Deleted Resource';
    }

    public function shouldRetry()
    {
        return $this->is_failed && 
               $this->retry_count < 3 && 
               (!$this->last_attempt_at || $this->last_attempt_at->diffInMinutes(now()) >= $this->retry_delay_minutes);
    }

    public function logAttempt($response = null, $responseTime = null, $httpStatusCode = null)
    {
        $this->update([
            'response' => $response,
            'response_time_ms' => $responseTime,
            'http_status_code' => $httpStatusCode,
            'last_attempt_at' => now()
        ]);
    }
}