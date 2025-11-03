<?php
// app/Models/ExperienceLevel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ExperienceLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'min_years',
        'max_years',
        'meta_title',
        'meta_description',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($experienceLevel) {
            if (empty($experienceLevel->slug)) {
                $experienceLevel->slug = Str::slug($experienceLevel->name);
            }
            if (empty($experienceLevel->meta_title)) {
                $experienceLevel->meta_title = "{$experienceLevel->name} Jobs in Uganda - Experience Requirements";
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getYearRangeAttribute()
    {
        if ($this->min_years && $this->max_years) {
            return "{$this->min_years}-{$this->max_years} years";
        } elseif ($this->min_years) {
            return "{$this->min_years}+ years";
        }
        return 'Not specified';
    }

    public function getSeoAttributes()
    {
        return [
            'title' => $this->meta_title,
            'description' => $this->meta_description,
            'keywords' => "{$this->name} jobs uganda, {$this->name} experience, {$this->name} positions"
        ];
    }

    public function getUrlAttribute()
    {
        return url("/experience/{$this->slug}");
    }
}