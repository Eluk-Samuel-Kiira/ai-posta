<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaFab AI Posting')</title>

    <!-- Favicon References -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

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
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed);
            width: calc(100% - var(--sidebar-collapsed));
        }

        /* Content Header */
        .content-header {
            border-bottom: 1px solid #e9ecef;
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
        }

        .card:hover {
            box-shadow: var(--shadow) !important;
        }

        .bg-opacity-10 {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        }

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
            <!-- Page Content -->
            @yield('content')
        </main>
    </div>

    <!-- Sidebar Script -->
    <script>
        // Define functions in global scope
        window.toggleSidebar = function() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('mobileOverlay');
            
            if (!sidebar) return;
            
            if (window.innerWidth < 992) {
                sidebar.classList.toggle('mobile-open');
                if (overlay) overlay.classList.toggle('active');
            } else {
                sidebar.classList.toggle('collapsed');
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                updateToggleButton();
            }
        }

        window.closeSidebar = function() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('mobileOverlay');
            if (sidebar) sidebar.classList.remove('mobile-open');
            if (overlay) overlay.classList.remove('active');
        }

        window.updateToggleButton = function() {
            const sidebar = document.querySelector('.sidebar');
            const buttons = document.querySelectorAll('.sidebar-toggle');
            
            if (!sidebar) return;
            
            buttons.forEach(button => {
                const icon = button.querySelector('i');
                const span = button.querySelector('span');
                if (sidebar.classList.contains('collapsed')) {
                    if (icon) icon.className = 'fas fa-chevron-right me-2';
                    if (span) span.textContent = 'Expand Menu';
                } else {
                    if (icon) icon.className = 'fas fa-chevron-left me-2';
                    if (span) span.textContent = 'Collapse Menu';
                }
            });
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('mobileOverlay');
            
            if (sidebar && window.innerWidth >= 992 && isCollapsed) {
                sidebar.classList.add('collapsed');
            }
            
            updateToggleButton();

            // Close sidebar on mobile menu click
            document.querySelectorAll('.sidebar-menu .nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        closeSidebar();
                    }
                });
            });

            // Close sidebar on overlay click
            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            // Add event listeners to all toggle buttons
            document.querySelectorAll('.sidebar-toggle').forEach(btn => {
                btn.addEventListener('click', toggleSidebar);
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });
    </script>

    <!-- Page-specific scripts -->
    @yield('scripts')
</body>
</html>