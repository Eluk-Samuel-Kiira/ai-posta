<?php
// database/seeders/LocationSeeder.php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            // Central Region - High search volume areas
            [
                'name' => 'Kampala', 
                'slug' => 'jobs-in-kampala',
                'type' => 'city', 
                'parent_id' => null,
                'meta_title' => 'Jobs in Kampala Uganda - Latest Career Opportunities & Vacancies',
                'meta_description' => 'Find latest jobs in Kampala Uganda. Browse 1000+ vacancies in Kampala city. Full-time, part-time, contract jobs updated daily.',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Wakiso', 
                'slug' => 'jobs-in-wakiso',
                'type' => 'district', 
                'parent_id' => null,
                'meta_title' => 'Jobs in Wakiso Uganda - Career Opportunities Near Kampala',
                'meta_description' => 'Discover jobs in Wakiso district Uganda. Find employment opportunities in Wakiso near Kampala. Updated daily.',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Entebbe', 
                'slug' => 'jobs-in-entebbe',
                'type' => 'city', 
                'parent_id' => null,
                'meta_title' => 'Jobs in Entebbe Uganda - Airport City Career Opportunities',
                'meta_description' => 'Browse jobs in Entebbe Uganda. Find career opportunities in Entebbe international airport area and surrounding businesses.',
                'is_active' => true,
                'sort_order' => 3
            ],
            
            // Eastern Region
            [
                'name' => 'Jinja', 
                'slug' => 'jobs-in-jinja',
                'type' => 'city', 
                'parent_id' => null,
                'meta_title' => 'Jobs in Jinja Uganda - Source of Nile Career Opportunities',
                'meta_description' => 'Find jobs in Jinja Uganda. Discover employment opportunities in Jinja city, industrial area and Source of Nile region.',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Mbale', 
                'slug' => 'jobs-in-mbale',
                'type' => 'city', 
                'parent_id' => null,
                'meta_title' => 'Jobs in Mbale Uganda - Eastern Region Career Vacancies',
                'meta_description' => 'Browse jobs in Mbale Uganda. Find career opportunities in Mbale city and Eastern Uganda region. Updated daily.',
                'is_active' => true,
                'sort_order' => 5
            ],
            
            // Northern Region
            [
                'name' => 'Gulu', 
                'slug' => 'jobs-in-gulu',
                'type' => 'city', 
                'parent_id' => null,
                'meta_title' => 'Jobs in Gulu Uganda - Northern Region Career Opportunities',
                'meta_description' => 'Discover jobs in Gulu Uganda. Find employment vacancies in Gulu city and Northern Uganda region. NGOs, government, private sector jobs.',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Lira', 
                'slug' => 'jobs-in-lira',
                'type' => 'city', 
                'parent_id' => null,
                'meta_title' => 'Jobs in Lira Uganda - Lango Region Career Vacancies',
                'meta_description' => 'Find jobs in Lira Uganda. Browse career opportunities in Lira city and Lango sub-region. Updated employment listings.',
                'is_active' => true,
                'sort_order' => 7
            ],
            
            // Western Region
            [
                'name' => 'Mbarara', 
                'slug' => 'jobs-in-mbarara',
                'type' => 'city', 
                'parent_id' => null,
                'meta_title' => 'Jobs in Mbarara Uganda - Western Region Career Opportunities',
                'meta_description' => 'Browse jobs in Mbarara Uganda. Find employment opportunities in Mbarara city and Western Uganda. Updated daily vacancies.',
                'is_active' => true,
                'sort_order' => 8
            ],
            [
                'name' => 'Fort Portal', 
                'slug' => 'jobs-in-fort-portal',
                'type' => 'city', 
                'parent_id' => null,
                'meta_title' => 'Jobs in Fort Portal Uganda - Tourism City Career Vacancies',
                'meta_description' => 'Discover jobs in Fort Portal Uganda. Find career opportunities in tourism, hospitality and other sectors in Fort Portal city.',
                'is_active' => true,
                'sort_order' => 9
            ],
            
            // Additional high-search locations
            [
                'name' => 'Remote Uganda', 
                'slug' => 'remote-jobs-uganda',
                'type' => 'virtual', 
                'parent_id' => null,
                'meta_title' => 'Remote Jobs in Uganda - Work From Home Opportunities',
                'meta_description' => 'Find remote jobs in Uganda. Browse work from home opportunities, online jobs, and virtual positions available for Ugandans.',
                'is_active' => true,
                'sort_order' => 10
            ],
            [
                'name' => 'Nationwide Uganda', 
                'slug' => 'jobs-uganda-nationwide',
                'type' => 'national', 
                'parent_id' => null,
                'meta_title' => 'Nationwide Jobs in Uganda - Countrywide Career Opportunities',
                'meta_description' => 'Browse nationwide jobs in Uganda. Find employment opportunities available across all regions of Uganda. Updated daily.',
                'is_active' => true,
                'sort_order' => 11
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}