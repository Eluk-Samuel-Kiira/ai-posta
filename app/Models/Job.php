<?php
// app/Models/Job.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // Core Job Information
        'job_title', 'slug', 'job_description', 'responsibilities', 'skills',
        'qualifications', 'deadline', 'application_procedure', 'email', 'telephone',
        
        // Relationships
        'company_id', 'occupational_category_id', 'job_category_id', 'industry_id',
        'location_id', 'job_type_id', 'experience_level_id', 'education_level_id',
        'salary_range_id', 'poster_id',
        
        // Location & Salary
        'duty_station', 'street_address', 'salary_amount', 'currency',
        'payment_period', 'base_salary', 'location_type', 'applicant_location_requirements',
        'work_hours', 'employment_type',
        
        // SEO & AI
        'meta_title', 'meta_description', 'keywords', 'canonical_url', 'structured_data',
        'focus_keyphrase', 'seo_synonyms', 'is_pinged', 'last_pinged_at', 'is_indexed',
        'last_indexed_at', 'is_featured', 'is_urgent', 'is_active', 'is_verified',
        'view_count', 'application_count', 'click_count', 'ai_optimized_title',
        'ai_optimized_description', 'ai_content_analysis', 'seo_score', 'content_quality_score',
        'search_terms', 'competitor_analysis', 'ai_recommendations', 'search_impressions',
        'search_clicks', 'click_through_rate', 'google_rank', 'ranking_keywords',
        'social_shares', 'backlinks_count', 'social_metrics', 'published_at', 'featured_until'
    ];

    protected $casts = [
        'deadline' => 'date',
        'salary_amount' => 'decimal:2',
        'base_salary' => 'decimal:2',
        'is_pinged' => 'boolean',
        'is_indexed' => 'boolean',
        'is_featured' => 'boolean',
        'is_urgent' => 'boolean',
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
        'structured_data' => 'array',
        'search_terms' => 'array',
        'competitor_analysis' => 'array',
        'ranking_keywords' => 'array',
        'social_metrics' => 'array',
        'seo_score' => 'decimal:2',
        'content_quality_score' => 'decimal:2',
        'click_through_rate' => 'decimal:2',
        'published_at' => 'datetime',
        'featured_until' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = $job->generateAIOptimizedSlug();
            }
            
            if (empty($job->meta_title)) {
                $job->meta_title = $job->generateAIMetaTitle();
            }
            
            if (empty($job->meta_description)) {
                $job->meta_description = $job->generateAIMetaDescription();
            }
            
            if (empty($job->published_at)) {
                $job->published_at = now();
            }
            
            // AI-powered SEO optimization
            $job->runAISEOAnalysis();
        });

        static::updating(function ($job) {
            $seoRelevantFields = ['job_title', 'company_id', 'location_id', 'job_description', 'salary_amount'];
            
            if ($job->isDirty($seoRelevantFields)) {
                $job->slug = $job->generateAIOptimizedSlug();
                $job->meta_title = $job->generateAIMetaTitle();
                $job->meta_description = $job->generateAIMetaDescription();
                $job->runAISEOAnalysis();
            }
        });

        static::created(function ($job) {
            // Auto-ping search engines for new jobs
            if ($job->is_active) {
                $job->pingSearchEngines();
            }
        });
    }

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function occupationalCategory()
    {
        return $this->belongsTo(OccupationalCategory::class);
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function experienceLevel()
    {
        return $this->belongsTo(ExperienceLevel::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function salaryRange()
    {
        return $this->belongsTo(SalaryRange::class);
    }

    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    // AI-Powered SEO Methods
    public function generateAIOptimizedSlug()
    {
        $keywords = [
            $this->job_title,
            $this->company->name,
            $this->location->name,
            'jobs',
            'uganda',
            'vacancies',
            'careers'
        ];

        // AI: Prioritize most searched terms
        $slug = Str::slug(implode(' ', array_slice($keywords, 0, 4)));
        
        $baseSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? null)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function generateAIMetaTitle()
    {
        // AI: Analyze competitor titles and generate optimal title
        $templates = [
            "{$this->job_title} at {$this->company->name} - {$this->location->name} | UGX " . number_format($this->salary_amount ?? 0),
            "Hiring: {$this->job_title} in {$this->location->name} - {$this->company->name}",
            "{$this->job_title} Job - {$this->company->name} {$this->location->name} " . ($this->salary_amount ? "- UGX " . number_format($this->salary_amount) : ""),
            "Career Opportunity: {$this->job_title} at {$this->company->name}, {$this->location->name}",
        ];

        $selectedTitle = $templates[array_rand($templates)];
        return Str::limit($selectedTitle, 60);
    }

    public function generateAIMetaDescription()
    {
        $keyElements = [
            "Apply for {$this->job_title} position at {$this->company->name}",
            "Location: {$this->location->name}, Uganda",
            $this->salary_amount ? "Salary: UGX " . number_format($this->salary_amount) . " {$this->payment_period}" : "Competitive Salary",
            "Deadline: " . $this->deadline->format('F d, Y'),
            $this->employment_type ? "Employment: {$this->employment_type}" : "",
            "View requirements and apply now!"
        ];

        $description = implode('. ', array_filter($keyElements));
        return Str::limit($description, 155);
    }

    public function runAISEOAnalysis()
    {
        // AI: Comprehensive SEO analysis
        $this->seo_score = $this->calculateAISeoScore();
        $this->content_quality_score = $this->calculateContentQualityScore();
        $this->focus_keyphrase = $this->extractFocusKeyphrase();
        $this->search_terms = $this->generateSearchTerms();
        $this->structured_data = $this->generateAIOptimizedStructuredData();
        $this->ai_recommendations = $this->generateAIRecommendations();
    }

    public function calculateAISeoScore()
    {
        $score = 0;
        
        // Title Optimization (25 points)
        $title = $this->meta_title;
        $titleLength = strlen($title);
        if ($titleLength >= 50 && $titleLength <= 60) $score += 25;
        elseif ($titleLength >= 40 && $titleLength <= 70) $score += 20;
        else $score += 10;

        // Description Optimization (20 points)
        $description = $this->meta_description;
        $descLength = strlen($description);
        if ($descLength >= 150 && $descLength <= 160) $score += 20;
        elseif ($descLength >= 120 && $descLength <= 170) $score += 15;
        else $score += 5;

        // Content Quality (20 points)
        $contentLength = strlen($this->job_description);
        if ($contentLength >= 800) $score += 20;
        elseif ($contentLength >= 500) $score += 15;
        else $score += 5;

        // Keyword Optimization (15 points)
        $keywords = $this->extractKeywords();
        $keywordScore = min(count($keywords) * 3, 15);
        $score += $keywordScore;

        // Structured Data (10 points)
        if ($this->structured_data) $score += 10;

        // Completeness (10 points)
        if ($this->salary_amount && $this->qualifications && $this->responsibilities && $this->skills) $score += 10;

        return min($score, 100);
    }

    private function extractKeywords()
    {
        $text = $this->job_title . ' ' . $this->job_description . ' ' . $this->company->name . ' ' . $this->location->name;
        $commonWords = ['the', 'and', 'for', 'with', 'this', 'that', 'are', 'from'];
        
        $words = str_word_count(strtolower($text), 1);
        $wordCount = array_count_values($words);
        
        arsort($wordCount);
        
        $keywords = array_slice(array_keys($wordCount), 0, 20);
        return array_diff($keywords, $commonWords);
    }

    public function generateAIOptimizedStructuredData()
    {
        return [
            '@context' => 'https://schema.org/',
            '@type' => 'JobPosting',
            'title' => $this->job_title,
            'description' => strip_tags($this->job_description),
            'datePosted' => $this->published_at->toISOString(),
            'validThrough' => $this->deadline->endOfDay()->toISOString(),
            'employmentType' => $this->employment_type,
            'hiringOrganization' => [
                '@type' => 'Organization',
                'name' => $this->company->name,
                'logo' => $this->company->logo_url,
                'sameAs' => $this->company->website
            ],
            'jobLocation' => [
                '@type' => 'Place',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $this->street_address,
                    'addressLocality' => $this->location->name,
                    'addressCountry' => 'UG'
                ]
            ],
            'baseSalary' => $this->salary_amount ? [
                '@type' => 'MonetaryAmount',
                'currency' => $this->currency,
                'value' => [
                    '@type' => 'QuantitativeValue',
                    'minValue' => $this->salary_amount,
                    'maxValue' => $this->salary_amount,
                    'unitText' => $this->payment_period
                ]
            ] : null,
            'qualifications' => strip_tags($this->qualifications),
            'responsibilities' => strip_tags($this->responsibilities),
            'skills' => strip_tags($this->skills),
            'applicationContact' => [
                '@type' => 'ContactPoint',
                'email' => $this->email,
                'telephone' => $this->telephone
            ]
        ];
    }

    // Advanced SEO Methods
    public function pingSearchEngines()
    {
        if (!$this->is_pinged && $this->is_active) {
            // Implement AI-powered search engine pinging
            $this->pingGoogleIndexingAPI();
            $this->pingBingWebmaster();
            $this->submitSitemap();
            
            $this->update([
                'is_pinged' => true,
                'last_pinged_at' => now()
            ]);
        }
    }

    private function pingGoogleIndexingAPI()
    {
        // Implementation for Google Indexing API
        // This would notify Google immediately of new job posting
    }

    private function pingBingWebmaster()
    {
        // Implementation for Bing Webmaster Tools
    }

    private function submitSitemap()
    {
        // Update sitemap with new job URL
    }

    // Scopes for AI-Powered Queries
    public function scopeHighSeoScore($query, $minScore = 80)
    {
        return $query->where('seo_score', '>=', $minScore);
    }

    public function scopeAIOptimized($query)
    {
        return $query->where('seo_score', '>=', 75)
                    ->where('content_quality_score', '>=', 70)
                    ->whereNotNull('structured_data');
    }

    public function scopeTrending($query)
    {
        return $query->where('view_count', '>', 100)
                    ->where('created_at', '>=', now()->subDays(7))
                    ->orderBy('view_count', 'desc');
    }

    public function scopeBySeoKeywords($query, $keywords)
    {
        return $query->where(function ($q) use ($keywords) {
            foreach ($keywords as $keyword) {
                $q->orWhere('job_title', 'like', "%{$keyword}%")
                  ->orWhere('job_description', 'like', "%{$keyword}%")
                  ->orWhere('keywords', 'like', "%{$keyword}%");
            }
        });
    }

    // Accessors
    public function getIsExpiredAttribute()
    {
        return $this->deadline->isPast();
    }

    public function getIsFeaturedActiveAttribute()
    {
        return $this->is_featured && (!$this->featured_until || $this->featured_until->isFuture());
    }

    public function getSalaryFormattedAttribute()
    {
        if (!$this->salary_amount) return 'Negotiable';
        return 'UGX ' . number_format($this->salary_amount) . ($this->payment_period ? '/' . $this->payment_period : '');
    }

    public function getUrlAttribute()
    {
        return url("/jobs/{$this->slug}");
    }

    public function getCanonicalUrlAttribute()
    {
        return $this->getOriginal('canonical_url') ?? $this->url;
    }

    // AI Recommendation Methods
    private function generateAIRecommendations()
    {
        $recommendations = [];
        
        if (strlen($this->meta_title) < 50) {
            $recommendations[] = "Increase meta title length to 50-60 characters";
        }
        
        if (strlen($this->job_description) < 500) {
            $recommendations[] = "Expand job description to at least 500 characters for better SEO";
        }
        
        if (!$this->salary_amount) {
            $recommendations[] = "Add salary information to increase click-through rate";
        }
        
        if (!$this->structured_data) {
            $recommendations[] = "Add structured data for rich search results";
        }
        
        return implode('; ', $recommendations);
    }

    private function extractFocusKeyphrase()
    {
        $text = $this->job_title . ' ' . $this->location->name . ' ' . $this->company->name;
        $words = str_word_count(strtolower($text), 1);
        $wordCount = array_count_values($words);
        
        arsort($wordCount);
        return implode(' ', array_slice(array_keys($wordCount), 0, 3));
    }

    private function generateSearchTerms()
    {
        $baseTerms = [
            "{$this->job_title} jobs in {$this->location->name}",
            "{$this->job_title} {$this->location->name}",
            "{$this->company->name} careers",
            "{$this->industry->name} jobs uganda",
            "{$this->job_title} uganda",
            "vacancies at {$this->company->name}",
            "{$this->employment_type} jobs {$this->location->name}"
        ];

        if ($this->salary_amount) {
            $baseTerms[] = "jobs paying UGX " . number_format($this->salary_amount);
            $baseTerms[] = "{$this->job_title} salary uganda";
        }

        return $baseTerms;
    }

    private function calculateContentQualityScore()
    {
        $score = 0;
        
        // Description length
        $descLength = strlen($this->job_description);
        if ($descLength >= 800) $score += 30;
        elseif ($descLength >= 500) $score += 20;
        else $score += 10;
        
        // Requirements completeness
        if ($this->qualifications) $score += 20;
        if ($this->responsibilities) $score += 20;
        if ($this->skills) $score += 20;
        
        // Contact information
        if ($this->email || $this->telephone) $score += 10;
        
        return min($score, 100);
    }

    // Performance Tracking
    public function incrementViewCount()
    {
        $this->increment('view_count');
        $this->calculateClickThroughRate();
    }

    public function incrementApplicationCount()
    {
        $this->increment('application_count');
    }

    public function incrementClickCount()
    {
        $this->increment('click_count');
        $this->calculateClickThroughRate();
    }

    public function calculateClickThroughRate()
    {
        if ($this->search_impressions > 0) {
            $this->click_through_rate = ($this->click_count / $this->search_impressions) * 100;
            $this->save();
        }
    }

    // Business Methods
    public function markAsFeatured($days = 7)
    {
        $this->update([
            'is_featured' => true,
            'featured_until' => now()->addDays($days)
        ]);
    }

    public function markAsUrgent()
    {
        $this->update(['is_urgent' => true]);
    }

    public function activate()
    {
        $this->update(['is_active' => true, 'published_at' => now()]);
        $this->pingSearchEngines();
    }

    public function deactivate()
    {
        $this->update(['is_active' => false]);
    }
}