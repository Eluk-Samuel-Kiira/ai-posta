<?php
// database/factories/JobFactory.php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Company;
use App\Models\OccupationalCategory;
use App\Models\JobCategory;
use App\Models\Industry;
use App\Models\Location;
use App\Models\JobType;
use App\Models\ExperienceLevel;
use App\Models\EducationLevel;
use App\Models\SalaryRange;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        $jobTitle = $this->faker->randomElement([
            'Software Engineer', 'Marketing Manager', 'Sales Executive', 'Accountant',
            'Project Manager', 'Data Analyst', 'HR Officer', 'Customer Service Representative',
            'Operations Manager', 'Business Development Executive', 'IT Support Specialist',
            'Digital Marketing Specialist', 'Finance Officer', 'Administrative Assistant'
        ]);

        $company = Company::inRandomOrder()->first() ?? Company::factory()->create();
        $location = Location::inRandomOrder()->first() ?? Location::factory()->create();
        $salary = $this->faker->numberBetween(500000, 5000000);

        return [
            'job_title' => $jobTitle,
            'job_description' => $this->generateJobDescription($jobTitle, $company->name),
            'responsibilities' => $this->generateResponsibilities(),
            'skills' => $this->generateSkills(),
            'qualifications' => $this->generateQualifications(),
            'deadline' => Carbon::now()->addDays(rand(7, 30)),
            'application_procedure' => 'Send your CV and cover letter to the email provided',
            'email' => $this->faker->companyEmail(),
            'telephone' => '+256 ' . $this->faker->numerify('7## ######'),
            
            // Relationships
            'company_id' => $company->id,
            'occupational_category_id' => OccupationalCategory::inRandomOrder()->first()->id,
            'job_category_id' => JobCategory::inRandomOrder()->first()->id,
            'industry_id' => Industry::inRandomOrder()->first()->id,
            'location_id' => $location->id,
            'job_type_id' => JobType::inRandomOrder()->first()->id,
            'experience_level_id' => ExperienceLevel::inRandomOrder()->first()->id,
            'education_level_id' => EducationLevel::inRandomOrder()->first()->id,
            'salary_range_id' => SalaryRange::inRandomOrder()->first()->id,
            'poster_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            
            // Location & Address
            'duty_station' => $location->name,
            'street_address' => $this->faker->streetAddress(),
            
            // Salary Information
            'salary_amount' => $salary,
            'currency' => 'UGX',
            'payment_period' => 'monthly',
            'base_salary' => $salary,
            
            // Job Specifications
            'location_type' => $this->faker->randomElement(['on-site', 'remote', 'hybrid']),
            'applicant_location_requirements' => 'Must be based in ' . $location->name,
            'work_hours' => '8:00 AM - 5:00 PM, Monday - Friday',
            'employment_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract']),
            
            // SEO & AI will be auto-generated
            'is_active' => true,
            'is_verified' => $this->faker->boolean(80),
            'published_at' => Carbon::now()->subDays(rand(0, 7)),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Job $job) {
            // Auto-generate AI-powered SEO data
            $job->runAISEOAnalysis();
            $job->save();
        });
    }

    // State Methods
    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_featured' => true,
                'featured_until' => Carbon::now()->addDays(7),
            ];
        });
    }

    public function urgent()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_urgent' => true,
            ];
        });
    }

    public function remote()
    {
        return $this->state(function (array $attributes) {
            return [
                'location_type' => 'remote',
                'applicant_location_requirements' => 'Can work remotely from anywhere in Uganda',
            ];
        });
    }

    public function highSalary()
    {
        return $this->state(function (array $attributes) {
            return [
                'salary_amount' => $this->faker->numberBetween(3000000, 8000000),
                'base_salary' => $this->faker->numberBetween(3000000, 8000000),
            ];
        });
    }

    public function withSeoOptimized()
    {
        return $this->state(function (array $attributes) {
            return [
                'seo_score' => $this->faker->numberBetween(80, 95),
                'content_quality_score' => $this->faker->numberBetween(75, 90),
            ];
        });
    }

    // Helper Methods for Content Generation
    private function generateJobDescription($jobTitle, $companyName)
    {
        return "{$companyName} is seeking a highly motivated and experienced {$jobTitle} to join our dynamic team. This position offers an exciting opportunity to work in a fast-paced environment and contribute to the growth of our organization.

Key Responsibilities:
- Develop and implement strategic initiatives
- Collaborate with cross-functional teams
- Analyze market trends and provide insights
- Ensure high-quality delivery of projects

We are looking for a candidate who is passionate about innovation and has a proven track record of success in similar roles. The ideal candidate will possess strong analytical skills and excellent communication abilities.

Join us and be part of a company that values creativity, innovation, and professional growth.";
    }

    private function generateResponsibilities()
    {
        return "- Develop and implement business strategies
- Manage project timelines and deliverables
- Coordinate with team members and stakeholders
- Analyze data and prepare reports
- Ensure compliance with company policies
- Provide training and mentorship to junior staff
- Monitor industry trends and best practices";
    }

    private function generateSkills()
    {
        return "- Excellent communication skills
- Strong analytical and problem-solving abilities
- Proficiency in Microsoft Office Suite
- Project management experience
- Team leadership capabilities
- Attention to detail
- Time management skills";
    }

    private function generateQualifications()
    {
        return "- Bachelor's degree in relevant field
- 3+ years of experience in similar role
- Professional certification (preferred)
- Strong understanding of industry standards
- Proven track record of success
- Excellent interpersonal skills";
    }
}