<?php
// database/seeders/IndustrySeeder.php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class IndustrySeeder extends Seeder
{
    public function run()
    {
        $industries = [
            // Finance & Business
            [
                'name' => 'Finance',
                'slug' => 'finance-industry',
                'description' => 'Financial services, banking, investment, and financial management industry in Uganda',
                'meta_title' => 'Finance Industry Jobs in Uganda - Banking & Financial Careers',
                'meta_description' => 'Find finance industry jobs in Uganda. Explore banking careers, investment roles, financial services positions in Ugandan financial sector.',
                'icon' => 'fa-university',
                'sort_order' => 1
            ],
            [
                'name' => 'Banking',
                'slug' => 'banking-industry',
                'description' => 'Commercial banking, microfinance, and financial institutions in Uganda',
                'meta_title' => 'Banking Industry Jobs in Uganda - Bank Careers & Opportunities',
                'meta_description' => 'Discover banking industry jobs in Uganda. Find careers in commercial banks, microfinance institutions, and financial services in Uganda.',
                'icon' => 'fa-credit-card',
                'sort_order' => 2
            ],
            [
                'name' => 'Financial Services',
                'slug' => 'financial-services-industry',
                'description' => 'Financial advisory, insurance, investment services in Uganda',
                'meta_title' => 'Financial Services Jobs in Uganda - Insurance & Investment Careers',
                'meta_description' => 'Browse financial services industry jobs in Uganda. Find insurance careers, investment advisory roles, and financial planning positions.',
                'icon' => 'fa-chart-line',
                'sort_order' => 3
            ],
            [
                'name' => 'Insurance',
                'slug' => 'insurance-industry',
                'description' => 'Insurance companies, brokers, and risk management services in Uganda',
                'meta_title' => 'Insurance Industry Jobs in Uganda - Risk Management Careers',
                'meta_description' => 'Find insurance industry jobs in Uganda. Explore careers in insurance companies, brokerage firms, and risk management services.',
                'icon' => 'fa-shield-alt',
                'sort_order' => 4
            ],
            [
                'name' => 'Investment',
                'slug' => 'investment-industry',
                'description' => 'Investment firms, asset management, and venture capital in Uganda',
                'meta_title' => 'Investment Industry Jobs in Uganda - Asset Management Careers',
                'meta_description' => 'Discover investment industry jobs in Uganda. Find careers in asset management, venture capital, and investment advisory firms.',
                'icon' => 'fa-hand-holding-usd',
                'sort_order' => 5
            ],
            [
                'name' => 'Accounting',
                'slug' => 'accounting-industry',
                'description' => 'Accounting firms, audit services, and financial consulting in Uganda',
                'meta_title' => 'Accounting Industry Jobs in Uganda - Audit & Consulting Careers',
                'meta_description' => 'Browse accounting industry jobs in Uganda. Find careers in accounting firms, audit services, and financial consulting practices.',
                'icon' => 'fa-calculator',
                'sort_order' => 6
            ],

            // Technology & IT
            [
                'name' => 'Information Technology',
                'slug' => 'information-technology-industry',
                'description' => 'IT services, software development, and technology solutions in Uganda',
                'meta_title' => 'IT Industry Jobs in Uganda - Technology & Software Careers',
                'meta_description' => 'Find information technology jobs in Uganda. Explore careers in software development, IT services, and technology solutions companies.',
                'icon' => 'fa-laptop-code',
                'sort_order' => 7
            ],
            [
                'name' => 'Telecommunications',
                'slug' => 'telecommunications-industry',
                'description' => 'Telecom companies, mobile networks, and communication services in Uganda',
                'meta_title' => 'Telecommunications Jobs in Uganda - Telecom Industry Careers',
                'meta_description' => 'Discover telecommunications industry jobs in Uganda. Find careers in mobile networks, telecom companies, and communication services.',
                'icon' => 'fa-broadcast-tower',
                'sort_order' => 8
            ],
            [
                'name' => 'Internet Services',
                'slug' => 'internet-services-industry',
                'description' => 'Internet service providers, web services, and digital platforms in Uganda',
                'meta_title' => 'Internet Industry Jobs in Uganda - Web Services Careers',
                'meta_description' => 'Browse internet industry jobs in Uganda. Find careers in ISPs, web development companies, and digital platform services.',
                'icon' => 'fa-wifi',
                'sort_order' => 9
            ],
            [
                'name' => 'Software Development',
                'slug' => 'software-development-industry',
                'description' => 'Software development companies and tech startups in Uganda',
                'meta_title' => 'Software Industry Jobs in Uganda - Tech Startup Careers',
                'meta_description' => 'Find computer software industry jobs in Uganda. Explore careers in software development companies and technology startups.',
                'icon' => 'fa-code',
                'sort_order' => 10
            ],

            // Healthcare
            [
                'name' => 'Healthcare',
                'slug' => 'healthcare-industry',
                'description' => 'Hospitals, clinics, healthcare services, and medical facilities in Uganda',
                'meta_title' => 'Healthcare Industry Jobs in Uganda - Medical & Hospital Careers',
                'meta_description' => 'Discover healthcare industry jobs in Uganda. Find careers in hospitals, clinics, medical facilities, and healthcare services.',
                'icon' => 'fa-hospital',
                'sort_order' => 11
            ],
            [
                'name' => 'Pharmaceutical',
                'slug' => 'pharmaceutical-industry',
                'description' => 'Pharmaceutical companies, drug manufacturing, and medical supplies in Uganda',
                'meta_title' => 'Pharmaceutical Jobs in Uganda - Drug Manufacturing Careers',
                'meta_description' => 'Browse pharmaceutical industry jobs in Uganda. Find careers in drug manufacturing, medical supplies, and pharmaceutical companies.',
                'icon' => 'fa-pills',
                'sort_order' => 12
            ],

            // Professional Services
            [
                'name' => 'Consulting',
                'slug' => 'consulting-industry',
                'description' => 'Management consulting, business advisory, and professional services in Uganda',
                'meta_title' => 'Consulting Industry Jobs in Uganda - Business Advisory Careers',
                'meta_description' => 'Find consulting industry jobs in Uganda. Explore careers in management consulting, business advisory, and professional services firms.',
                'icon' => 'fa-briefcase',
                'sort_order' => 13
            ],
            [
                'name' => 'Professional Services',
                'slug' => 'professional-services-industry',
                'description' => 'Legal, accounting, consulting and other professional services in Uganda',
                'meta_title' => 'Professional Services Jobs in Uganda - Legal & Consulting Careers',
                'meta_description' => 'Discover professional services industry jobs in Uganda. Find careers in legal firms, consulting companies, and professional advisory services.',
                'icon' => 'fa-user-tie',
                'sort_order' => 14
            ],
            [
                'name' => 'Engineering Services',
                'slug' => 'engineering-services-industry',
                'description' => 'Engineering consulting, technical services, and infrastructure design in Uganda',
                'meta_title' => 'Engineering Services Jobs in Uganda - Technical Consulting Careers',
                'meta_description' => 'Browse engineering services industry jobs in Uganda. Find careers in engineering consulting, technical services, and infrastructure design.',
                'icon' => 'fa-cogs',
                'sort_order' => 15
            ],

            // Construction & Manufacturing
            [
                'name' => 'Construction',
                'slug' => 'construction-industry',
                'description' => 'Construction companies, building contractors, and infrastructure development in Uganda',
                'meta_title' => 'Construction Industry Jobs in Uganda - Building & Infrastructure Careers',
                'meta_description' => 'Find construction industry jobs in Uganda. Explore careers in construction companies, building contractors, and infrastructure development.',
                'icon' => 'fa-hard-hat',
                'sort_order' => 16
            ],
            [
                'name' => 'Manufacturing',
                'slug' => 'manufacturing-industry',
                'description' => 'Manufacturing companies, production facilities, and industrial plants in Uganda',
                'meta_title' => 'Manufacturing Jobs in Uganda - Production & Industrial Careers',
                'meta_description' => 'Discover manufacturing industry jobs in Uganda. Find careers in production facilities, manufacturing companies, and industrial plants.',
                'icon' => 'fa-industry',
                'sort_order' => 17
            ],
            [
                'name' => 'Production',
                'slug' => 'production-industry',
                'description' => 'Goods production, assembly lines, and manufacturing operations in Uganda',
                'meta_title' => 'Production Industry Jobs in Uganda - Manufacturing & Operations Careers',
                'meta_description' => 'Browse production industry jobs in Uganda. Find careers in goods manufacturing, assembly operations, and production facilities.',
                'icon' => 'fa-tools',
                'sort_order' => 18
            ],

            // Agriculture & Natural Resources
            [
                'name' => 'Agriculture',
                'slug' => 'agriculture-industry',
                'description' => 'Farming, agribusiness, and agricultural services in Uganda',
                'meta_title' => 'Agriculture Industry Jobs in Uganda - Farming & Agribusiness Careers',
                'meta_description' => 'Find agriculture industry jobs in Uganda. Explore careers in farming, agribusiness, agricultural services, and food production.',
                'icon' => 'fa-tractor',
                'sort_order' => 19
            ],
            [
                'name' => 'Mining',
                'slug' => 'mining-industry',
                'description' => 'Mining companies, mineral extraction, and natural resources in Uganda',
                'meta_title' => 'Mining Industry Jobs in Uganda - Mineral Extraction Careers',
                'meta_description' => 'Discover mining industry jobs in Uganda. Find careers in mining companies, mineral extraction, and natural resources sector.',
                'icon' => 'fa-mountain',
                'sort_order' => 20
            ],

            // Retail & Trade
            [
                'name' => 'Retail',
                'slug' => 'retail-industry',
                'description' => 'Retail stores, supermarkets, and consumer goods sales in Uganda',
                'meta_title' => 'Retail Industry Jobs in Uganda - Sales & Store Management Careers',
                'meta_description' => 'Browse retail industry jobs in Uganda. Find careers in retail stores, supermarkets, and consumer goods sales companies.',
                'icon' => 'fa-shopping-cart',
                'sort_order' => 21
            ],
            [
                'name' => 'Trade',
                'slug' => 'trade-industry',
                'description' => 'Import/export, wholesale trade, and commercial trading in Uganda',
                'meta_title' => 'Trade Industry Jobs in Uganda - Import/Export Careers',
                'meta_description' => 'Find trade industry jobs in Uganda. Explore careers in import/export companies, wholesale trade, and commercial trading businesses.',
                'icon' => 'fa-exchange-alt',
                'sort_order' => 22
            ],

            // Media & Creative
            [
                'name' => 'Media',
                'slug' => 'media-industry',
                'description' => 'Media companies, broadcasting, journalism, and entertainment in Uganda',
                'meta_title' => 'Media Industry Jobs in Uganda - Broadcasting & Journalism Careers',
                'meta_description' => 'Discover media industry jobs in Uganda. Find careers in broadcasting, journalism, entertainment, and media production companies.',
                'icon' => 'fa-tv',
                'sort_order' => 23
            ],
            [
                'name' => 'Advertising',
                'slug' => 'advertising-industry',
                'description' => 'Advertising agencies, marketing services, and creative agencies in Uganda',
                'meta_title' => 'Advertising Industry Jobs in Uganda - Marketing & Creative Careers',
                'meta_description' => 'Browse advertising industry jobs in Uganda. Find careers in advertising agencies, marketing services, and creative firms.',
                'icon' => 'fa-bullhorn',
                'sort_order' => 24
            ],
            [
                'name' => 'Design',
                'slug' => 'design-industry',
                'description' => 'Design agencies, creative services, and visual arts in Uganda',
                'meta_title' => 'Design Industry Jobs in Uganda - Creative & Visual Arts Careers',
                'meta_description' => 'Find design industry jobs in Uganda. Explore careers in design agencies, creative services, and visual arts companies.',
                'icon' => 'fa-palette',
                'sort_order' => 25
            ],
            [
                'name' => 'Publishing',
                'slug' => 'publishing-industry',
                'description' => 'Publishing houses, printing services, and content creation in Uganda',
                'meta_title' => 'Publishing Jobs in Uganda - Printing & Content Creation Careers',
                'meta_description' => 'Discover publishing industry jobs in Uganda. Find careers in publishing houses, printing services, and content creation companies.',
                'icon' => 'fa-newspaper',
                'sort_order' => 26
            ],

            // Education & Non-profit
            [
                'name' => 'Education',
                'slug' => 'education-industry',
                'description' => 'Schools, universities, training institutions, and educational services in Uganda',
                'meta_title' => 'Education Industry Jobs in Uganda - Teaching & Academic Careers',
                'meta_description' => 'Browse education industry jobs in Uganda. Find careers in schools, universities, training institutions, and educational services.',
                'icon' => 'fa-graduation-cap',
                'sort_order' => 27
            ],
            [
                'name' => 'Nonprofit and NGO',
                'slug' => 'nonprofit-ngo-industry',
                'description' => 'Non-governmental organizations, charities, and development agencies in Uganda',
                'meta_title' => 'NGO Jobs in Uganda - Nonprofit & Development Careers',
                'meta_description' => 'Find nonprofit and NGO jobs in Uganda. Explore careers in development agencies, charitable organizations, and humanitarian services.',
                'icon' => 'fa-hands-helping',
                'sort_order' => 28
            ],

            // Government & Utilities
            [
                'name' => 'Public Administration',
                'slug' => 'public-administration-industry',
                'description' => 'Government agencies, public sector, and civil service in Uganda',
                'meta_title' => 'Government Jobs in Uganda - Public Sector & Civil Service Careers',
                'meta_description' => 'Discover government and public administration jobs in Uganda. Find careers in government agencies, public sector, and civil service.',
                'icon' => 'fa-landmark',
                'sort_order' => 29
            ],
            [
                'name' => 'Utilities',
                'slug' => 'utilities-industry',
                'description' => 'Water, electricity, and public utility services in Uganda',
                'meta_title' => 'Utilities Industry Jobs in Uganda - Water & Electricity Careers',
                'meta_description' => 'Browse utilities industry jobs in Uganda. Find careers in water services, electricity companies, and public utility providers.',
                'icon' => 'fa-bolt',
                'sort_order' => 30
            ],

            // Logistics & Transportation
            [
                'name' => 'Logistics',
                'slug' => 'logistics-industry',
                'description' => 'Logistics companies, supply chain, and distribution services in Uganda',
                'meta_title' => 'Logistics Industry Jobs in Uganda - Supply Chain & Distribution Careers',
                'meta_description' => 'Find logistics industry jobs in Uganda. Explore careers in logistics companies, supply chain management, and distribution services.',
                'icon' => 'fa-shipping-fast',
                'sort_order' => 31
            ],
            [
                'name' => 'Transportation',
                'slug' => 'transportation-industry',
                'description' => 'Transport companies, freight services, and passenger transport in Uganda',
                'meta_title' => 'Transportation Jobs in Uganda - Freight & Passenger Transport Careers',
                'meta_description' => 'Discover transportation industry jobs in Uganda. Find careers in transport companies, freight services, and passenger transport.',
                'icon' => 'fa-truck',
                'sort_order' => 32
            ],

            // Additional Important Industries
            [
                'name' => 'Hospitality and Tourism',
                'slug' => 'hospitality-tourism-industry',
                'description' => 'Hotels, tourism services, travel agencies, and hospitality in Uganda',
                'meta_title' => 'Hospitality & Tourism Jobs in Uganda - Hotel & Travel Careers',
                'meta_description' => 'Browse hospitality and tourism industry jobs in Uganda. Find careers in hotels, tourism services, travel agencies, and hospitality sector.',
                'icon' => 'fa-hotel',
                'sort_order' => 33
            ],
            [
                'name' => 'Petroleum',
                'slug' => 'petroleum-industry',
                'description' => 'Oil and gas companies, petroleum services, and energy sector in Uganda',
                'meta_title' => 'Petroleum Industry Jobs in Uganda - Oil & Gas Careers',
                'meta_description' => 'Find petroleum industry jobs in Uganda. Explore careers in oil and gas companies, petroleum services, and energy sector.',
                'icon' => 'fa-gas-pump',
                'sort_order' => 34
            ],
            [
                'name' => 'Chemical',
                'slug' => 'chemical-industry',
                'description' => 'Chemical manufacturing, industrial chemicals, and chemical products in Uganda',
                'meta_title' => 'Chemical Industry Jobs in Uganda - Chemical Manufacturing Careers',
                'meta_description' => 'Discover chemical industry jobs in Uganda. Find careers in chemical manufacturing, industrial chemicals, and chemical products companies.',
                'icon' => 'fa-flask',
                'sort_order' => 35
            ],
            [
                'name' => 'Waste Management',
                'slug' => 'waste-management-industry',
                'description' => 'Waste collection, recycling, and environmental services in Uganda',
                'meta_title' => 'Waste Management Jobs in Uganda - Recycling & Environmental Careers',
                'meta_description' => 'Browse waste management industry jobs in Uganda. Find careers in waste collection, recycling services, and environmental management.',
                'icon' => 'fa-trash-alt',
                'sort_order' => 36
            ],
            [
                'name' => 'Research',
                'slug' => 'research-industry',
                'description' => 'Research institutions, scientific research, and development services in Uganda',
                'meta_title' => 'Research Industry Jobs in Uganda - Scientific & Development Careers',
                'meta_description' => 'Find research industry jobs in Uganda. Explore careers in research institutions, scientific research, and development services.',
                'icon' => 'fa-microscope',
                'sort_order' => 37
            ],
            [
                'name' => 'Beverages',
                'slug' => 'beverages-industry',
                'description' => 'Beverage manufacturing, bottling companies, and drink production in Uganda',
                'meta_title' => 'Beverages Industry Jobs in Uganda - Drink Manufacturing Careers',
                'meta_description' => 'Discover beverages industry jobs in Uganda. Find careers in beverage manufacturing, bottling companies, and drink production.',
                'icon' => 'fa-wine-bottle',
                'sort_order' => 38
            ],
            [
                'name' => 'Clothing and Fashion',
                'slug' => 'clothing-fashion-industry',
                'description' => 'Clothing manufacturing, fashion retail, and apparel industry in Uganda',
                'meta_title' => 'Clothing Industry Jobs in Uganda - Fashion & Apparel Careers',
                'meta_description' => 'Browse clothing and fashion industry jobs in Uganda. Find careers in clothing manufacturing, fashion retail, and apparel companies.',
                'icon' => 'fa-tshirt',
                'sort_order' => 39
            ],
            [
                'name' => 'Printing',
                'slug' => 'printing-industry',
                'description' => 'Printing services, packaging, and graphic arts in Uganda',
                'meta_title' => 'Printing Industry Jobs in Uganda - Packaging & Graphic Arts Careers',
                'meta_description' => 'Find printing industry jobs in Uganda. Explore careers in printing services, packaging companies, and graphic arts businesses.',
                'icon' => 'fa-print',
                'sort_order' => 40
            ],
        ];

        foreach ($industries as $industry) {
            // Check if industry already exists to avoid duplicates
            $existingIndustry = Industry::where('slug', $industry['slug'])->first();
            
            if (!$existingIndustry) {
                Industry::create([
                    'name' => $industry['name'],
                    'slug' => $industry['slug'],
                    'description' => $industry['description'],
                    'meta_title' => $industry['meta_title'],
                    'meta_description' => $industry['meta_description'],
                    'icon' => $industry['icon'],
                    'is_active' => true,
                    'sort_order' => $industry['sort_order'],
                ]);
            }
        }

        // Don't create additional industries using factory to avoid slug conflicts
        // Industry::factory()->count(8)->create();
    }
}