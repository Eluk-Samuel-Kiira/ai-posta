<?php
// database/seeders/JobCategorySeeder.php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            // Core Business & Professional Services
            [
                'name' => 'Accounting & Finance',
                'slug' => 'accounting-finance-jobs-in-uganda',
                'description' => 'Find accounting, finance, auditing, and financial management jobs in Uganda',
                'meta_title' => 'Accounting & Finance Jobs in Uganda - Financial Career Opportunities',
                'meta_description' => 'Browse accounting jobs in Uganda, finance careers, auditor positions, and financial management roles. Find your next opportunity in Uganda finance sector.',
                'icon' => 'fa-calculator',
                'sort_order' => 1
            ],
            [
                'name' => 'Administrative',
                'slug' => 'administrative-jobs-in-uganda',
                'description' => 'Office administration, executive assistant, and clerical positions in Uganda',
                'meta_title' => 'Administrative Jobs in Uganda - Office & Clerical Careers',
                'meta_description' => 'Find administrative assistant jobs in Uganda, office manager positions, receptionist roles, and clerical jobs. Office administration careers available in Uganda.',
                'icon' => 'fa-desktop',
                'sort_order' => 2
            ],
            [
                'name' => 'Banking & Financial Services',
                'slug' => 'banking-finance-jobs-in-uganda',
                'description' => 'Banking, investment, financial advisory, and related services jobs in Uganda',
                'meta_title' => 'Banking & Financial Services Jobs in Uganda - Finance Careers',
                'meta_description' => 'Discover banking jobs in Uganda, financial advisor roles, investment careers, and financial services positions in Ugandan banks and institutions.',
                'icon' => 'fa-university',
                'sort_order' => 3
            ],

            // Technology & IT
            [
                'name' => 'Computer & IT',
                'slug' => 'computer-it-jobs-in-uganda',
                'description' => 'Information technology, software development, and tech support jobs in Uganda',
                'meta_title' => 'IT & Computer Jobs in Uganda - Technology Careers',
                'meta_description' => 'Find IT jobs in Uganda, software development careers, tech support roles, and computer science positions in Ugandan technology sector.',
                'icon' => 'fa-laptop-code',
                'sort_order' => 4
            ],
            [
                'name' => 'Data, Monitoring & Research',
                'slug' => 'data-monitoring-research-jobs-in-uganda',
                'description' => 'Data analysis, research, monitoring & evaluation positions in Uganda',
                'meta_title' => 'Data & Research Jobs in Uganda - Analytics Careers',
                'meta_description' => 'Browse data analyst jobs in Uganda, research positions, monitoring roles, and data science careers. Find opportunities in analytics and research sector.',
                'icon' => 'fa-chart-bar',
                'sort_order' => 5
            ],

            // Engineering & Technical
            [
                'name' => 'Engineering',
                'slug' => 'engineering-jobs-in-uganda',
                'description' => 'Engineering jobs across various disciplines and industries in Uganda',
                'meta_title' => 'Engineering Jobs in Uganda - Technical Career Opportunities',
                'meta_description' => 'Discover engineering careers in Uganda, technical roles, and engineering positions across multiple disciplines and industries in Ugandan market.',
                'icon' => 'fa-cogs',
                'sort_order' => 6
            ],
            [
                'name' => 'Construction',
                'slug' => 'construction-jobs-in-uganda',
                'description' => 'Construction, building, and infrastructure development jobs in Uganda',
                'meta_title' => 'Construction Jobs in Uganda - Building & Infrastructure Careers',
                'meta_description' => 'Find construction jobs in Uganda, building careers, infrastructure development roles, and construction management positions in Ugandan construction sector.',
                'icon' => 'fa-hard-hat',
                'sort_order' => 7
            ],
            [
                'name' => 'Technician',
                'slug' => 'technician-jobs-in-uganda',
                'description' => 'Technical support, maintenance, and repair positions in Uganda',
                'meta_title' => 'Technician Jobs in Uganda - Technical Support Careers',
                'meta_description' => 'Browse technician jobs in Uganda, technical support roles, maintenance positions, and repair careers across various industries in Uganda.',
                'icon' => 'fa-tools',
                'sort_order' => 8
            ],

            // Healthcare & Medicine
            [
                'name' => 'Health & Medicine',
                'slug' => 'health-medicine-jobs-in-uganda',
                'description' => 'Healthcare, medical, nursing, and pharmaceutical jobs in Uganda',
                'meta_title' => 'Healthcare & Medical Jobs in Uganda - Health Sector Careers',
                'meta_description' => 'Discover healthcare jobs in Uganda, medical careers, nursing positions, and pharmaceutical roles in Ugandan health sector and hospitals.',
                'icon' => 'fa-heartbeat',
                'sort_order' => 9
            ],

            // Management & Leadership
            [
                'name' => 'Management',
                'slug' => 'management-jobs-in-uganda',
                'description' => 'Leadership, management, and supervisory positions in Uganda',
                'meta_title' => 'Management Jobs in Uganda - Leadership Career Opportunities',
                'meta_description' => 'Find management jobs in Uganda, leadership roles, supervisory positions, and executive careers across various industries in Ugandan market.',
                'icon' => 'fa-briefcase',
                'sort_order' => 10
            ],

            // Human Resources
            [
                'name' => 'Human Resources',
                'slug' => 'human-resource-jobs-in-uganda',
                'description' => 'HR, recruitment, talent acquisition, and people operations jobs in Uganda',
                'meta_title' => 'Human Resources Jobs in Uganda - HR & Recruitment Careers',
                'meta_description' => 'Browse HR jobs in Uganda, recruitment roles, talent acquisition positions, and human resources careers in Ugandan companies and organizations.',
                'icon' => 'fa-users',
                'sort_order' => 11
            ],

            // Sales & Marketing
            [
                'name' => 'Sales',
                'slug' => 'sales-jobs-in-uganda',
                'description' => 'Sales, business development, and account management positions in Uganda',
                'meta_title' => 'Sales Jobs in Uganda - Business Development Careers',
                'meta_description' => 'Find sales jobs in Uganda, business development roles, account management positions, and sales executive careers in Ugandan market.',
                'icon' => 'fa-chart-line',
                'sort_order' => 12
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing-jobs-in-uganda',
                'description' => 'Marketing, digital marketing, and brand management jobs in Uganda',
                'meta_title' => 'Marketing Jobs in Uganda - Digital Marketing Careers',
                'meta_description' => 'Discover marketing jobs in Uganda, digital marketing roles, brand management positions, and marketing coordinator careers in Ugandan companies.',
                'icon' => 'fa-bullhorn',
                'sort_order' => 13
            ],

            // Communications & PR
            [
                'name' => 'Communications & Public Relations',
                'slug' => 'communications-public-relations-jobs-in-uganda',
                'description' => 'PR, communications, media relations, and corporate affairs jobs in Uganda',
                'meta_title' => 'Communications & PR Jobs in Uganda - Public Relations Careers',
                'meta_description' => 'Browse communications jobs in Uganda, public relations roles, media relations positions, and corporate affairs careers in Ugandan organizations.',
                'icon' => 'fa-comments',
                'sort_order' => 14
            ],

            // Customer Service
            [
                'name' => 'Customer Service',
                'slug' => 'customer-service-jobs-in-uganda',
                'description' => 'Customer support, client service, and call center positions in Uganda',
                'meta_title' => 'Customer Service Jobs in Uganda - Support Career Opportunities',
                'meta_description' => 'Find customer service jobs in Uganda, support roles, call center positions, and client service careers in Ugandan companies and BPO sector.',
                'icon' => 'fa-headset',
                'sort_order' => 15
            ],

            // Legal
            [
                'name' => 'Legal',
                'slug' => 'legal-jobs-in-uganda',
                'description' => 'Legal, law, paralegal, and compliance positions in Uganda',
                'meta_title' => 'Legal Jobs in Uganda - Law & Compliance Careers',
                'meta_description' => 'Discover legal jobs in Uganda, law careers, paralegal roles, compliance positions, and legal advisory opportunities in Ugandan legal sector.',
                'icon' => 'fa-gavel',
                'sort_order' => 16
            ],

            // Logistics & Supply Chain
            [
                'name' => 'Logistics & Transportation',
                'slug' => 'logistics-transportation-jobs-in-uganda',
                'description' => 'Logistics, supply chain, transportation, and procurement jobs in Uganda',
                'meta_title' => 'Logistics & Transportation Jobs in Uganda - Supply Chain Careers',
                'meta_description' => 'Browse logistics jobs in Uganda, transportation roles, supply chain positions, and procurement careers in Ugandan logistics and supply chain sector.',
                'icon' => 'fa-truck',
                'sort_order' => 17
            ],

            // Education
            [
                'name' => 'Education & Teaching',
                'slug' => 'education-teaching-jobs-in-uganda',
                'description' => 'Teaching, academic, education, and training positions in Uganda',
                'meta_title' => 'Education & Teaching Jobs in Uganda - Academic Careers',
                'meta_description' => 'Find teaching jobs in Uganda, education careers, academic positions, and training roles in Ugandan educational institutions and schools.',
                'icon' => 'fa-graduation-cap',
                'sort_order' => 18
            ],

            // Creative & Design
            [
                'name' => 'Design',
                'slug' => 'design-jobs-in-uganda',
                'description' => 'Graphic design, UI/UX, creative, and visual design jobs in Uganda',
                'meta_title' => 'Design Jobs in Uganda - Creative & Graphic Design Careers',
                'meta_description' => 'Discover design jobs in Uganda, graphic design roles, UI/UX positions, and creative careers in Ugandan design industry and agencies.',
                'icon' => 'fa-palette',
                'sort_order' => 19
            ],

            // Hospitality
            [
                'name' => 'Hospitality & Chef',
                'slug' => 'hospitality-chef-jobs-in-uganda',
                'description' => 'Hospitality, chef, cook, hotel, and restaurant positions in Uganda',
                'meta_title' => 'Hospitality & Chef Jobs in Uganda - Hotel & Restaurant Careers',
                'meta_description' => 'Browse hospitality jobs in Uganda, chef positions, cook roles, hotel careers, and restaurant opportunities in Ugandan hospitality sector.',
                'icon' => 'fa-utensils',
                'sort_order' => 20
            ],

            // Retail
            [
                'name' => 'Retail',
                'slug' => 'retail-jobs-in-uganda',
                'description' => 'Retail, store operations, and merchandising positions in Uganda',
                'meta_title' => 'Retail Jobs in Uganda - Store & Merchandising Careers',
                'meta_description' => 'Find retail jobs in Uganda, store operations roles, merchandising positions, and retail management careers in Ugandan retail sector.',
                'icon' => 'fa-shopping-bag',
                'sort_order' => 21
            ],

            // Additional Categories
            [
                'name' => 'Consulting & Contractual',
                'slug' => 'consultant-contractual-jobs-in-uganda',
                'description' => 'Consulting, contractual, freelance, and project-based positions in Uganda',
                'meta_title' => 'Consulting & Contractual Jobs in Uganda - Project Based Careers',
                'meta_description' => 'Discover consulting jobs in Uganda, contractual roles, freelance positions, and project-based career opportunities in Ugandan market.',
                'icon' => 'fa-handshake',
                'sort_order' => 22
            ],
            [
                'name' => 'Environment & Agriculture',
                'slug' => 'environment-agriculture-jobs-in-uganda',
                'description' => 'Environmental, forestry, agriculture, and sustainability jobs in Uganda',
                'meta_title' => 'Environment & Agriculture Jobs in Uganda - Sustainability Careers',
                'meta_description' => 'Browse environment jobs in Uganda, agriculture roles, forestry positions, and sustainability careers in Ugandan environmental sector.',
                'icon' => 'fa-leaf',
                'sort_order' => 23
            ],
            [
                'name' => 'Government & Public Sector',
                'slug' => 'government-jobs-in-uganda',
                'description' => 'Government, public sector, and civil service positions in Uganda',
                'meta_title' => 'Government Jobs in Uganda - Public Sector Careers',
                'meta_description' => 'Find government jobs in Uganda, public sector roles, civil service positions, and administrative service careers in Ugandan government.',
                'icon' => 'fa-landmark',
                'sort_order' => 24
            ],
            [
                'name' => 'NGO & Non-Profit',
                'slug' => 'ngo-non-profit-jobs-in-uganda',
                'description' => 'Non-governmental organizations, non-profit, and development jobs in Uganda',
                'meta_title' => 'NGO & Non-Profit Jobs in Uganda - Development Careers',
                'meta_description' => 'Discover NGO jobs in Uganda, non-profit roles, development positions, and humanitarian career opportunities in Ugandan development sector.',
                'icon' => 'fa-hands-helping',
                'sort_order' => 25
            ],
            [
                'name' => 'Security & Protection',
                'slug' => 'security-jobs-in-uganda',
                'description' => 'Security, protection, safety, and homeland security positions in Uganda',
                'meta_title' => 'Security Jobs in Uganda - Protection & Safety Careers',
                'meta_description' => 'Browse security jobs in Uganda, protection roles, safety positions, and homeland security careers in Ugandan security sector.',
                'icon' => 'fa-shield-alt',
                'sort_order' => 26
            ],
            [
                'name' => 'Insurance',
                'slug' => 'insurance-jobs-in-uganda',
                'description' => 'Insurance, risk management, and actuarial positions in Uganda',
                'meta_title' => 'Insurance Jobs in Uganda - Risk Management Careers',
                'meta_description' => 'Find insurance jobs in Uganda, risk management roles, actuarial positions, and insurance advisory careers in Ugandan insurance sector.',
                'icon' => 'fa-file-contract',
                'sort_order' => 27
            ],

            // Entry Level & Special Programs
            [
                'name' => 'Internships & Trainee',
                'slug' => 'internships-trainee-jobs-in-uganda',
                'description' => 'Internships, trainee programs, and work experience positions in Uganda',
                'meta_title' => 'Internships & Trainee Jobs in Uganda - Entry Level Opportunities',
                'meta_description' => 'Discover internship opportunities in Uganda, trainee programs, entry-level positions, and work experience roles for students and graduates in Uganda.',
                'icon' => 'fa-user-graduate',
                'sort_order' => 28
            ],
            [
                'name' => 'Entry Level & Graduate',
                'slug' => 'entry-level-graduate-jobs-in-uganda',
                'description' => 'Entry-level, fresh graduate, and junior positions in Uganda',
                'meta_title' => 'Entry Level & Graduate Jobs in Uganda - Junior Career Opportunities',
                'meta_description' => 'Find entry-level jobs in Uganda, graduate positions, junior roles, and career starter opportunities for fresh graduates in Ugandan job market.',
                'icon' => 'fa-user-plus',
                'sort_order' => 29
            ],
            [
                'name' => 'Part-Time & Freelance',
                'slug' => 'part-time-freelance-jobs-in-uganda',
                'description' => 'Part-time, freelance, flexible, and remote work positions in Uganda',
                'meta_title' => 'Part-Time & Freelance Jobs in Uganda - Flexible Work Opportunities',
                'meta_description' => 'Browse part-time jobs in Uganda, freelance roles, flexible work positions, and remote career opportunities in Ugandan flexible work market.',
                'icon' => 'fa-clock',
                'sort_order' => 30
            ],

            // Business & Procurement
            [
                'name' => 'Tenders & Procurement',
                'slug' => 'tenders-procurement-jobs-in-uganda',
                'description' => 'Tenders, procurement, sourcing, and supply chain management in Uganda',
                'meta_title' => 'Tenders & Procurement Jobs in Uganda - Sourcing Careers',
                'meta_description' => 'Discover tender opportunities in Uganda, procurement jobs, sourcing roles, and supply chain management positions in Ugandan procurement sector.',
                'icon' => 'fa-file-signature',
                'sort_order' => 31
            ],
            [
                'name' => 'Multiple Positions',
                'slug' => 'multiple-positions-jobs-in-uganda',
                'description' => 'Job advertisements featuring multiple positions and roles in Uganda',
                'meta_title' => 'Multiple Position Jobs in Uganda - Various Career Opportunities',
                'meta_description' => 'Find job advertisements in Uganda featuring multiple positions, various roles, and diverse career opportunities in single listings across Uganda.',
                'icon' => 'fa-layer-group',
                'sort_order' => 32
            ],
        ];

        foreach ($categories as $category) {
            JobCategory::create($category);
        }

        // Create additional categories using factory
        JobCategory::factory()->count(5)->create();
    }
}