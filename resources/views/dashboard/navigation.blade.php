<nav class="sidebar {{ session()->get('sidebar_collapsed') ? 'collapsed' : '' }}" id="mainSidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <div class="d-flex align-items-center justify-content-between p-4">
            <div class="logo d-flex align-items-center">
                <div class="logo-icon bg-white rounded-circle p-2 me-3">
                    <i class="fas fa-robot text-primary fs-4"></i>
                </div>
                <div class="logo-text">
                    <span class="h5 mb-0 text-white fw-bold">Katica AI</span>
                    <small class="text-white-50 d-block">Job Posting</small>
                </div>
            </div>
            <button class="btn-close btn-close-white d-lg-none" onclick="closeSidebar()"></button>
        </div>
    </div>

    <!-- User Profile -->
    <div class="user-profile border-bottom border-dark px-4 py-3">
        <div class="d-flex align-items-center">
            <div class="user-avatar bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                <span class="text-white fw-bold fs-5">
                    {{ strtoupper(substr(auth()->user()->first_name ?? 'U', 0, 1)) }}
                </span>
            </div>
            <div class="user-info">
                <div class="text-white fw-semibold">{{ auth()->user()->first_name ?? 'User' }} {{ auth()->user()->last_name ?? '' }}</div>
                <small class="text-white-50">{{ auth()->user()->email }}</small>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar-menu p-3">
        <ul class="nav nav-pills flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link text-white d-flex align-items-center px-3 py-3 mb-2 rounded-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-3 fs-5"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            
            <!-- Job Postings Expandable Section -->
            <li class="nav-item expandable-section">
                <div class="section-header">
                    <a href="javascript:void(0)" class="nav-link text-white d-flex align-items-center px-3 py-3 mb-2 rounded-3" onclick="toggleSection(this)">
                        <i class="fas fa-briefcase me-3 fs-5"></i>
                        <span class="menu-text">Job Postings</span>
                        <span class="badge bg-success badge-enhanced ms-auto">18</span>
                        <i class="fas fa-chevron-down ms-2 section-arrow"></i>
                    </a>
                </div>
                <div class="section-content">
                    <div class="sub-menu ps-4">
                        <a href="{{ route('job-postings.create') }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-plus me-2 fs-6"></i>
                            <span class="menu-text">New Job Post</span>
                        </a>
                        <a href="{{ route('job-postings.index') }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-list me-2 fs-6"></i>
                            <span class="menu-text">All Job Posts</span>
                        </a>
                        <a href="{{ route('job-postings.index', ['status' => 'active']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-play-circle me-2 fs-6"></i>
                            <span class="menu-text">Active Posts</span>
                            <span class="badge bg-success badge-enhanced ms-auto">12</span>
                        </a>
                        <a href="{{ route('job-postings.index', ['status' => 'draft']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-edit me-2 fs-6"></i>
                            <span class="menu-text">Drafts</span>
                            <span class="badge bg-warning badge-enhanced ms-auto">4</span>
                        </a>
                        <a href="{{ route('job-postings.index', ['status' => 'closed']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-ban me-2 fs-6"></i>
                            <span class="menu-text">Closed Posts</span>
                            <span class="badge bg-danger badge-enhanced ms-auto">2</span>
                        </a>
                    </div>
                </div>
            </li>

            <!-- Companies Expandable Section -->
            <li class="nav-item expandable-section">
                <div class="section-header">
                    <a href="javascript:void(0)" class="nav-link text-white d-flex align-items-center px-3 py-3 mb-2 rounded-3" onclick="toggleSection(this)">
                        <i class="fas fa-university me-3 fs-5"></i>
                        <span class="menu-text">Companies</span>
                        <span class="badge bg-primary badge-enhanced ms-auto">12</span>
                        <i class="fas fa-chevron-down ms-2 section-arrow"></i>
                    </a>
                </div>
                <div class="section-content">
                    <div class="sub-menu ps-4">
                        <a href="{{ route('companies.create') }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-plus me-2 fs-6"></i>
                            <span class="menu-text">Add New Company</span>
                        </a>
                        <a href="{{ route('companies.index') }}" 
                        class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3 {{ request()->routeIs('companies.index') ? 'active' : '' }}">
                            <i class="fas fa-building me-2 fs-6"></i>
                            <span class="menu-text">All Companies</span>
                        </a>
                        <a href="{{ route('companies.index', ['type' => 'active']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-check-circle me-2 fs-6"></i>
                            <span class="menu-text">Active Companies</span>
                        </a>
                        <a href="{{ route('companies.index', ['type' => 'archived']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-archive me-2 fs-6"></i>
                            <span class="menu-text">Archived</span>
                        </a>
                    </div>
                </div>
            </li>

            <!-- Candidates Expandable Section -->
            <li class="nav-item expandable-section">
                <div class="section-header">
                    <a href="javascript:void(0)" class="nav-link text-white d-flex align-items-center px-3 py-3 mb-2 rounded-3" onclick="toggleSection(this)">
                        <i class="fas fa-users me-3 fs-5"></i>
                        <span class="menu-text">Candidates</span>
                        <span class="badge bg-info badge-enhanced ms-auto">247</span>
                        <i class="fas fa-chevron-down ms-2 section-arrow"></i>
                    </a>
                </div>
                <div class="section-content">
                    <div class="sub-menu ps-4">
                        <a href="{{ route('candidates.index') }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-list me-2 fs-6"></i>
                            <span class="menu-text">All Candidates</span>
                        </a>
                        <a href="{{ route('candidates.index', ['status' => 'new']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-star me-2 fs-6"></i>
                            <span class="menu-text">New Applicants</span>
                            <span class="badge bg-success badge-enhanced ms-auto">42</span>
                        </a>
                        <a href="{{ route('candidates.index', ['status' => 'reviewed']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-eye me-2 fs-6"></i>
                            <span class="menu-text">Reviewed</span>
                            <span class="badge bg-primary badge-enhanced ms-auto">85</span>
                        </a>
                        <a href="{{ route('candidates.index', ['status' => 'shortlisted']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-check-double me-2 fs-6"></i>
                            <span class="menu-text">Shortlisted</span>
                            <span class="badge bg-warning badge-enhanced ms-auto">23</span>
                        </a>
                        <a href="{{ route('candidates.index', ['status' => 'rejected']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-times me-2 fs-6"></i>
                            <span class="menu-text">Rejected</span>
                            <span class="badge bg-danger badge-enhanced ms-auto">97</span>
                        </a>
                    </div>
                </div>
            </li>

            <!-- AI Assistant -->
            <li class="nav-item">
                <a href="{{ route('ai-assistant.index') }}" class="nav-link text-white d-flex align-items-center px-3 py-3 mb-2 rounded-3 {{ request()->routeIs('ai-assistant.*') ? 'active' : '' }}">
                    <i class="fas fa-robot me-3 fs-5"></i>
                    <span class="menu-text">AI Assistant</span>
                    <span class="badge bg-warning badge-enhanced ms-auto">New</span>
                </a>
            </li>
            
            <!-- Analytics -->
            <li class="nav-item">
                <a href="{{ route('analytics.index') }}" class="nav-link text-white d-flex align-items-center px-3 py-3 mb-2 rounded-3 {{ request()->routeIs('analytics.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar me-3 fs-5"></i>
                    <span class="menu-text">Analytics</span>
                </a>
            </li>
            
            <!-- Templates Expandable Section -->
            <li class="nav-item expandable-section">
                <div class="section-header">
                    <a href="javascript:void(0)" class="nav-link text-white d-flex align-items-center px-3 py-3 mb-2 rounded-3" onclick="toggleSection(this)">
                        <i class="fas fa-file-alt me-3 fs-5"></i>
                        <span class="menu-text">Templates</span>
                        <i class="fas fa-chevron-down ms-2 section-arrow"></i>
                    </a>
                </div>
                <div class="section-content">
                    <div class="sub-menu ps-4">
                        <a href="{{ route('templates.index') }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-list me-2 fs-6"></i>
                            <span class="menu-text">All Templates</span>
                        </a>
                        <a href="{{ route('templates.index', ['type' => 'job-description']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-briefcase me-2 fs-6"></i>
                            <span class="menu-text">Job Descriptions</span>
                        </a>
                        <a href="{{ route('templates.index', ['type' => 'email']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-envelope me-2 fs-6"></i>
                            <span class="menu-text">Email Templates</span>
                        </a>
                        <a href="{{ route('templates.index', ['type' => 'assessment']) }}" class="nav-link text-white d-flex align-items-center px-3 py-2 mb-1 rounded-3">
                            <i class="fas fa-tasks me-2 fs-6"></i>
                            <span class="menu-text">Assessments</span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>

        <!-- Settings Section -->
        <div class="mt-4 pt-3 border-top border-dark">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="{{ route('settings.index') }}" class="nav-link text-white d-flex align-items-center px-3 py-3 mb-2 rounded-3 {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                        <i class="fas fa-cog me-3 fs-5"></i>
                        <span class="menu-text">Settings</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <form method="POST" action="{{ route('auth.logout') }}" id="logout-form">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-white d-flex align-items-center px-3 py-3 mb-2 rounded-3">
                            <i class="fas fa-sign-out-alt me-3 fs-5"></i>
                            <span class="menu-text">Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Sidebar Toggle -->
    <div class="sidebar-footer p-3 border-top border-dark d-none d-lg-block">
        <button class="btn btn-outline-light w-100 sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left me-2"></i>
            <span>Collapse Menu</span>
        </button>
    </div>
