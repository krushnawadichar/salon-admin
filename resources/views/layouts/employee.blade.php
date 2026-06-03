{{-- resources/views/layouts/employee.blade.php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Salon Management System') - Employee Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
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
            background: #2c3e50;
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
        }
        
        #sidebar.active {
            margin-left: -250px;
        }
        
        #sidebar .sidebar-header {
            padding: 20px;
            background: #243342;
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
            background: #243342;
        }
        
        #sidebar ul li.active > a {
            background: #3498db;
        }
        
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
            background-color: #f8f9fa;
        }
        
        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .footer {
            margin-top: auto;
            background: #fff;
            padding: 15px 0;
            text-align: center;
            border-top: 1px solid #dee2e6;
            border-radius: 10px;
            margin-top: 20px;
        }
        
        .content-wrapper {
            min-height: calc(100vh - 180px);
        }
        
        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .bg-soft-primary {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }
        
        .bg-soft-success {
            background: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
        }
        
        .bg-soft-warning {
            background: rgba(241, 196, 15, 0.1);
            color: #f1c40f;
        }
        
        .bg-soft-info {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4 class="text-center">Employee Panel</h4>
                <p class="text-center text-light mb-0">
                    <small>{{ Auth::user()->employee->employee_id ?? 'Employee' }}</small>
                </p>
            </div>
            
            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('employee.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('employee.appointments*') ? 'active' : '' }}">
                    <a href="{{ route('employee.appointments') }}">
                        <i class="fas fa-calendar-check me-2"></i> My Appointments
                    </a>
                </li>
                <li class="{{ request()->routeIs('employee.booking.*') ? 'active' : '' }}">
                    <a href="#appointmentSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('employee.booking.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-calendar-alt me-2"></i> Appointments
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('employee.booking.*') ? 'show' : '' }}" id="appointmentSubmenu">
                        <li><a href="{{ route('employee.booking.index') }}"><i class="fas fa-list ms-4 me-2"></i> All Appointments</a></li>
                        <li><a href="{{ route('employee.booking.create') }}"><i class="fas fa-plus ms-4 me-2"></i> New Appointment</a></li>
                    </ul>
                </li>
                
                <li class="{{ request()->routeIs('employee.commissions*') ? 'active' : '' }}">
                    <a href="{{ route('employee.commissions') }}">
                        <i class="fas fa-dollar-sign me-2"></i> My Commissions
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('employee.profile*') ? 'active' : '' }}">
                    <a href="{{ route('employee.profile') }}">
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
            
            <div class="p-3">
                <div class="text-center text-light">
                    <small>Welcome,</small><br>
                    <strong>{{ Auth::user()->name }}</strong>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown me-3">
                            <button class="btn btn-light position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                @php
                                    $pendingAppointments = App\Models\Appointment::where('employee_id', Auth::user()->employee->id ?? 0)
                                        ->whereDate('appointment_date', today())
                                        ->where('appointment_status', 'scheduled')
                                        ->count();
                                @endphp
                                @if($pendingAppointments > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $pendingAppointments }}
                                    </span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><a class="dropdown-item" href="#">You have {{ $pendingAppointments }} appointments today</a></li>
                            </ul>
                        </div>
                        
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('employee.profile') }}">Profile</a></li>
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
                <div class="container-fluid">
                    <span class="text-muted">© {{ date('Y') }} Salon Management System - Employee Panel. All rights reserved.</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
            
            // Initialize DataTables
            $('.datatable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "responsive": true
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html> --}}


