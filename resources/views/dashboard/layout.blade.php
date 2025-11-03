<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katica AI Posting')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary: #3498db;
            --primary-light: #5dade2;
            --primary-dark: #2980b9;
            --secondary: #2c3e50;
            --secondary-light: #34495e;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --info: #17a2b8;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --gradient-primary: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            --gradient-secondary: linear-gradient(135deg, #2980b9 0%, #34495e 100%);
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 70px;
            --border-radius: 12px;
            --shadow: 0 8px 30px rgba(0,0,0,0.12);
            --shadow-sm: 0 2px 15px rgba(0,0,0,0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            color: #2c3e50;
        }

        /* Layout */
        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Mobile Overlay */
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .mobile-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed);
            width: calc(100% - var(--sidebar-collapsed));
        }

        /* Content Wrapper */
        .content-wrapper {
            flex: 1;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        /* Page Header */
        .page-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 2rem 0;
            margin-bottom: 0;
        }

        .page-header .container-fluid {
            max-width: 1200px;
        }

        /* Page Content */
        .page-content {
            flex: 1;
            padding: 2rem 0;
        }

        .page-content .container-fluid {
            max-width: 1200px;
        }

        /* Main Content Area - 8/12 width */
        .main-content-area {
            width: 100%;
            max-width: 100%;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 1400px) {
            .content-grid {
                grid-template-columns: 8fr 4fr;
            }
            
            .main-content-col {
                grid-column: 1;
            }
            
            .sidebar-content-col {
                grid-column: 2;
            }
        }

        /* Enhanced Styles */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
        }

        .btn-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .card {
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            border: none;
        }

        .card:hover {
            box-shadow: var(--shadow) !important;
        }

        .bg-opacity-10 {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        }

        /* Reusable Components */
        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            border: none;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }

        .table-enhanced {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .table-enhanced thead th {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .form-enhanced .form-control,
        .form-enhanced .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-enhanced .form-control:focus,
        .form-enhanced .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .badge-enhanced {
            border-radius: 6px;
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        /* Mobile Styles */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
                width: 100%;
            }

            .page-header,
            .page-content {
                padding: 1rem 0;
            }
        }

        /* Content Header Styles */
        .content-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1.5rem 0;
        }

        .content-header .container-fluid {
            max-width: 1200px;
        }
    </style>
