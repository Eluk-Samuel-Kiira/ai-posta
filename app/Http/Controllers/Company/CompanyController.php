<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Company::with('industry')->latest();
        
        // Apply filters
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'active':
                    $query->where('is_active', true);
                    break;
                case 'verified':
                    $query->where('is_verified', true);
                    break;
                case 'pending':
                    $query->where('is_verified', false);
                    break;
            }
        }
        
        $companies = $query->get();

        return view('companies.index', [
            'pageTitle' => 'Company Management',
            'pageSubtitleLine1' => 'Welcome back, ' . auth()->user()->first_name . '!',
            'pageSubtitleLine2' => 'Manage your companies efficiently.',
            'companies' => $companies
        ]);
    }

    public function toggleStatus(Company $company)
    {
        $company->update([
            'is_active' => !$company->is_active
        ]);
        
        return redirect()->route('companies.index')
            ->with('success', 'Company status updated successfully.');
    }


    public function company()
    {
        $companies = Company::with('industry')->get();
        return response()->json($companies);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:companies',
            'logo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'contact_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'address1' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:50',
            'industry_id' => 'nullable|exists:industries,id',
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        $company = Company::create($validated);

        return response()->json(['success' => true, 'company' => $company]);
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:companies,slug,' . $company->id,
            'logo' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'contact_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'address1' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:50',
            'industry_id' => 'nullable|exists:industries,id',
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $validated['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        $company->update($validated);

        return response()->json(['success' => true, 'company' => $company]);
    }

    public function destroy(Company $company)
    {
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        
        $company->delete();

        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request, Company $company)
    {
        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $company->update(['is_active' => $request->is_active]);

        return response()->json(['success' => true]);
    }
}