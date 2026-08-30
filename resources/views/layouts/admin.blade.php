{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Salon Management System') - Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <style>
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
        }
        
        #sidebar.active {
            margin-left: -250px;
        }
        
        #sidebar .sidebar-header {
            padding: 20px;
            background: #2c3136;
        }
        
        #sidebar ul.components {
            padding: 20px 0;
        }
        
        #sidebar ul li a {
            padding: 10px 20px;
            font-size: 1.1em;
            display: block;
            color: #fff;
            text-decoration: none;
        }
        
        #sidebar ul li a:hover {
            background: #2c3136;
        }
        
        #sidebar ul li.active > a {
            background: #007bff;
        }
        
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 0;
            margin-bottom: 20px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .footer {
            margin-top: auto;
            background: #f8f9fa;
            padding: 10px 0;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }
        
        .content-wrapper {
            min-height: calc(100vh - 130px);
        }
        .select2-container .select2-selection--single {
            height: 38px;
            padding: 5px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4 class="text-center">Salon Admin</h4>
            </div>
            
            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#serviceSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.services.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-cut me-2"></i> Services
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.services.*') ? 'show' : '' }}" id="serviceSubmenu">
                        <li><a href="{{ route('admin.services.index') }}"><i class="fas fa-list ms-4 me-2"></i> All Services</a></li>
                        <li><a href="{{ route('admin.services.create') }}"><i class="fas fa-plus ms-4 me-2"></i> Add Service</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#employeeSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.employees.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-users me-2"></i> Employees
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.employees.*') ? 'show' : '' }}" id="employeeSubmenu">
                        <li><a href="{{ route('admin.employees.index') }}"><i class="fas fa-list ms-4 me-2"></i> All Employees</a></li>
                        <li><a href="{{ route('admin.employees.create') }}"><i class="fas fa-user-plus ms-4 me-2"></i> Add Employee</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#clientSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.clients.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-user me-2"></i> Clients
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.clients.*') ? 'show' : '' }}" id="clientSubmenu">
                        <li><a href="{{ route('admin.clients.index') }}"><i class="fas fa-list ms-4 me-2"></i> All Clients</a></li>
                        <li><a href="{{ route('admin.clients.create') }}"><i class="fas fa-user-plus ms-4 me-2"></i> Add Client</a></li>
                    </ul>
                </li>
                
                <li class="{{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                    <a href="#appointmentSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.appointments.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-calendar-alt me-2"></i> Appointments
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.appointments.*') ? 'show' : '' }}" id="appointmentSubmenu">
                        <li><a href="{{ route('admin.appointments.index') }}"><i class="fas fa-list ms-4 me-2"></i> All Appointments</a></li>
                        <li><a href="{{ route('admin.appointments.create') }}"><i class="fas fa-plus ms-4 me-2"></i> New Appointment</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#reportSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-chart-bar me-2"></i> Reports
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.reports.*') ? 'show' : '' }}" id="reportSubmenu">
                        <li><a href="{{ route('admin.reports.daily') }}"><i class="fas fa-calendar-day ms-4 me-2"></i> Daily Report</a></li>
                        <li><a href="{{ route('admin.reports.monthly') }}"><i class="fas fa-calendar-alt ms-4 me-2"></i> Monthly Report</a></li>
                        <li><a href="{{ route('admin.reports.commission') }}"><i class="fas fa-percent ms-4 me-2"></i> Commission Report</a></li>
                        <li><a href="{{ route('admin.reports.salary') }}"><i class="fas fa-money-bill ms-4 me-2"></i> Salary Report</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="">
                        <i class="fas fa-user-cog me-2"></i> Profile
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown me-3">
                            <button class="btn btn-light dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="badge bg-danger">3</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">New appointment</a></li>
                                <li><a class="dropdown-item" href="#">Payment received</a></li>
                                <li><a class="dropdown-item" href="#">Employee added</a></li>
                            </ul>
                        </div>
                        
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <span class="text-muted">© {{ date('Y') }} Salon Management System. All rights reserved.</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
            
            // Initialize DataTables
            $('.datatable').DataTable();

            $('.select2').each(function() {
                $(this).select2({
                    placeholder: $(this).data('placeholder') || "Select",
                    allowClear: true,
                    width: '100%'
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Salon Management System') - Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            overflow-x: hidden;
        }

        /* ========== VARIABLES ========== */
        :root {
            --primary-color: #007bff;
            --primary-dark: #0056b3;
            --sidebar-bg: #343a40;
            --sidebar-dark: #2c3136;
        }

        /* ========== WRAPPER & SIDEBAR (DESKTOP) ========== */
        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        /* DESKTOP SIDEBAR */
        #sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: #fff;
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1050;
            overflow-y: auto;
            box-shadow: 2px 0 12px rgba(0,0,0,0.08);
        }

        #sidebar.active {
            margin-left: -260px;
        }

        #sidebar .sidebar-header {
            padding: 24px 20px;
            background: var(--sidebar-dark);
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        #sidebar .sidebar-header h4 {
            font-weight: 700;
            margin-bottom: 0;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #e8eef2;
            text-decoration: none;
            transition: all 0.2s;
        }

        #sidebar ul li a:hover {
            background: var(--sidebar-dark);
            color: white;
        }

        #sidebar ul li.active > a {
            background: var(--primary-color);
            color: white;
            border-left: 3px solid white;
        }

        #sidebar ul li a i {
            width: 24px;
            font-size: 1.1rem;
        }

        .dropdown-toggle::after {
            margin-left: auto;
        }

        #sidebar ul ul a {
            padding-left: 48px;
            font-size: 0.9rem;
        }

        /* MAIN CONTENT */
        #content {
            flex: 1;
            margin-left: 260px;
            transition: margin-left 0.3s;
            width: calc(100% - 260px);
            min-height: 100vh;
            background-color: #f4f6f9;
            display: flex;
            flex-direction: column;
        }

        /* TOP NAVBAR */
        .navbar {
            background: white;
            padding: 12px 24px;
            border-radius: 0;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .navbar .btn-info {
            background: var(--primary-color);
            border: none;
            color: white;
        }

        /* Mobile bottom navigation */
        .mobile-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(12px);
            box-shadow: 0 -4px 20px rgba(0,0,0,0.08);
            border-top: 1px solid rgba(0,0,0,0.05);
            padding: 8px 16px 20px;
            justify-content: space-around;
            z-index: 1100;
            border-radius: 20px 20px 0 0;
        }

        .nav-item-bottom {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            background: transparent;
            border: none;
            color: #8e9aaf;
            font-size: 11px;
            font-weight: 500;
            transition: 0.2s;
            padding: 8px 12px;
            border-radius: 30px;
            flex: 1;
            cursor: pointer;
        }

        .nav-item-bottom i {
            font-size: 22px;
            margin-bottom: 2px;
        }

        .nav-item-bottom.active {
            color: var(--primary-color);
            background: rgba(0, 123, 255, 0.1);
        }

        /* Floating Action Button (Mobile) */
        .mobile-fab {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            background: var(--primary-color);
            width: 56px;
            height: 56px;
            border-radius: 28px;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 14px rgba(0,123,255,0.4);
            z-index: 1050;
            color: white;
            font-size: 24px;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .mobile-fab:active {
            transform: scale(0.92);
        }

        /* content wrapper */
        .content-wrapper {
            flex: 1;
            padding: 0 20px 20px 20px;
        }

        .footer {
            background: white;
            padding: 15px 20px;
            text-align: center;
            border-top: 1px solid #dee2e6;
            margin: 0 20px 20px 20px;
            border-radius: 12px;
        }

        /* Select2 responsive */
        .select2-container .select2-selection--single {
            height: 38px;
            padding: 5px;
        }

        /* alerts */
        .alert {
            border-radius: 12px;
            margin-bottom: 20px;
        }

        /* ========== RESPONSIVE: MOBILE APP VIEW ========== */
        @media (max-width: 992px) {
            #sidebar {
                transform: translateX(-100%);
                position: fixed;
                width: 280px;
                z-index: 1060;
            }
            #sidebar.show {
                transform: translateX(0);
            }
            #content {
                margin-left: 0;
                width: 100%;
                padding-bottom: 80px;
            }
            .navbar {
                margin: 12px 12px 16px 12px;
                border-radius: 12px;
            }
            .content-wrapper {
                padding: 0 12px 12px 12px;
            }
            .footer {
                margin: 0 12px 16px 12px;
            }
            .mobile-bottom-nav {
                display: flex;
            }
            .mobile-fab {
                display: flex;
            }
        }

        @media (max-width: 576px) {
            .navbar {
                padding: 10px 16px;
            }
            .table td, .table th {
                font-size: 0.8rem;
                padding: 8px 6px;
            }
            .btn-sm {
                padding: 4px 10px;
                font-size: 0.7rem;
            }
            .content-wrapper {
                padding: 0 8px 12px 8px;
            }
            .footer {
                font-size: 0.75rem;
            }
        }

        /* DataTables responsive */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 16px;
        }

        @media (max-width: 768px) {
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none !important;
                text-align: left !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar (Desktop & Slide menu on mobile) -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4><i class="fas fa-spa me-2"></i>Salon Admin</h4>
            </div>
            
            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#serviceSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.services.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-cut"></i> Services
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.services.*') ? 'show' : '' }}" id="serviceSubmenu">
                        <li><a href="{{ route('admin.services.index') }}"><i class="fas fa-list ms-2 me-2"></i> All Services</a></li>
                        <li><a href="{{ route('admin.services.create') }}"><i class="fas fa-plus ms-2 me-2"></i> Add Service</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#employeeSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.employees.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-users"></i> Employees
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.employees.*') ? 'show' : '' }}" id="employeeSubmenu">
                        <li><a href="{{ route('admin.employees.index') }}"><i class="fas fa-list ms-2 me-2"></i> All Employees</a></li>
                        <li><a href="{{ route('admin.employees.create') }}"><i class="fas fa-user-plus ms-2 me-2"></i> Add Employee</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#clientSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.clients.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-user"></i> Clients
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.clients.*') ? 'show' : '' }}" id="clientSubmenu">
                        <li><a href="{{ route('admin.clients.index') }}"><i class="fas fa-list ms-2 me-2"></i> All Clients</a></li>
                        <li><a href="{{ route('admin.clients.create') }}"><i class="fas fa-user-plus ms-2 me-2"></i> Add Client</a></li>
                    </ul>
                </li>
                
                <li class="{{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                    <a href="#appointmentSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.appointments.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-calendar-alt"></i> Appointments
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.appointments.*') ? 'show' : '' }}" id="appointmentSubmenu">
                        <li><a href="{{ route('admin.appointments.index') }}"><i class="fas fa-list ms-2 me-2"></i> All Appointments</a></li>
                        <li><a href="{{ route('admin.appointments.create') }}"><i class="fas fa-plus ms-2 me-2"></i> New Appointment</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#reportSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-chart-bar"></i> Reports
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.reports.*') ? 'show' : '' }}" id="reportSubmenu">
                        <li><a href="{{ route('admin.reports.daily') }}"><i class="fas fa-calendar-day ms-2 me-2"></i> Daily Report</a></li>
                        <li><a href="{{ route('admin.reports.monthly') }}"><i class="fas fa-calendar-alt ms-2 me-2"></i> Monthly Report</a></li>
                        <li><a href="{{ route('admin.reports.commission') }}"><i class="fas fa-percent ms-2 me-2"></i> Commission Report</a></li>
                        <li><a href="{{ route('admin.reports.salary') }}"><i class="fas fa-money-bill ms-2 me-2"></i> Salary Report</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="">
                        <i class="fas fa-user-cog me-2"></i> Profile
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown me-3">
                            <button class="btn btn-light dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="badge bg-danger">3</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">New appointment</a></li>
                                <li><a class="dropdown-item" href="#">Payment received</a></li>
                                <li><a class="dropdown-item" href="#">Employee added</a></li>
                            </ul>
                        </div>
                        
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href=""><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                    <span class="text-muted">© {{ date('Y') }} Salon Management System. All rights reserved.</span>
                    <span class="text-muted small">Designed &amp; Developed by <a href="https://codekrupa.com/" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-semibold text-primary">Codekrupa IT Solution</a></span>
                </div>
            </footer>
        </div>
    </div>

    <!-- MOBILE BOTTOM NAVIGATION (App Style - Using ONLY existing routes from sidebar) -->
    <div class="mobile-bottom-nav" id="mobileBottomNav">
        @php
            $currentRoute = request()->route()->getName();
            // Using ONLY routes that exist in your sidebar
            $navItems = [
                'dashboard' => ['route' => 'admin.dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Home'],
                'appointments' => ['route' => 'admin.appointments.index', 'icon' => 'fa-calendar-alt', 'label' => 'Appts'],
                'services' => ['route' => 'admin.services.index', 'icon' => 'fa-cut', 'label' => 'Services'],
                'employees' => ['route' => 'admin.employees.index', 'icon' => 'fa-users', 'label' => 'Staff'],
                'reports' => ['route' => 'admin.reports.daily', 'icon' => 'fa-chart-bar', 'label' => 'Reports'],
            ];
        @endphp
        @foreach($navItems as $key => $item)
            @php
                $isActive = false;
                if($key == 'dashboard' && request()->routeIs('admin.dashboard')) $isActive = true;
                if($key == 'appointments' && request()->routeIs('admin.appointments.*')) $isActive = true;
                if($key == 'services' && request()->routeIs('admin.services.*')) $isActive = true;
                if($key == 'employees' && request()->routeIs('admin.employees.*')) $isActive = true;
                if($key == 'reports' && request()->routeIs('admin.reports.*')) $isActive = true;
            @endphp
            <button class="nav-item-bottom {{ $isActive ? 'active' : '' }}" data-mobile-route="{{ route($item['route']) }}">
                <i class="fas {{ $item['icon'] }}"></i>
                <span>{{ $item['label'] }}</span>
            </button>
        @endforeach
    </div>

    <!-- Floating Action Button (Mobile Quick Add - New Appointment) -->
    <button class="mobile-fab" id="mobileFabBtn">
        <i class="fas fa-plus"></i>
    </button>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Sidebar toggle for desktop/mobile
            $('#sidebarCollapse').on('click', function() {
                if ($(window).width() <= 992) {
                    $('#sidebar').toggleClass('show');
                } else {
                    $('#sidebar').toggleClass('active');
                }
            });
            
            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(event) {
                if ($(window).width() <= 992) {
                    if (!$(event.target).closest('#sidebar').length && !$(event.target).closest('#sidebarCollapse').length) {
                        $('#sidebar').removeClass('show');
                    }
                }
            });
            
            // Mobile bottom navigation - redirect to routes
            $('.nav-item-bottom').on('click', function() {
                let routeUrl = $(this).data('mobile-route');
                if (routeUrl) {
                    window.location.href = routeUrl;
                }
            });
            
            // Mobile FAB - Quick add appointment
            $('#mobileFabBtn').on('click', function() {
                window.location.href = '{{ route("admin.appointments.create") }}';
            });
            
            // Initialize DataTables
            $('.datatable').each(function() {
                if ($.fn.DataTable.isDataTable(this)) {
                    $(this).DataTable().destroy();
                }
                $(this).DataTable({
                    responsive: true,
                    pageLength: 10,
                    language: {
                        search: "🔍",
                        lengthMenu: "Show _MENU_",
                        info: "_START_-_END_ of _TOTAL_"
                    }
                });
            });

            // Initialize Select2
            $('.select2').each(function() {
                $(this).select2({
                    placeholder: $(this).data('placeholder') || "Select",
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $(this).closest('.modal').length ? $(this).closest('.modal') : $(document.body)
                });
            });
            
            // Handle window resize: reset sidebar state if needed
            $(window).on('resize', function() {
                if ($(window).width() > 992) {
                    $('#sidebar').removeClass('show');
                    $('#sidebar').removeClass('active');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>