</nav>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" id="mobileOverlay" onclick="closeSidebar()"></div>


<style>
    .sidebar {
        width: var(--sidebar-width, 280px);
        background: var(--gradient-primary);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: fixed;
        height: 100vh;
        z-index: 1050;
        overflow-y: auto;
        left: 0;
        top: 0;
    }

    .sidebar.collapsed {
        width: var(--sidebar-collapsed, 80px);
    }

    /* Mobile Overlay */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        display: none;
    }

    .sidebar-overlay.active {
        display: block;
    }

    /* Mobile Toggle Button */
    .mobile-sidebar-toggle {
        position: fixed;
        top: 1rem;
        left: 1rem;
        z-index: 1030;
        padding: 0.5rem;
        border-radius: 0.375rem;
    }

    /* Sidebar Elements */
    .sidebar-header {
        background: rgba(0,0,0,0.1);
    }

    .logo-icon {
        transition: all 0.3s;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        transition: all 0.3s;
    }

    .sidebar-menu .nav-link {
        transition: all 0.3s;
        border: none;
        background: transparent;
    }

    .sidebar-menu .nav-link:hover {
        background: rgba(255,255,255,0.15) !important;
        transform: translateX(5px);
    }

    .sidebar-menu .nav-link.active {
        background: rgba(255,255,255,0.2) !important;
        border-left: 4px solid var(--warning);
    }

    .sidebar-menu .badge {
        font-size: 0.7em;
        transition: all 0.3s;
    }

    /* Expandable Section Styles */
    .expandable-section {
        margin-bottom: 0.5rem;
    }

    .section-header .nav-link {
        cursor: pointer;
        position: relative;
    }

    .section-arrow {
        transition: transform 0.3s ease;
        font-size: 0.8em;
    }

    .section-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .expandable-section.expanded .section-content {
        max-height: 500px;
    }

    .expandable-section.expanded .section-arrow {
        transform: rotate(180deg);
    }

    .sub-menu {
        border-left: 2px solid rgba(255,255,255,0.1);
        margin-left: 1rem;
    }

    .sub-menu .nav-link {
        padding: 0.5rem 1rem;
        font-size: 0.9em;
        margin-bottom: 0.25rem;
    }

    .sub-menu .nav-link:hover {
        background: rgba(255,255,255,0.1) !important;
        transform: translateX(3px);
    }

    .sub-menu .nav-link i {
        font-size: 0.8em;
    }

    /* Collapsed State */
    .sidebar.collapsed .logo-text,
    .sidebar.collapsed .menu-text,
    .sidebar.collapsed .user-info,
    .sidebar.collapsed .badge,
    .sidebar.collapsed .sidebar-footer span,
    .sidebar.collapsed .section-arrow {
        display: none;
    }

    .sidebar.collapsed .logo-icon {
        margin-right: 0;
    }

    .sidebar.collapsed .user-avatar {
        width: 35px;
        height: 35px;
        font-size: 0.8em;
    }

    .sidebar.collapsed .nav-link {
        justify-content: center;
        padding: 1rem !important;
    }

    .sidebar.collapsed .nav-link i {
        margin-right: 0;
        font-size: 1.2em;
    }

    .sidebar.collapsed .section-content {
        display: none !important;
    }

    /* Mobile Styles */
    @media (max-width: 991.98px) {
        .sidebar {
            width: 280px;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar.mobile-open {
            transform: translateX(0);
        }

        .sidebar-footer {
            display: none;
        }

        /* Prevent body scroll when sidebar is open */
        body.sidebar-open {
            overflow: hidden;
        }

        /* Ensure section content works on mobile */
        .section-content {
            max-height: 0;
            overflow: hidden;
        }

        .expandable-section.expanded .section-content {
            max-height: 500px;
        }
    }

    /* Desktop Styles */
    @media (min-width: 992px) {
        .mobile-sidebar-toggle {
            display: none !important;
        }
        
        .sidebar-overlay {
            display: none !important;
        }
    }

    /* Scrollbar Styling */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(0,0,0,0.1);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.3);
        border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255,255,255,0.5);
    }