{{-- resources/views/layouts/employee.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Salon Management System') - Employee Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            overflow-x: hidden;
        }

        /* ========== DESKTOP VARIABLES ========== */
        :root {
            --primary-color: #3498db;
            --primary-dark: #2980b9;
            --sidebar-bg: #2c3e50;
            --sidebar-dark: #243342;
            --success: #2ecc71;
            --warning: #f1c40f;
            --danger: #e74c3c;
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
            margin-bottom: 8px;
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
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
        }

        /* TOP NAVBAR */
        .navbar {
            background: white;
            padding: 12px 24px;
            border-radius: 12px;
            margin: 16px 20px 20px 20px;
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
        }

        .nav-item-bottom i {
            font-size: 22px;
            margin-bottom: 2px;
        }

        .nav-item-bottom.active {
            color: var(--primary-color);
            background: rgba(52, 152, 219, 0.1);
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
            box-shadow: 0 6px 14px rgba(52,152,219,0.4);
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

        /* Stat Cards */
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            transition: transform 0.2s;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .bg-soft-primary { background: rgba(52, 152, 219, 0.12); color: #3498db; }
        .bg-soft-success { background: rgba(46, 204, 113, 0.12); color: #2ecc71; }
        .bg-soft-warning { background: rgba(241, 196, 15, 0.12); color: #f1c40f; }
        .bg-soft-info { background: rgba(52, 152, 219, 0.12); color: #3498db; }

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
            /* Adjust card columns */
            .stat-card {
                margin-bottom: 12px;
            }
        }

        @media (max-width: 576px) {
            .navbar {
                padding: 10px 16px;
            }
            .stat-card h3 {
                font-size: 1.3rem;
            }
            .table td, .table th {
                font-size: 0.8rem;
                padding: 8px 6px;
            }
            .btn-sm {
                padding: 4px 10px;
                font-size: 0.7rem;
            }
        }

        /* Table responsive */
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
                <h4><i class="fas fa-spa me-2"></i>SalonMS</h4>
                <p class="text-light mb-0 small">Employee Panel</p>
                <p class="text-light mb-0 small mt-1">
                    <i class="fas fa-id-card me-1"></i>{{ Auth::user()->employee->employee_id ?? 'EMP001' }}
                </p>
            </div>
            
            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('employee.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('employee.appointments*') ? 'active' : '' }}">
                    <a href="{{ route('employee.appointments') }}">
                        <i class="fas fa-calendar-check"></i> My Appointments
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('employee.booking.*') ? 'active' : '' }}">
                    <a href="#appointmentSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('employee.booking.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-calendar-alt"></i> Appointments
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('employee.booking.*') ? 'show' : '' }}" id="appointmentSubmenu">
                        <li><a href="{{ route('employee.booking.index') }}"><i class="fas fa-list ms-2 me-2"></i> All Appointments</a></li>
                        <li><a href="{{ route('employee.booking.create') }}"><i class="fas fa-plus ms-2 me-2"></i> New Appointment</a></li>
                    </ul>
                </li>
                
                <li class="{{ request()->routeIs('employee.commissions*') ? 'active' : '' }}">
                    <a href="{{ route('employee.commissions') }}">
                        <i class="fas fa-dollar-sign"></i> My Commissions
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('employee.profile*') ? 'active' : '' }}">
                    <a href="{{ route('employee.profile') }}">
                        <i class="fas fa-user-cog"></i> Profile
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
            
            <div class="p-3 mt-auto">
                <div class="text-center text-light small">
                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown me-2 me-md-3">
                            <button class="btn btn-light position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                @php
                                    $pendingAppointments = App\Models\Appointment::where('employee_id', Auth::user()->employee->id ?? 0)
                                        ->whereDate('appointment_date', today())
                                        ->where('appointment_status', 'scheduled')
                                        ->count();
                                @endphp
                                @if($pendingAppointments > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $pendingAppointments }}
                                    </span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><a class="dropdown-item" href="#">📅 You have {{ $pendingAppointments }} appointments today</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">View all</a></li>
                            </ul>
                        </div>
                        
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('employee.profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('employee.commissions') }}"><i class="fas fa-coins me-2"></i>Commissions</a></li>
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
                <div class="container-fluid">
                    <span class="text-muted">© {{ date('Y') }} Salon Management System - Employee Panel</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- MOBILE BOTTOM NAVIGATION (App Style) -->
    <div class="mobile-bottom-nav" id="mobileBottomNav">
        <button class="nav-item-bottom {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}" data-mobile-route="dashboard">
            <i class="fas fa-tachometer-alt"></i><span>Home</span>
        </button>
        <button class="nav-item-bottom {{ request()->routeIs('employee.booking.index') ? 'active' : '' }}" data-mobile-route="appointments">
            <i class="fas fa-calendar-check"></i><span>Appts</span>
        </button>
        <button class="nav-item-bottom {{ request()->routeIs('employee.booking.create') ? 'active' : '' }}" data-mobile-route="new-booking">
            <i class="fas fa-plus-circle"></i><span>Book</span>
        </button>
        <button class="nav-item-bottom {{ request()->routeIs('employee.commissions*') ? 'active' : '' }}" data-mobile-route="commissions">
            <i class="fas fa-dollar-sign"></i><span>Earnings</span>
        </button>
        <button class="nav-item-bottom {{ request()->routeIs('employee.profile*') ? 'active' : '' }}" data-mobile-route="profile">
            <i class="fas fa-user"></i><span>Profile</span>
        </button>
    </div>

    <!-- Floating Action Button (Mobile Quick Add) -->
    <button class="mobile-fab" id="mobileFabBtn">
        <i class="fas fa-plus"></i>
    </button>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
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
                let route = $(this).data('mobile-route');
                let urls = {
                    'dashboard': '{{ route("employee.dashboard") }}',
                    'appointments': '{{ route("employee.booking.index") }}',
                    'new-booking': '{{ route("employee.booking.create") }}',
                    'commissions': '{{ route("employee.commissions") }}',
                    'profile': '{{ route("employee.profile") }}'
                };
                if (urls[route]) {
                    window.location.href = urls[route];
                }
            });
            
            // Mobile FAB - Quick add appointment (redirect to create booking)
            $('#mobileFabBtn').on('click', function() {
                window.location.href = '{{ route("employee.booking.create") }}';
            });
            
            // Initialize DataTables on elements with .datatable class
            $('.datatable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "responsive": true,
                "language": {
                    "search": "🔍",
                    "lengthMenu": "Show _MENU_",
                    "info": "_START_-_END_ of _TOTAL_"
                }
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