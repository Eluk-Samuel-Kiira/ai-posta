<?php
// database/seeders/OccupationalCategorySeeder.php

namespace Database\Seeders;

use App\Models\OccupationalCategory;
use Illuminate\Database\Seeder;

class OccupationalCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            // Business & Management
            ['name' => 'Management', 'industry_sector' => 'Business', 'sort_order' => 1],
            ['name' => 'Executive Director', 'industry_sector' => 'Business', 'sort_order' => 2],
            ['name' => 'Team Leader', 'industry_sector' => 'Business', 'sort_order' => 3],
            ['name' => 'Chain Manager', 'industry_sector' => 'Business', 'sort_order' => 4],
            ['name' => 'Management Officer', 'industry_sector' => 'Business', 'sort_order' => 5],
            ['name' => 'Business Operations', 'industry_sector' => 'Business', 'sort_order' => 6],
            
            // Finance & Accounting
            ['name' => 'Accounting & Finance', 'industry_sector' => 'Finance', 'sort_order' => 10],
            ['name' => 'Finance, Insurance & Real Estate', 'industry_sector' => 'Finance', 'sort_order' => 11],
            ['name' => 'Commercial Banks', 'industry_sector' => 'Finance', 'sort_order' => 12],
            ['name' => 'Savings & Loans', 'industry_sector' => 'Finance', 'sort_order' => 13],
            
            // Science & Engineering
            ['name' => 'Science & Engineering', 'industry_sector' => 'Technology', 'sort_order' => 20],
            ['name' => 'Aerospace', 'industry_sector' => 'Technology', 'sort_order' => 21],
            ['name' => 'Architectural Services', 'industry_sector' => 'Technology', 'sort_order' => 22],
            ['name' => 'Agronomist', 'industry_sector' => 'Science', 'sort_order' => 23],
            
            // Sales & Marketing
            ['name' => 'Sales & Retail', 'industry_sector' => 'Sales', 'sort_order' => 30],
            ['name' => 'Advertising & Marketing', 'industry_sector' => 'Marketing', 'sort_order' => 31],
            ['name' => 'Advertising & Public Relations', 'industry_sector' => 'Marketing', 'sort_order' => 32],
            ['name' => 'Real Estate', 'industry_sector' => 'Sales', 'sort_order' => 33],
            ['name' => 'Auto Dealers', 'industry_sector' => 'Sales', 'sort_order' => 34],
            
            // Administration & Office
            ['name' => 'Admin & Office', 'industry_sector' => 'Business', 'sort_order' => 40],
            ['name' => 'Human Resources', 'industry_sector' => 'Business', 'sort_order' => 41],
            ['name' => 'Recruitment', 'industry_sector' => 'Business', 'sort_order' => 42],
            
            // Technology
            ['name' => 'Computer & IT', 'industry_sector' => 'Technology', 'sort_order' => 50],
            ['name' => 'Telecom Services & Equipment', 'industry_sector' => 'Technology', 'sort_order' => 51],
            ['name' => 'Communications & Electronics', 'industry_sector' => 'Technology', 'sort_order' => 52],
            ['name' => 'Defense Contractors', 'industry_sector' => 'Technology', 'sort_order' => 53],
            
            // Healthcare
            ['name' => 'Healthcare', 'industry_sector' => 'Healthcare', 'sort_order' => 60],
            ['name' => 'Doctors & Other Health Professionals', 'industry_sector' => 'Healthcare', 'sort_order' => 61],
            ['name' => 'Health Professionals', 'industry_sector' => 'Healthcare', 'sort_order' => 62],
            ['name' => 'Drug Manufacturers', 'industry_sector' => 'Healthcare', 'sort_order' => 63],
            ['name' => 'Nutritional & Dietary Supplements', 'industry_sector' => 'Healthcare', 'sort_order' => 64],
            
            // Education
            ['name' => 'Education', 'industry_sector' => 'Education', 'sort_order' => 70],
            ['name' => 'Teacher', 'industry_sector' => 'Education', 'sort_order' => 71],
            ['name' => 'Childhood Teacher', 'industry_sector' => 'Education', 'sort_order' => 72],
            ['name' => 'Teachers & Education', 'industry_sector' => 'Education', 'sort_order' => 73],
            ['name' => 'Colleges, Universities & Schools', 'industry_sector' => 'Education', 'sort_order' => 74],
            
            // Media & Communications
            ['name' => 'Media, Communications & Writing', 'industry_sector' => 'Creative', 'sort_order' => 80],
            ['name' => 'Publishing & Printing', 'industry_sector' => 'Creative', 'sort_order' => 81],
            ['name' => 'Newspaper, Magazine & Book Publishing', 'industry_sector' => 'Creative', 'sort_order' => 82],
            ['name' => 'Books, Magazines & Newspapers', 'industry_sector' => 'Creative', 'sort_order' => 83],
            ['name' => 'Broadcasters, Radio & TV', 'industry_sector' => 'Creative', 'sort_order' => 84],
            ['name' => 'Commercial TV & Radio Stations', 'industry_sector' => 'Creative', 'sort_order' => 85],
            
            // Services
            ['name' => 'Protective Services', 'industry_sector' => 'Services', 'sort_order' => 90],
            ['name' => 'Customer Service', 'industry_sector' => 'Services', 'sort_order' => 91],
            ['name' => 'Social Services & Nonprofit', 'industry_sector' => 'Services', 'sort_order' => 92],
            ['name' => 'Non-profits, Foundations & Philanthropists', 'industry_sector' => 'Services', 'sort_order' => 93],
            ['name' => 'Human Rights', 'industry_sector' => 'Services', 'sort_order' => 94],
            ['name' => 'Women\'s Issues', 'industry_sector' => 'Services', 'sort_order' => 95],
            
            // Hospitality
            ['name' => 'Restaurant & Hospitality', 'industry_sector' => 'Hospitality', 'sort_order' => 100],
            ['name' => 'Restaurants & Drinking', 'industry_sector' => 'Hospitality', 'sort_order' => 101],
            
            // Creative & Design
            ['name' => 'Art, Fashion & Design', 'industry_sector' => 'Creative', 'sort_order' => 110],
            ['name' => 'Entertainment & Travel', 'industry_sector' => 'Creative', 'sort_order' => 111],
            ['name' => 'Recreation & Live Entertainment', 'industry_sector' => 'Creative', 'sort_order' => 112],
            ['name' => 'Sports, Fitness & Recreation', 'industry_sector' => 'Creative', 'sort_order' => 113],
            
            // Legal
            ['name' => 'Legal', 'industry_sector' => 'Professional', 'sort_order' => 120],
            ['name' => 'Lawyers & Lobbyists', 'industry_sector' => 'Professional', 'sort_order' => 121],
            
            // Technical & Maintenance
            ['name' => 'Installation, Maintenance & Repair', 'industry_sector' => 'Industrial', 'sort_order' => 130],
            ['name' => 'Cleaning & Facilities', 'industry_sector' => 'Industrial', 'sort_order' => 131],
            ['name' => 'Garbage Collection & Waste Management', 'industry_sector' => 'Industrial', 'sort_order' => 132],
            ['name' => 'Trash Collection & Waste Management', 'industry_sector' => 'Industrial', 'sort_order' => 133],
            
            // Energy & Environment
            ['name' => 'Energy & Mining', 'industry_sector' => 'Industrial', 'sort_order' => 140],
            ['name' => 'Energy & Natural Resources', 'industry_sector' => 'Industrial', 'sort_order' => 141],
            ['name' => 'Alternative Energy Production & Services', 'industry_sector' => 'Industrial', 'sort_order' => 142],
            ['name' => 'Gas & Oil', 'industry_sector' => 'Industrial', 'sort_order' => 143],
            ['name' => 'Environment', 'industry_sector' => 'Industrial', 'sort_order' => 144],
            
            // Agriculture & Farming
            ['name' => 'Farming & Outdoors', 'industry_sector' => 'Agriculture', 'sort_order' => 150],
            ['name' => 'Agribusiness', 'industry_sector' => 'Agriculture', 'sort_order' => 151],
            ['name' => 'Agricultural Services & Products', 'industry_sector' => 'Agriculture', 'sort_order' => 152],
            ['name' => 'Food & Beverage', 'industry_sector' => 'Agriculture', 'sort_order' => 153],
            ['name' => 'Food Processing & Sales', 'industry_sector' => 'Agriculture', 'sort_order' => 154],
            ['name' => 'Food Products Manufacturing', 'industry_sector' => 'Agriculture', 'sort_order' => 155],
            ['name' => 'Forestry & Forest Products', 'industry_sector' => 'Agriculture', 'sort_order' => 156],
            
            // Construction & Manufacturing
            ['name' => 'Manufacturing & Warehouse', 'industry_sector' => 'Industrial', 'sort_order' => 160],
            ['name' => 'Construction', 'industry_sector' => 'Industrial', 'sort_order' => 161],
            ['name' => 'Builders & General Contractors', 'industry_sector' => 'Industrial', 'sort_order' => 162],
            ['name' => 'Builders & Residential', 'industry_sector' => 'Industrial', 'sort_order' => 163],
            ['name' => 'Construction Services', 'industry_sector' => 'Industrial', 'sort_order' => 164],
            
            // Transportation
            ['name' => 'Transportation & Logistics', 'industry_sector' => 'Logistics', 'sort_order' => 170],
            
            // Personal Services
            ['name' => 'Personal Care & Services', 'industry_sector' => 'Services', 'sort_order' => 180],
            ['name' => 'Animal Care', 'industry_sector' => 'Services', 'sort_order' => 181],
            
            // Government & Associations
            ['name' => 'Civil & Government', 'industry_sector' => 'Government', 'sort_order' => 190],
            ['name' => 'Business Associations', 'industry_sector' => 'Government', 'sort_order' => 191],
        ];

        foreach ($categories as $category) {
            OccupationalCategory::create([
                'name' => $category['name'],
                'slug' => \Illuminate\Support\Str::slug($category['name']),
                'description' => $this->generateDescription($category['name']),
                'industry_sector' => $category['industry_sector'],
                'sort_order' => $category['sort_order'],
                'is_active' => true,
            ]);
        }

        // Create some additional random categories using factory
        OccupationalCategory::factory()->count(10)->create();
    }

    private function generateDescription($categoryName)
    {
        $descriptions = [
            'Jobs related to ' . $categoryName . ' and associated fields',
            'Career opportunities in ' . $categoryName . ' sector',
            'Professional roles in ' . $categoryName . ' industry',
            $categoryName . ' positions and employment opportunities'
        ];
        
        return $descriptions[array_rand($descriptions)];
    }
}