</style>

<script>
    // Toggle expandable sections - only one open at a time
    function toggleSection(element) {
        const section = element.closest('.expandable-section');
        const isCurrentlyExpanded = section.classList.contains('expanded');
        
        // Close all sections first
        document.querySelectorAll('.expandable-section').forEach(sec => {
            sec.classList.remove('expanded');
        });
        
        // If the clicked section wasn't already expanded, open it
        if (!isCurrentlyExpanded) {
            section.classList.add('expanded');
        }
    }

    // Close sidebar function
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
        
        // Close all sections when sidebar closes
        document.querySelectorAll('.expandable-section').forEach(section => {
            section.classList.remove('expanded');
        });
    }

    // Toggle sidebar function
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
            
            // Close all sections when opening sidebar
            if (isOpening) {
                document.querySelectorAll('.expandable-section').forEach(section => {
                    section.classList.remove('expanded');
                });
            }
        } else {
            // Desktop behavior
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            updateToggleButton();
        }
    }

    // Update toggle button for desktop
    function updateToggleButton() {
        const sidebar = document.getElementById('mainSidebar');
        if (sidebar) {
            const isCollapsed = sidebar.classList.contains('collapsed');
            const toggleBtns = document.querySelectorAll('.sidebar-toggle');
            
            toggleBtns.forEach(btn => {
                const icon = btn.querySelector('i');
                const text = btn.querySelector('span');
                
                if (isCollapsed) {
                    icon.className = 'fas fa-chevron-right me-2';
                    if (text) text.textContent = 'Expand Menu';
                } else {
                    icon.className = 'fas fa-chevron-left me-2';
                    if (text) text.textContent = 'Collapse Menu';
                }
            });
        }
    }

    // Initialize sidebar
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('mainSidebar');
        
        // Close all sections by default
        document.querySelectorAll('.expandable-section').forEach(section => {
            section.classList.remove('expanded');
        });

        // Close sidebar when clicking on sub-menu links on mobile
        if (window.innerWidth < 992) {
            document.querySelectorAll('.sub-menu .nav-link').forEach(link => {
                link.addEventListener('click', closeSidebar);
            });
        }

        // Load collapsed state from localStorage for desktop
        if (window.innerWidth >= 992) {
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (sidebar && isCollapsed) {
                sidebar.classList.add('collapsed');
            }
            updateToggleButton();
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('mainSidebar');
        
        if (window.innerWidth >= 992) {
            // Desktop - ensure mobile state is cleared
            if (sidebar) {
                sidebar.classList.remove('mobile-open');
            }
            document.body.classList.remove('sidebar-open');
            
            const overlay = document.getElementById('mobileOverlay');
            if (overlay) {
                overlay.classList.remove('active');
            }
        } else {
            // Mobile - ensure desktop collapsed state is cleared
            if (sidebar) {
                sidebar.classList.remove('collapsed');
            }
        }
        
        updateToggleButton();
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 992) {
            const sidebar = document.getElementById('mainSidebar');
            const overlay = document.getElementById('mobileOverlay');
            const isSidebarClick = event.target.closest('#mainSidebar');
            const isToggleButton = event.target.closest('.mobile-sidebar-toggle');
            
            if (!isSidebarClick && !isToggleButton && sidebar && sidebar.classList.contains('mobile-open')) {
                closeSidebar();
            }
        }
    });
