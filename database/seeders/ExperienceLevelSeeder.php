<?php
// database/seeders/ExperienceLevelSeeder.php

namespace Database\Seeders;

use App\Models\ExperienceLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExperienceLevelSeeder extends Seeder
{
    public function run()
    {
        $experienceLevels = [
            [
                'name' => 'Entry Level',
                'slug' => 'entry-level-jobs-uganda',
                'description' => 'Jobs requiring 0-2 years of experience, suitable for fresh graduates and career starters',
                'meta_title' => 'Entry Level Jobs in Uganda - Fresh Graduate Opportunities',
                'meta_description' => 'Find entry level jobs in Uganda for fresh graduates and career starters. Browse positions requiring 0-2 years experience across various industries.',
                'sort_order' => 1
            ],
            [
                'name' => 'Junior Level',
                'slug' => 'junior-jobs-uganda',
                'description' => 'Positions requiring 2-4 years of professional experience',
                'meta_title' => 'Junior Level Jobs in Uganda - 2-4 Years Experience',
                'meta_description' => 'Browse junior level jobs in Uganda requiring 2-4 years experience. Find positions for early-career professionals across multiple sectors.',
                'sort_order' => 2
            ],
            [
                'name' => 'Mid Level',
                'slug' => 'mid-level-jobs-uganda',
                'description' => 'Professional roles requiring 4-7 years of relevant experience',
                'meta_title' => 'Mid Level Jobs in Uganda - 4-7 Years Experience',
                'meta_description' => 'Discover mid level jobs in Uganda requiring 4-7 years experience. Find professional roles for experienced candidates across industries.',
                'sort_order' => 3
            ],
            [
                'name' => 'Senior Level',
                'slug' => 'senior-jobs-uganda',
                'description' => 'Senior positions requiring 7+ years of specialized experience',
                'meta_title' => 'Senior Level Jobs in Uganda - 7+ Years Experience',
                'meta_description' => 'Find senior level jobs in Uganda requiring 7+ years experience. Browse management and leadership positions for experienced professionals.',
                'sort_order' => 4
            ],
            [
                'name' => 'Executive Level',
                'slug' => 'executive-jobs-uganda',
                'description' => 'Top management and executive roles requiring extensive experience',
                'meta_title' => 'Executive Jobs in Uganda - Director & C-Level Positions',
                'meta_description' => 'Browse executive level jobs in Uganda. Find director, C-level, and top management positions requiring extensive professional experience.',
                'sort_order' => 5
            ],
            [
                'name' => 'No Experience Required',
                'slug' => 'no-experience-jobs-uganda',
                'description' => 'Opportunities available for candidates with no prior work experience',
                'meta_title' => 'No Experience Jobs in Uganda - Beginner Opportunities',
                'meta_description' => 'Find jobs in Uganda requiring no prior experience. Browse opportunities for beginners, training positions, and learn-on-the-job roles.',
                'sort_order' => 6
            ],
        ];

        foreach ($experienceLevels as $level) {
            ExperienceLevel::create($level);
        }
    }
}