</head>
<body>
    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>
        <div class="dashboard-wrapper">
            <!-- Sidebar Navigation -->
            @include('dashboard.navigation')
            
            <!-- Main Content -->
            <main class="main-content">
                <div class="content-wrapper">
                    <!-- Page Content -->
                    <div class="page-content">
                        <div class="container-fluid">
                            <div class="main-content-area">
                                <!-- Mobile Header -->
                                <div class="d-lg-none bg-gradient-primary text-white p-3">
                                    <div class="d-flex align-items-center">
                                        <!-- Mobile Toggle Button (Add this to your main layout, usually in header) -->
                                        <div class="logo-icon bg-white rounded-circle p-2 me-3">
                                            <i class="fas fa-robot text-primary fs-4"></i>
                                        </div>
                                        <button class="btn btn-light mobile-sidebar-toggle me-3" onclick="toggleSidebar()">
                                            <i class="fas fa-bars text-primary"></i>
                                        </button>
                                        <div>
                                            <h5 class="mb-0 text-white fw-bold">{{ $pageTitle ?? 'Dashboard' }}</h5>
                                            <small class="text-white-80">
                                                {{ $pageSubtitleLine1 ?? 'Welcome back, ' . (auth()->user()->first_name ?? 'User') }}<br>
                                                {{ $pageSubtitleLine2 ?? 'Here\'s your AI-powered hiring insights.' }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-header bg-gradient-primary shadow-sm d-none d-lg-block">
                                    <div class="container-fluid py-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h1 class="h3 mb-0 text-white fw-bold">@yield('page-title', 'Dashboard')</h1>
                                                <p class="text-white-80 mb-0 small">@yield('page-subtitle', 'Welcome to your dashboard')</p>
                                            </div>
                                            <div class="col-auto">
                                                <!-- Profile Dropdown -->
                                                <div class="col-auto">
                                                    <div class="dropdown">
                                                        <button class="btn btn-light d-flex align-items-center p-1 dropdown-toggle profile-dropdown-toggle" 
                                                                type="button" 
                                                                id="profileDropdown" 
                                                                data-bs-toggle="dropdown" 
                                                                data-bs-display="static"
                                                                aria-expanded="false">
                                                            <!-- Profile Image Thumbnail -->
                                                            <div class="profile-thumbnail me-2">
                                                                @if(auth()->user()->profile_image)
                                                                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" 
                                                                        alt="{{ auth()->user()->first_name }}" 
                                                                        class="rounded-circle" 
                                                                        width="32" 
                                                                        height="32">
                                                                @else
                                                                    <!-- Fallback with initials or default avatar -->
                                                                    <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                                                        style="width: 32px; height: 32px; font-size: 14px; font-weight: 600;">
                                                                        {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <span class="d-none d-sm-inline text-dark fw-semibold">{{ auth()->user()->first_name }}</span>
                                                        </button>
                                                        
                                                        <!-- Dropdown Menu -->
                                                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 profile-dropdown-menu" aria-labelledby="profileDropdown">
                                                            <!-- Profile Header -->
                                                            <li class="dropdown-header bg-gradient-primary text-white rounded-top-3 py-3 px-3">
                                                                <div class="d-flex align-items-center">
                                                                    @if(auth()->user()->profile_image)
                                                                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" 
                                                                            alt="{{ auth()->user()->first_name }}" 
                                                                            class="rounded-circle me-3 border border-3 border-white" 
                                                                            width="48" 
                                                                            height="48">
                                                                    @else
                                                                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3 border border-3 border-white" 
                                                                            style="width: 48px; height: 48px; font-size: 18px; font-weight: 700;">
                                                                            {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                                                                        </div>
                                                                    @endif
                                                                    <div class="flex-grow-1">
                                                                        <h6 class="mb-0 fw-bold text-white">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                                                                        <small class="text-white-80">{{ auth()->user()->email }}</small>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            
                                                            <!-- Dropdown Items -->
                                                            <li class="px-2 py-1">
                                                                <a class="dropdown-item d-flex align-items-center rounded-2 py-2 px-3" href="">
                                                                    <div class="dropdown-icon bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                                                        <i class="fas fa-user text-primary fs-6"></i>
                                                                    </div>
                                                                    <div>
                                                                        <span class="fw-semibold text-dark">My Profile</span>
                                                                        <small class="text-muted d-block">View and edit profile</small>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            
                                                            <li class="px-2 py-1">
                                                                <a class="dropdown-item d-flex align-items-center rounded-2 py-2 px-3" href="">
                                                                    <div class="dropdown-icon bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                                                        <i class="fas fa-cog text-success fs-6"></i>
                                                                    </div>
                                                                    <div>
                                                                        <span class="fw-semibold text-dark">Settings</span>
                                                                        <small class="text-muted d-block">Account preferences</small>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            
                                                            <li class="px-2 py-1">
                                                                <a class="dropdown-item d-flex align-items-center rounded-2 py-2 px-3" href="">
                                                                    <div class="dropdown-icon bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                                                        <i class="fas fa-question-circle text-info fs-6"></i>
                                                                    </div>
                                                                    <div>
                                                                        <span class="fw-semibold text-dark">Help & Support</span>
                                                                        <small class="text-muted d-block">Get help and guidance</small>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            
                                                            <li class="px-2 mt-1">
                                                                <hr class="dropdown-divider my-2">
                                                            </li>
                                                            
                                                            <!-- Logout -->
                                                            <li class="px-2 py-1">
                                                                <form method="POST" action="{{ route('auth.logout') }}" id="logout-form">
                                                                    @csrf
                                                                    <a class="dropdown-item d-flex align-items-center rounded-2 py-2 px-3 text-danger-hover" 
                                                                    href="{{ route('auth.logout') }}" 
                                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                        <div class="dropdown-icon bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                                                            <i class="fas fa-sign-out-alt text-danger fs-6"></i>
                                                                        </div>
                                                                        <div>
                                                                            <span class="fw-semibold text-danger">Logout</span>
                                                                            <small class="text-muted d-block">Sign out of your account</small>
                                                                        </div>
                                                                    </a>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Desktop color -->
    <style>
        .profile-dropdown-toggle {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.2s ease;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 4px 8px;
        }

        .profile-dropdown-toggle:hover {
            border-color: #3498db;
            box-shadow: 0 2px 6px rgba(52, 152, 219, 0.15);
        }

        .profile-dropdown-menu {
            border-radius: 8px;
            border: none;
            min-width: 220px;
            padding: 0;
            margin-top: 6px !important;
            background: white;
            font-size: 13px;
        }

        .profile-dropdown-menu .dropdown-header {
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            border-radius: 8px 8px 0 0;
            margin: 0;
            padding: 12px;
        }

        .profile-dropdown-menu .dropdown-item {
            border-radius: 6px;
            margin: 1px 3px;
            transition: all 0.2s ease;
            padding: 6px 8px;
        }

        .profile-dropdown-menu .dropdown-item:hover {
            background: #f8f9fa; /* Light gray background instead of gradient */
            transform: translateX(2px);
        }

        /* REMOVED: The problematic text color change on hover */
        /* .profile-dropdown-menu .dropdown-item:hover .text-dark,
        .profile-dropdown-menu .dropdown-item:hover .text-muted {
            color: white !important;
        } */

        .profile-dropdown-menu .dropdown-item:hover .dropdown-icon {
            background: rgba(52, 152, 219, 0.1) !important; /* Light blue instead of white */
        }

        .profile-dropdown-menu .dropdown-item:hover .dropdown-icon i {
            color: #3498db !important; /* Keep original icon color */
        }

        .text-danger-hover:hover {
            background: rgba(231, 76, 60, 0.1) !important; /* Light red instead of gradient */
        }

        /* REMOVED: The problematic text color change for logout */
        /* .text-danger-hover:hover .text-danger,
        .text-danger-hover:hover .text-muted {
            color: white !important;
        } */

        .text-danger-hover:hover .dropdown-icon {
            background: rgba(231, 76, 60, 0.2) !important;
        }

        .text-danger-hover:hover .dropdown-icon i {
            color: #e74c3c !important; /* Keep original danger color */
        }

        .dropdown-icon {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        }

        .text-white-80 {
            color: rgba(255, 255, 255, 0.8);
        }

        .profile-thumbnail {
            transition: transform 0.2s ease;
        }

        .profile-dropdown-toggle:hover .profile-thumbnail {
            transform: scale(1.05);
        }

        .profile-dropdown-toggle.show {
            border-color: #3498db;
            background: #f8f9fa;
        }

        /* Animation for dropdown */
        .profile-dropdown-menu {
            animation: dropdownSlideIn 0.2s ease;
        }

        @keyframes dropdownSlideIn {
            from {
                opacity: 0;
                transform: translateY(-5px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .profile-dropdown-menu {
                min-width: 200px;
            }
            
            .profile-dropdown-toggle .d-sm-inline {
                display: none !important;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdownMenu = document.querySelector('.profile-dropdown-menu');
            
            if (profileDropdown && dropdownMenu) {
                dropdownMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                
                // Add show class for animation
                profileDropdown.addEventListener('show.bs.dropdown', function () {
                    dropdownMenu.style.animation = 'dropdownSlideIn 0.2s ease';
                });
            }
        });
    </script>
    <!-- Mobile style color -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%) !important;
        }

        .text-white-80 {
            color: rgba(255, 255, 255, 0.8);
        }

        /* Mobile Header Styles */
        .d-lg-none.bg-gradient-primary {
            border-bottom: none;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        /* Mobile Menu Button */
        .d-lg-none .btn-light {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            padding: 0.5rem;
        }

        .d-lg-none .btn-light:hover {
            background: white;
            border-color: rgba(255, 255, 255, 0.6);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .d-lg-none .btn-light .text-primary {
            color: #3498db !important;
        }
    </style>

    <!-- Page-specific scripts -->
    @yield('scripts')
</body>
</html>