</script>

<script>
    // Initialize sidebar on page load
    document.addEventListener('DOMContentLoaded', function() {
        initSidebar();
        autoExpandActiveSections();
    });

    // Initialize sidebar functionality
    function initSidebar() {
        // Load collapsed state from localStorage for desktop
        if (window.innerWidth >= 992) {
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            const sidebar = document.getElementById('mainSidebar');
            if (sidebar && isCollapsed) {
                sidebar.classList.add('collapsed');
            }
            updateToggleButton();
        }
    }

    // Auto-expand sections with active child links
    function autoExpandActiveSections() {
        const currentPath = window.location.pathname + window.location.search;
        
        document.querySelectorAll('.expandable-section').forEach(section => {
            const links = section.querySelectorAll('.sub-menu a[href]');
            let hasActiveChild = false;
            
            for (let link of links) {
                const href = link.getAttribute('href');
                if (!href) continue;
                
                // Check if this link matches the current path
                if (currentPath === href || 
                    (href !== '/' && currentPath.startsWith(href)) ||
                    link.classList.contains('active')) {
                    link.classList.add('active');
                    hasActiveChild = true;
                } else {
                    link.classList.remove('active');
                }
            }
            
            // Expand section if it has an active child
            if (hasActiveChild) {
                section.classList.add('expanded');
                const arrow = section.querySelector('.section-arrow');
                if (arrow) arrow.style.transform = 'rotate(180deg)';
            }
        });
    }

    // Toggle expandable sections
    function toggleSection(element) {
        const section = element.closest('.expandable-section');
        const isCurrentlyExpanded = section.classList.contains('expanded');
        
        // Close all sections first
        document.querySelectorAll('.expandable-section').forEach(sec => {
            sec.classList.remove('expanded');
            const arrow = sec.querySelector('.section-arrow');
            if (arrow) arrow.style.transform = 'rotate(0deg)';
        });
        
        // If the clicked section wasn't already expanded, open it
        if (!isCurrentlyExpanded) {
            section.classList.add('expanded');
            const arrow = section.querySelector('.section-arrow');
            if (arrow) arrow.style.transform = 'rotate(180deg)';
        }
    }

    // Close sidebar function
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

    // Toggle sidebar function
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
            updateToggleButton();
        }
    }

    // Update toggle button for desktop
    function updateToggleButton() {
        const sidebar = document.getElementById('mainSidebar');
        if (sidebar) {
            const isCollapsed = sidebar.classList.contains('collapsed');
            const toggleBtns = document.querySelectorAll('.sidebar-toggle');
            
            toggleBtns.forEach(btn => {
                const icon = btn.querySelector('i');
                const text = btn.querySelector('span');
                
                if (isCollapsed) {
                    icon.className = 'fas fa-chevron-right me-2';
                    if (text) text.textContent = 'Expand Menu';
                } else {
                    icon.className = 'fas fa-chevron-left me-2';
                    if (text) text.textContent = 'Collapse Menu';
                }
            });
        }
    }

    // Handle window resize
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('mainSidebar');
        
        if (window.innerWidth >= 992) {
            // Desktop - ensure mobile state is cleared
            if (sidebar) {
                sidebar.classList.remove('mobile-open');
            }
            document.body.classList.remove('sidebar-open');
            
            const overlay = document.getElementById('mobileOverlay');
            if (overlay) {
                overlay.classList.remove('active');
            }
        } else {
            // Mobile - ensure desktop collapsed state is cleared
            if (sidebar) {
                sidebar.classList.remove('collapsed');
            }
        }
        
        updateToggleButton();
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 992) {
            const sidebar = document.getElementById('mainSidebar');
            const overlay = document.getElementById('mobileOverlay');
            const isSidebarClick = event.target.closest('#mainSidebar');
            const isToggleButton = event.target.closest('.mobile-sidebar-toggle');
            
            if (!isSidebarClick && !isToggleButton && sidebar && sidebar.classList.contains('mobile-open')) {
                closeSidebar();
            }
        }
    });

    // Simulate route changes for demonstration
    function simulateRouteChange(route) {
        // Update URL without reloading page
        window.history.pushState({}, '', route);
        
        // Remove active class from all links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
        
        // Add active class to the matching link
        const matchingLink = document.querySelector(`.nav-link[href="${route}"]`);
        if (matchingLink) {
            matchingLink.classList.add('active');
        }
        
        // Auto-expand sections with active children
        autoExpandActiveSections();
    }
</script>