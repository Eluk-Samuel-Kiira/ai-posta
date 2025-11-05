<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'uuid',
        'email',
        'first_name',
        'last_name',
        'phone',
        'user_type',
        'email_verified_at',
        'magic_link_token',
        'magic_link_sent_at',
        'magic_link_expires_at',
        'country_code',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'magic_link_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'magic_link_sent_at' => 'datetime',
        'magic_link_expires_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Role-based helper methods
    public function isSuperAdmin()
    {
        return $this->hasRole('super_admin');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin') || $this->hasRole('super_admin');
    }

    public function isEmployer()
    {
        return $this->hasRole('employer');
    }

    public function isJobSeeker()
    {
        return $this->hasRole('job_seeker');
    }

    public function isModerator()
    {
        return $this->hasRole('moderator');
    }

    public function isSupport()
    {
        return $this->hasRole('support');
    }

    // User type compatibility methods
    public function isEmployee()
    {
        return $this->user_type === 'employee' || $this->isJobSeeker();
    }

    public function isInternee()
    {
        return $this->user_type === 'internee' || $this->isJobSeeker();
    }

    public function isVolunteer()
    {
        return $this->user_type === 'volunteer' || $this->isJobSeeker();
    }

    public function isMagicLinkValid()
    {
        return $this->magic_link_token && 
               $this->magic_link_expires_at && 
               $this->magic_link_expires_at->isFuture();
    }

    // Scope methods for filtering by roles
    public function scopeSuperAdmins($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'super_admin');
        });
    }

    public function scopeAdmins($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->whereIn('name', ['super_admin', 'admin']);
        });
    }

    public function scopeEmployers($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'employer');
        });
    }

    public function scopeJobSeekers($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'job_seeker');
        });
    }

    public function scopeModerators($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'moderator');
        });
    }

    public function scopeSupport($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'support');
        });
    }
}