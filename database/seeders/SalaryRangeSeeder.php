<?php
// database/seeders/SalaryRangeSeeder.php

namespace Database\Seeders;

use App\Models\SalaryRange;
use Illuminate\Database\Seeder;

class SalaryRangeSeeder extends Seeder
{
    public function run()
    {
        $salaryRanges = [
            [
                'name' => 'Under UGX 500,000',
                'slug' => 'jobs-under-500k-uganda',
                'min_salary' => 0,
                'max_salary' => 500000,
                'meta_title' => 'Jobs Under UGX 500,000 in Uganda - Entry Level Positions',
                'meta_description' => 'Find jobs paying under UGX 500,000 in Uganda. Browse entry-level positions, junior roles, and starting salary opportunities across various sectors.',
                'sort_order' => 1
            ],
            [
                'name' => 'UGX 500,000 - UGX 1,000,000',
                'slug' => 'jobs-500k-to-1m-uganda',
                'min_salary' => 500000,
                'max_salary' => 1000000,
                'meta_title' => 'Jobs UGX 500,000 - 1 Million in Uganda - Mid-level Positions',
                'meta_description' => 'Browse jobs paying UGX 500,000 to 1 million in Uganda. Find mid-level positions, experienced professional roles with competitive salaries.',
                'sort_order' => 2
            ],
            [
                'name' => 'UGX 1,000,000 - UGX 2,000,000',
                'slug' => 'jobs-1m-to-2m-uganda',
                'min_salary' => 1000000,
                'max_salary' => 2000000,
                'meta_title' => 'Jobs UGX 1 - 2 Million in Uganda - Senior Level Positions',
                'meta_description' => 'Discover jobs paying UGX 1 to 2 million in Uganda. Find senior-level positions, management roles, and high-paying professional opportunities.',
                'sort_order' => 3
            ],
            [
                'name' => 'UGX 2,000,000 - UGX 5,000,000',
                'slug' => 'jobs-2m-to-5m-uganda',
                'min_salary' => 2000000,
                'max_salary' => 5000000,
                'meta_title' => 'Jobs UGX 2 - 5 Million in Uganda - Executive Positions',
                'meta_description' => 'Find jobs paying UGX 2 to 5 million in Uganda. Browse executive positions, director roles, and high-level management opportunities.',
                'sort_order' => 4
            ],
            [
                'name' => 'Over UGX 5,000,000',
                'slug' => 'jobs-over-5m-uganda',
                'min_salary' => 5000000,
                'max_salary' => null,
                'meta_title' => 'Jobs Over UGX 5 Million in Uganda - Top Executive Roles',
                'meta_description' => 'Discover high-paying jobs over UGX 5 million in Uganda. Find top executive positions, C-level roles, and highest paying career opportunities.',
                'sort_order' => 5
            ],
            [
                'name' => 'Negotiable Salary',
                'slug' => 'negotiable-salary-jobs-uganda',
                'min_salary' => null,
                'max_salary' => null,
                'meta_title' => 'Negotiable Salary Jobs in Uganda - Competitive Packages',
                'meta_description' => 'Browse jobs with negotiable salaries in Uganda. Find positions offering competitive compensation packages based on experience and qualifications.',
                'sort_order' => 6
            ],
        ];

        foreach ($salaryRanges as $range) {
            SalaryRange::create($range);
        }
    }
}