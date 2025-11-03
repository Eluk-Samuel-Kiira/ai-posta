<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

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

    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isEmployer()
    {
        return $this->user_type === 'employer';
    }

    public function isEmployee()
    {
        return $this->user_type === 'employee';
    }

    public function isInternee()
    {
        return $this->user_type === 'internee';
    }

    public function isVolunteer()
    {
        return $this->user_type === 'volunteer';
    }

    public function isMagicLinkValid()
    {
        return $this->magic_link_token && 
               $this->magic_link_expires_at && 
               $this->magic_link_expires_at->isFuture();
    }
}