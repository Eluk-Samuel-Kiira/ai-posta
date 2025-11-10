<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card hover-lift bg-gradient-primary text-white">
            <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 me-3">
                    <i class="fas fa-building fs-4"></i>
                </div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $companies->count() }}</h3>
                    <small class="opacity-80">Total Companies</small>
                </div>
            </div>
            <div class="stat-progress mt-2">
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-white" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card hover-lift bg-gradient-success text-white">
            <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 me-3">
                    <i class="fas fa-check-circle fs-4"></i>
                </div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $companies->where('is_active', true)->count() }}</h3>
                    <small class="opacity-80">Active</small>
                </div>
            </div>
            <div class="stat-progress mt-2">
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-white" style="width: {{ $companies->count() ? ($companies->where('is_active', true)->count() / $companies->count()) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card hover-lift bg-gradient-info text-white">
            <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 me-3">
                    <i class="fas fa-shield-alt fs-4"></i>
                </div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $companies->where('is_verified', true)->count() }}</h3>
                    <small class="opacity-80">Verified</small>
                </div>
            </div>
            <div class="stat-progress mt-2">
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-white" style="width: {{ $companies->count() ? ($companies->where('is_verified', true)->count() / $companies->count()) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card hover-lift bg-gradient-warning text-white">
            <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 me-3">
                    <i class="fas fa-clock fs-4"></i>
                </div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $companies->where('is_verified', false)->count() }}</h3>
                    <small class="opacity-80">Pending</small>
                </div>
            </div>
            <div class="stat-progress mt-2">
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-white" style="width: {{ $companies->count() ? ($companies->where('is_verified', false)->count() / $companies->count()) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Companies Table -->
<div class="card border-0 shadow-sm table-enhanced">
    <!-- Card Header -->
    <div class="card-header bg-white border-bottom py-4 px-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div class="flex-grow-1">
                <h5 class="card-title mb-1 text-dark fw-bold">Companies</h5>
                <p class="text-muted small mb-0">Manage and organize all your companies</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('companies.create') }}" class="btn btn-primary btn-sm btn-hover">
                    <i class="fas fa-plus me-2"></i>
                    Add Company
                </a>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" 
                            type="button" 
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fas fa-filter me-2"></i>
                        Filter
                        <span class="badge bg-primary ms-2">{{ request('filter', 'all') }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li>
                            <a class="dropdown-item d-flex justify-content-between align-items-center py-2" 
                            href="{{ route('companies.index') }}">
                                All Companies
                                <span class="badge bg-secondary rounded-pill">{{ $companies->count() }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex justify-content-between align-items-center py-2" 
                            href="{{ route('companies.index', ['filter' => 'active']) }}">
                                Active Only
                                <span class="badge bg-success rounded-pill">{{ $companies->where('is_active', true)->count() }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex justify-content-between align-items-center py-2" 
                            href="{{ route('companies.index', ['filter' => 'verified']) }}">
                                Verified Only
                                <span class="badge bg-info rounded-pill">{{ $companies->where('is_verified', true)->count() }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex justify-content-between align-items-center py-2" 
                            href="{{ route('companies.index', ['filter' => 'pending']) }}">
                                Pending Only
                                <span class="badge bg-warning rounded-pill">{{ $companies->where('is_verified', false)->count() }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Table Content -->
    <div class="card-body p-0">
        @if($companies->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3 border-0 text-muted fw-semibold small text-uppercase">Company</th>
                        <th class="py-3 border-0 text-muted fw-semibold small text-uppercase">Contact</th>
                        <th class="py-3 border-0 text-muted fw-semibold small text-uppercase">Industry</th>
                        <th class="py-3 border-0 text-muted fw-semibold small text-uppercase">Status</th>
                        <th class="text-end pe-4 py-3 border-0 text-muted fw-semibold small text-uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                    <tr class="border-bottom">
                        <!-- Company Details -->
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <!-- Logo -->
                                <div class="position-relative me-3">
                                    @if($company->logo && file_exists(public_path('storage/' . $company->logo)))
                                    <img src="{{ asset('storage/' . $company->logo) }}" 
                                        alt="{{ $company->name }}"
                                        class="rounded-circle shadow-sm"
                                        width="48"
                                        height="48"
                                        style="object-fit: cover;"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    @endif
                                    @if(!$company->logo || !file_exists(public_path('storage/' . $company->logo)))
                                    <div class="bg-gradient-info rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                        style="width: 48px; height: 48px;">
                                        <i class="fas fa-building text-white fs-6"></i>
                                    </div>
                                    @endif
                                </div>
                                
                                <!-- Company Info -->
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-semibold text-dark">{{ $company->name }}</h6>
                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        @if($company->company_size)
                                        <span class="badge bg-light text-dark border small">
                                            <i class="fas fa-users me-1"></i>
                                            {{ $company->company_size }}
                                        </span>
                                        @endif
                                        @if($company->website)
                                        <a href="{{ $company->website }}" 
                                        target="_blank" 
                                        class="text-primary text-decoration-none small d-flex align-items-center"
                                        data-bs-toggle="tooltip"
                                        title="Visit website">
                                            <i class="fas fa-external-link-alt me-1"></i>
                                            {{ parse_url($company->website, PHP_URL_HOST) }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Contact Info -->
                        <td class="py-3">
                            <div class="text-dark fw-medium small">{{ $company->contact_name ?? 'Not specified' }}</div>
                            @if($company->contact_email)
                            <div class="text-muted small d-flex align-items-center mt-1">
                                <i class="fas fa-envelope me-2 text-muted"></i>
                                <span class="text-truncate" style="max-width: 150px;">{{ $company->contact_email }}</span>
                            </div>
                            @endif
                            @if($company->contact_phone)
                            <div class="text-muted small d-flex align-items-center mt-1">
                                <i class="fas fa-phone me-2 text-muted"></i>
                                {{ $company->contact_phone }}
                            </div>
                            @endif
                        </td>
                        
                        <!-- Industry -->
                        <td class="py-3">
                            @if($company->industry)
                            <span class="text-dark fw-medium">{{ $company->industry->name }}</span>
                            @else
                            <span class="text-muted small">Not specified</span>
                            @endif
                        </td>
                        
                        <!-- Status -->
                        <td class="py-3">
                            <div class="d-flex flex-column gap-1">
                                <span class="badge {{ $company->is_active ? 'bg-success bg-opacity-10 text-success border border-success border-opacity-25' : 'bg-light text-muted border' }} small">
                                    <i class="fas fa-circle me-1" style="font-size: 6px;"></i>
                                    {{ $company->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="badge {{ $company->is_verified ? 'bg-info bg-opacity-10 text-info border border-info border-opacity-25' : 'bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25' }} small">
                                    <i class="fas fa-{{ $company->is_verified ? 'check' : 'clock' }} me-1"></i>
                                    {{ $company->is_verified ? 'Verified' : 'Pending' }}
                                </span>
                            </div>
                        </td>
                        
                        <!-- Actions -->
                        <td class="text-end pe-4 py-3">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('companies.edit', $company->id) }}" 
                                class="btn btn-outline-secondary btn-hover border-end-0 rounded-start"
                                data-bs-toggle="tooltip"
                                title="Edit Company">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="btn btn-outline-secondary btn-hover border-start-0 border-end-0 rounded-0"
                                            data-bs-toggle="tooltip"
                                            title="{{ $company->is_active ? 'Deactivate' : 'Activate' }}">
                                        <i class="fas fa-{{ $company->is_active ? 'pause' : 'play' }}"></i>
                                    </button>
                                </form>
                                
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-outline-danger btn-hover border-start-0 rounded-end"
                                            onclick="return confirm('Are you sure you want to delete {{ $company->name }}?')"
                                            data-bs-toggle="tooltip"
                                            title="Delete Company">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-5 px-4">
            <div class="py-4">
                <div class="bg-gradient-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                    style="width: 100px; height: 100px;">
                    <i class="fas fa-building fa-2x text-primary"></i>
                </div>
                <h4 class="text-dark mb-3">No Companies Found</h4>
                <p class="text-muted mb-4">Get started by creating your first company to manage your business portfolio</p>
                <a href="{{ route('companies.create') }}" class="btn btn-primary btn-lg btn-hover px-4">
                    <i class="fas fa-plus me-2"></i>
                    Create Your First Company
                </a>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Card Footer -->
    @if($companies->count() > 0)
    <div class="card-footer bg-white border-top py-3 px-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div class="text-muted small">
                <i class="fas fa-info-circle me-1"></i>
                Showing {{ $companies->count() }} companies • 
                Last updated: {{ now()->format('g:i A') }}
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('companies.create') }}" class="btn btn-primary btn-sm btn-hover">
                    <i class="fas fa-plus me-1"></i>
                    Add New Company
                </a>
            </div>
        </div>
    </div>
    @endif
</div>