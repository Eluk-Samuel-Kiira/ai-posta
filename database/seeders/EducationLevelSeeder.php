<?php
// database/seeders/EducationLevelSeeder.php

namespace Database\Seeders;

use App\Models\EducationLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EducationLevelSeeder extends Seeder
{
    public function run()
    {
        $educationLevels = [
            [
                'name' => 'High School',
                'slug' => 'high-school-jobs-uganda',
                'meta_title' => 'High School Jobs in Uganda - O-Level & A-Level Opportunities',
                'meta_description' => 'Find jobs in Uganda requiring high school education (O-Level, A-Level). Browse opportunities for secondary school graduates.',
                'sort_order' => 1
            ],
            [
                'name' => 'Certificate',
                'slug' => 'certificate-jobs-uganda',
                'meta_title' => 'Certificate Jobs in Uganda - Vocational Opportunities',
                'meta_description' => 'Browse jobs in Uganda requiring certificate qualifications. Find vocational and technical positions across various industries.',
                'sort_order' => 2
            ],
            [
                'name' => 'Diploma',
                'slug' => 'diploma-jobs-uganda',
                'meta_title' => 'Diploma Jobs in Uganda - Technical Career Opportunities',
                'meta_description' => 'Find jobs in Uganda requiring diploma qualifications. Discover technical and specialized career opportunities for diploma holders.',
                'sort_order' => 3
            ],
            [
                'name' => 'Bachelor\'s Degree',
                'slug' => 'bachelors-degree-jobs-uganda',
                'meta_title' => 'Bachelor Degree Jobs in Uganda - Graduate Opportunities',
                'meta_description' => 'Browse jobs in Uganda requiring bachelor\'s degrees. Find graduate opportunities and professional positions for degree holders.',
                'sort_order' => 4
            ],
            [
                'name' => 'Master\'s Degree',
                'slug' => 'masters-degree-jobs-uganda',
                'meta_title' => 'Master Degree Jobs in Uganda - Postgraduate Opportunities',
                'meta_description' => 'Discover jobs in Uganda requiring master\'s degrees. Find postgraduate opportunities and advanced professional positions.',
                'sort_order' => 5
            ],
            [
                'name' => 'PhD',
                'slug' => 'phd-jobs-uganda',
                'meta_title' => 'PhD Jobs in Uganda - Doctoral Level Opportunities',
                'meta_description' => 'Find jobs in Uganda requiring PhD qualifications. Browse research, academic, and high-level professional opportunities.',
                'sort_order' => 6
            ],
            [
                'name' => 'No Formal Education',
                'slug' => 'no-education-jobs-uganda',
                'meta_title' => 'No Education Jobs in Uganda - Skills-based Opportunities',
                'meta_description' => 'Browse jobs in Uganda requiring no formal education. Find opportunities based on skills, experience, and on-the-job training.',
                'sort_order' => 7
            ],
        ];

        foreach ($educationLevels as $level) {
            EducationLevel::create($level);
        }
    }
}