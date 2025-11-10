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
            --shadow-lg: 0 15px 40px rgba(0,0,0,0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            line-height: 1.6;
        }

        /* ===== LAYOUT STRUCTURE ===== */
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
            transition: var(--transition);
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

        /* ===== HEADER STYLES ===== */
        .content-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1.5rem 0;
        }

        .content-header .container-fluid {
            max-width: 1200px;
        }

        /* Mobile Header */
        .mobile-header {
            background: var(--gradient-primary);
            border-bottom: none;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            padding: 1rem;
        }

        .mobile-header .btn-light {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            backdrop-filter: blur(10px);
            transition: var(--transition);
            padding: 0.5rem;
        }

        .mobile-header .btn-light:hover {
            background: white;
            border-color: rgba(255, 255, 255, 0.6);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* ===== CONTENT AREAS ===== */
        .page-content {
            flex: 1;
            padding: 2rem 0;
        }

        .page-content .container-fluid {
            max-width: 1200px;
        }

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

        /* ===== REUSABLE COMPONENTS ===== */
        
        /* Cards */
        .card {
            border-radius: var(--border-radius);
            transition: var(--transition);
            border: none;
            box-shadow: var(--shadow-sm);
        }

        .card:hover {
            box-shadow: var(--shadow) !important;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            border: none;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }

        /* Buttons */
        .btn-hover {
            transition: var(--transition);
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .hover-lift {
            transition: var(--transition);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg) !important;
        }

        /* Badges */
        .badge-enhanced {
            border-radius: 6px;
            font-weight: 500;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
        }

        /* Background Utilities */
        .bg-opacity-10 {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        }

        .bg-gradient-primary { background: var(--gradient-primary) !important; }
        .bg-gradient-success { background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%) !important; }
        .bg-gradient-info { background: linear-gradient(135deg, #17a2b8 0%, #48cae4 100%) !important; }
        .bg-gradient-warning { background: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%) !important; }

        .text-gradient-primary {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-white-80 {
            color: rgba(255, 255, 255, 0.8);
        }

        /* ===== TABLES ===== */
        .table-enhanced {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            background: white;
        }

        .table-enhanced thead th {
            background: #f8f9fa;
            color: #2c3e50;
            border: none;
            padding: 1rem;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
        }

        .table-enhanced tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f8f9fa;
        }

        .table-enhanced tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.03) !important;
            transform: translateX(1px);
        }

        .table-enhanced tbody td {
            padding: 1rem;
            vertical-align: middle;
            border: none;
        }

        /* ===== FORMS ===== */
        .form-enhanced {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .form-enhanced .form-control,
        .form-enhanced .form-select,
        .form-enhanced .form-textarea {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .form-enhanced .form-control:focus,
        .form-enhanced .form-select:focus,
        .form-enhanced .form-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        }

        .form-enhanced .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .form-enhanced .form-section {
            background: #f8f9fa;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-enhanced .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        /* ===== PROFILE DROPDOWN ===== */
        .profile-dropdown-toggle {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            transition: var(--transition);
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 4px 8px;
        }

        .profile-dropdown-toggle:hover {
            border-color: var(--primary);
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
            animation: dropdownSlideIn 0.2s ease;
        }

        .profile-dropdown-menu .dropdown-header {
            background: var(--gradient-primary);
            border-radius: 8px 8px 0 0;
            margin: 0;
            padding: 12px;
        }

        .profile-dropdown-menu .dropdown-item {
            border-radius: 6px;
            margin: 1px 3px;
            transition: var(--transition);
            padding: 6px 8px;
        }

        .profile-dropdown-menu .dropdown-item:hover {
            background: #f8f9fa;
            transform: translateX(2px);
        }

        .profile-dropdown-menu .dropdown-item:hover .dropdown-icon {
            background: rgba(52, 152, 219, 0.1) !important;
        }

        .profile-dropdown-menu .dropdown-item:hover .dropdown-icon i {
            color: var(--primary) !important;
        }

        .text-danger-hover:hover {
            background: rgba(231, 76, 60, 0.1) !important;
        }

        .text-danger-hover:hover .dropdown-icon {
            background: rgba(231, 76, 60, 0.2) !important;
        }

        .text-danger-hover:hover .dropdown-icon i {
            color: var(--danger) !important;
        }

        .dropdown-icon {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
            transition: var(--transition);
        }

        .profile-thumbnail {
            transition: transform 0.2s ease;
        }

        .profile-dropdown-toggle:hover .profile-thumbnail {
            transform: scale(1.05);
        }

        .profile-dropdown-toggle.show {
            border-color: var(--primary);
            background: #f8f9fa;
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

        /* ===== RESPONSIVE DESIGN ===== */
        
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

            .page-content {
                padding: 1rem 0;
            }

            /* Mobile Table Styles */
            .table-enhanced {
                font-size: 0.875rem;
            }

            .table-enhanced thead {
                display: none;
            }

            .table-enhanced tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #e9ecef;
                border-radius: var(--border-radius);
                padding: 1rem;
                background: white;
                box-shadow: var(--shadow-sm);
            }

            .table-enhanced tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.5rem 0;
                border-bottom: 1px solid #f8f9fa;
                text-align: right;
            }

            .table-enhanced tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #2c3e50;
                margin-right: auto;
                padding-right: 1rem;
                text-align: left;
            }

            .table-enhanced tbody td:last-child {
                border-bottom: none;
                justify-content: center;
            }

            /* Profile dropdown mobile */
            .profile-dropdown-menu {
                min-width: 200px;
            }
            
            .profile-dropdown-toggle .d-sm-inline {
                display: none !important;
            }
        }

        /* Desktop Styles */
        @media (min-width: 992px) {
            .mobile-sidebar-toggle {
                display: none !important;
            }
        }

        /* Button group enhancements */
        .btn-group .btn {
            border-radius: 0;
        }

        .btn-group .btn:first-child {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .btn-group .btn:last-child {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
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
                            <div class="d-lg-none mobile-header text-white">
                                <div class="d-flex align-items-center">
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

                            <!-- Desktop Header -->
                            <div class="content-header bg-gradient-primary shadow-sm d-none d-lg-block">
                                <div class="container-fluid py-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h1 class="h3 mb-0 text-white fw-bold">@yield('page-title', 'Dashboard')</h1>
                                            <p class="text-white-80 mb-0 small">@yield('page-subtitle', 'Welcome to your dashboard')</p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Profile Dropdown -->
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

                            <!-- Main Content Area -->
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Reusable JavaScript -->
    <script>
        // Initialize tooltips and other common functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    delay: { "show": 300, "hide": 100 }
                })
            });

            // Profile dropdown animation
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdownMenu = document.querySelector('.profile-dropdown-menu');
            
            if (profileDropdown && dropdownMenu) {
                dropdownMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                
                profileDropdown.addEventListener('show.bs.dropdown', function () {
                    dropdownMenu.style.animation = 'dropdownSlideIn 0.2s ease';
                });
            }

            // Mobile table enhancements
            function enhanceTablesForMobile() {
                document.querySelectorAll('.table-enhanced').forEach(table => {
                    if (window.innerWidth < 768) {
                        const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());
                        table.querySelectorAll('tbody tr').forEach(row => {
                            Array.from(row.querySelectorAll('td')).forEach((td, index) => {
                                if (headers[index]) {
                                    td.setAttribute('data-label', headers[index]);
                                }
                            });
                        });
                    }
                });
            }

            // Image error handling
            document.querySelectorAll('img[src*="storage/"]').forEach(img => {
                img.addEventListener('error', function() {
                    this.style.display = 'none';
                    const fallback = this.nextElementSibling;
                    if (fallback && fallback.classList.contains('rounded-circle')) {
                        fallback.style.display = 'flex';
                    }
                });
            });

            enhanceTablesForMobile();
            window.addEventListener('resize', enhanceTablesForMobile);
        });

        // Sidebar functions (should be in your navigation component)
        function toggleSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            const overlay = document.getElementById('mobileOverlay');
            
            if (!sidebar) return;
            
            if (window.innerWidth < 992) {
                // Mobile behavior
                const isOpening = !sidebar.classList.contains('mobile-open');
                
                sidebar.classList.toggle('mobile-open');
                
                if (overlay) {
                    overlay.classList.toggle('active');
                }
                
                document.body.classList.toggle('sidebar-open');
            } else {
                // Desktop behavior
                sidebar.classList.toggle('collapsed');
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            const overlay = document.getElementById('mobileOverlay');
            
            if (sidebar) {
                sidebar.classList.remove('mobile-open');
            }
            if (overlay) {
                overlay.classList.remove('active');
            }
            document.body.classList.remove('sidebar-open');
        }
    </script>

    <!-- Page-specific scripts -->
    @yield('scripts')
</body>
</html>