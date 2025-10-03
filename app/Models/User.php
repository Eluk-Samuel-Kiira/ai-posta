<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'company',
        'profile_image',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function loginTokens()
    {
        return $this->hasMany(LoginToken::class);
    }

    // Role checking methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isInsider()
    {
        return $this->role === 'insider';
    }

    public function isOutsider()
    {
        return $this->role === 'outsider';
    }

    // Scope methods for filtering by role
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeInsiders($query)
    {
        return $query->where('role', 'insider');
    }

    public function scopeOutsiders($query)
    {
        return $query->where('role', 'outsider');
    }

    // Profile image URL accessor
    // public function getProfileImageUrlAttribute()
    // {
    //     if ($this->profile_image) {
    //         return asset('storage/profile-images/' . $this->profile_image);
    //     }
        
    //     // Default profile image based on role
    //     return $this->getDefaultProfileImage();
    // }

    // protected function getDefaultProfileImage()
    // {
    //     $defaultImages = [
    //         'admin' => asset('images/default-admin.png'),
    //         'insider' => asset('images/default-insider.png'),
    //         'outsider' => asset('images/default-user.png'),
    //     ];

    //     return $defaultImages[$this->role] ?? asset('images/default-user.png');
    // }
}