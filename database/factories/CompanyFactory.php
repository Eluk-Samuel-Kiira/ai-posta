<?php
// database/factories/CompanyFactory.php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Industry;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        $name = $this->faker->company();
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->paragraph(3),
            'website' => $this->faker->url(),
            'contact_name' => $this->faker->name(),
            'contact_email' => $this->faker->companyEmail(),
            'contact_phone' => $this->faker->phoneNumber(),
            'address1' => $this->faker->address(),
            'company_size' => $this->faker->randomElement([
                '1-10 employees', 
                '11-50 employees', 
                '51-200 employees',
                '201-500 employees', 
                '501-1000 employees', 
                '1000+ employees'
            ]),
            'industry_id' => Industry::inRandomOrder()->first()?->id,
            'is_active' => $this->faker->boolean(90),
            'is_verified' => $this->faker->boolean(70),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Company $company) {
            // Add logo for some companies (50% chance)
            if ($this->faker->boolean(50)) {
                $this->addLogo($company);
            }
        });
    }

    public function withLogo()
    {
        return $this->afterCreating(function (Company $company) {
            $this->addLogo($company);
        });
    }

    public function withoutLogo()
    {
        return $this->state(function (array $attributes) {
            return [
                'logo' => null,
            ];
        });
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
            ];
        });
    }

    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }

    public function verified()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_verified' => true,
            ];
        });
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_verified' => false,
            ];
        });
    }

    public function largeCompany()
    {
        return $this->state(function (array $attributes) {
            return [
                'company_size' => $this->faker->randomElement(['201-500 employees', '501-1000 employees', '1000+ employees']),
            ];
        });
    }

    public function smallCompany()
    {
        return $this->state(function (array $attributes) {
            return [
                'company_size' => $this->faker->randomElement(['1-10 employees', '11-50 employees']),
            ];
        });
    }

    private function addLogo(Company $company)
    {
        try {
            $initials = $this->getInitials($company->name);
            
            // Use a simple SVG logo instead of GD functions
            $logoContent = $this->generateSVGLogo($initials, $company->name);
            
            $filename = 'companies/logos/' . $company->slug . '-' . time() . '.svg';
            
            Storage::disk('public')->put($filename, $logoContent);
            $company->update(['logo' => $filename]);
            
        } catch (\Exception $e) {
            // If SVG generation fails, use a placeholder service
            $this->usePlaceholderLogo($company);
        }
    }

    private function generateSVGLogo($initials, $companyName)
    {
        // Generate a consistent color based on company name
        $color = $this->generateColorFromString($companyName);
        
        $svg = <<<SVG
<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">
    <rect width="100" height="100" fill="#{$color}" />
    <text x="50" y="55" font-family="Arial, sans-serif" font-size="24" 
          fill="white" text-anchor="middle" font-weight="bold">
        {$initials}
    </text>
</svg>
SVG;
        
        return $svg;
    }

    private function usePlaceholderLogo(Company $company)
    {
        try {
            $initials = $this->getInitials($company->name);
            $color = substr(md5($company->name), 0, 6);
            
            // Use a simple text-based approach
            $logoContent = "data:image/svg+xml;base64," . base64_encode($this->generateSVGLogo($initials, $company->name));
            
            // For now, we'll just store the SVG content directly
            $filename = 'companies/logos/' . $company->slug . '-' . time() . '.svg';
            Storage::disk('public')->put($filename, $this->generateSVGLogo($initials, $company->name));
            $company->update(['logo' => $filename]);
            
        } catch (\Exception $e) {
            // If everything fails, just don't set a logo
            \Log::warning("Could not generate logo for company: {$company->name}");
        }
    }

    private function getInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty(trim($word))) {
                $initials .= strtoupper(substr(trim($word), 0, 1));
            }
        }
        
        return substr($initials, 0, 3); // Max 3 initials
    }

    private function generateColorFromString($string)
    {
        // Generate a hex color from string hash
        $hash = md5($string);
        return substr($hash, 0, 6);
    }
}